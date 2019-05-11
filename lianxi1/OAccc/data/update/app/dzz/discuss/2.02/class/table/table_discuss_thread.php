<?php
/* @authorcode  codestrings
 * @copyright   Leyun internet Technology(Shanghai)Co.,Ltd
 * @license     http://www.dzzoffice.com/licenses/license.txt
 * @package     DzzOffice
 * @link        http://www.dzzoffice.com
 * @author      zyx(zyx@dzz.cc)
 */

if(!defined('IN_DZZ')) {
	exit('Access Denied');
}
class table_discuss_thread extends dzz_table
{
	private $_posttableid = array();
	private $_urlparam = array();

	public function __construct() {

		$this->_table = 'discuss_thread';
		$this->_pk    = 'tid';
		$this->_pre_cache_key = 'discuss_thread_';
		$this->_cache_ttl=60*60; //一小时
		parent::__construct();
	}

	public function fetch($tid, $tableid = 0) {
		$tid = intval($tid);
		$data = array();
		if($tid && ($data = $this->fetch_cache($tid)) === false) {
			$parameter = array($this->get_table_name($tableid), 'discuss_threadaddviews', $tid);
			$data = DB::fetch_first("SELECT t.*, v.addviews FROM %t t LEFT JOIN %t v ON t.tid = v.tid WHERE t.tid=%d", $parameter);
			if(!empty($data)) {
				global $_G;
				$uid = $_G['uid'];
				$data['isfav'] = C::t('discuss_favorite')->check_fav_by_id_idtype_uid($tid, 'thread', $uid);
				$data['subject'] = emoji_decode($data['subject']);
				$this->store_cache($tid, $data, $this->_cache_ttl);
			}
		}
		return $data;
	}

	public function fetch_by_tid_displayorder($tid, $displayorder = null, $glue = '>=',  $authorid = null, $tableid = 0) {
		$data = $this->fetch($tid, $tableid);
		if(!empty($data)) {
			if(($displayorder !== null && !($this->compare_number($data['displayorder'], $displayorder, $glue))) || ($authorid !== null && $data['authorid'] != $authorid)) {
				$data = array();
			}
		}
		return $data;
	}

	public function fetch_by_fid_displayorder($fid, $displayorder = 0, $glue = '>=', $order = 'lastpost', $sort = 'DESC') {
		$fid = intval($fid);
		if(!empty($fid)) {
			$parameter = array($this->get_table_name(), $fid,  $displayorder);
			$glue = helper_util::check_glue($glue);
			$ordersql = !empty($order) ? ' ORDER BY '.DB::order($order, $sort) : '';
			return DB::fetch_first("SELECT * FROM %t WHERE isdelete = 0 AND inarchive = 0 AND fid=%d AND displayorder{$glue}%d $ordersql ".DB::limit(0, 1), $parameter);
		}
		return array();
	}
	public function fetch_next_tid_by_fid_lastpost($fid, $lastpost, $glue = '>', $sort = 'DESC', $tableid = 0) {
		$glue = helper_util::check_glue($glue);
		return DB::result_first("SELECT tid FROM %t WHERE fid=%d AND displayorder>=0 AND closed=0 AND lastpost{$glue}%d  ORDER BY ".DB::order('lastpost', $sort).DB::limit(1), array($this->get_table_name($tableid), $fid, $lastpost));
	}
	public function fetch_by_tid_fid_displayorder($tid, $fid, $displayorder = null, $tableid = 0, $glue = '>=') {
		if($tid) {
			$data = $this->fetch($tid, $tableid);
			if(!empty($data)) {
				if(($data['fid'] != $fid) || ($displayorder !== null && !($this->compare_number($data['displayorder'], $displayorder, $glue)))) {
					$data = array();
				}
			}
			return $data;
		}
		return array();
	}
	public function fetch_thread_table_ids() {
		$threadtableids = array('0' => 0);
		/*$db = DB::object();
		$query = $db->query("SHOW TABLES LIKE '".str_replace('_', '\_', DB::table('discuss_thread').'_%')."'");
		while($table = $db->fetch_array($query, $db->drivertype == 'mysqli' ? MYSQLI_NUM : MYSQL_NUM)) {
			$tablename = $table[0];
			$tableid = intval(substr($tablename, strrpos($tablename, '_') + 1));
			if(empty($tableid)) {
				continue;
			}
			$threadtableids[$tableid] = $tableid;
		}*/
		return $threadtableids;
	}

	public function fetch_all_by_digest_displayorder($digest, $digestglue = '=', $displayorder = 0, $glue = '>=', $start = 0, $limit = 0, $tableid = 0) {
		$parameter = array($this->get_table_name($tableid), $digest, $displayorder);
		$digestglue = helper_util::check_glue($digestglue);
		$glue = helper_util::check_glue($glue);
		return DB::fetch_all("SELECT * FROM %t WHERE digest{$digestglue}%d AND displayorder{$glue}%d".DB::limit($start, $limit), $parameter, $this->_pk);
	}

	public function fetch_all_by_fid_typeid_displayorder($fid, $typeid = null, $displayorder = null, $glue = '=', $start = 0, $limit = 0,$ordertype='lastpost') {

		$parameter = array($this->get_table_name(), $fid);
		$wherearr = array();
		$wherearr[] = is_array($fid) ? 'fid IN(%n)' : 'fid=%d';

		if($typeid) {
			$parameter[] = $typeid;
			$wherearr[] = "typeid=%d";
		}
		if($displayorder !== null) {
			$parameter[] = $displayorder;
			$glue = helper_util::check_glue($glue);
			$wherearr[] = "displayorder{$glue}%d";
		}
		$wherearr[] = "isdelete = 0 and inarchive = 0";
		$wheresql = ' WHERE '.implode(' AND ', $wherearr);
		return DB::fetch_all("SELECT * FROM %t $wheresql ORDER BY displayorder desc, $ordertype DESC ".DB::limit($start, $limit), $parameter, $this->_pk);
	}
	public function fetch_all_by_fid_lastpost($fid, $lstart = 0, $lend = 0, $tableid = 0) {
		$parameter = array($this->get_table_name($tableid), $fid);
		$wherearr = array();
		$wherearr[] = is_array($fid) ? 'fid IN(%n)' : 'fid=%d';
		$wherearr[] = 'displayorder=0';
		if($lstart) {
			$wherearr[] = 'lastpost>%d';
			$parameter[] = $lstart;
		}
		if($lend) {
			$wherearr[] = 'lastpost<%d';
			$parameter[] = $lend;
		}
		$wheresql = !empty($wherearr) && is_array($wherearr) ? ' WHERE '.implode(' AND ', $wherearr) : '';
		return DB::fetch_all("SELECT * FROM %t $wheresql ORDER BY lastpost DESC ".DB::limit(0, 100), $parameter, $this->_pk);
	}

	public function fetch_all_by_authorid_displayorder($authorid,$orderby='dateline', $displayorder = null, $dglue = '=', $closed = null, $subject = '', $start = 0, $limit = 0, $replies = null, $fid = null, $rglue = '>=', $tableid = 0) {

		$parameter = array($this->get_table_name($tableid), 'discuss');
		$wherearr = array();
		if(!empty($authorid)) {
			$authorid = dintval($authorid, true);
			$parameter[] = $authorid;
			$wherearr[] = is_array($authorid) && $authorid ? 't.authorid IN(%n)' : 't.authorid=%d';
		}
		if($fid !== null) {
			$fid = dintval($fid, true);
			$parameter[] = $fid;
			$wherearr[] = is_array($fid) && $fid ? 't.fid IN(%n)' : 't.fid=%d';
		}
		if(getglobal('setting/followdiscussid')) {
			$parameter[] = getglobal('setting/followdiscussid');
			$wherearr[] = 't.fid<>%d';
		}
		if($displayorder !== null) {
			$parameter[] = $displayorder;
			$dglue = helper_util::check_glue($dglue);
			$wherearr[] = "t.displayorder{$dglue}%d";
		}
		if($closed !== null) {
			$parameter[] = $closed;
			$wherearr[] = "t.closed=%d";
		}
		if($replies !== null) {
			$parameter[] = $replies;
			$rglue = helper_util::check_glue($rglue);
			$wherearr[] = "t.replies{$rglue}%d";
		}
		if(!empty($subject)) {
			$parameter[] = '%'.$subject.'%';
			$wherearr[] = "t.subject LIKE %s";
		}
		$wherearr[] = 't.isdelete < 1 and t.inarchive < 1';
		$wherearr[] = 'd.isdelete < 1 and d.inarchive < 1';
		$case = '';
		if ($orderby == 'digest') {
			$order = 'digest';
			$case = ", CASE WHEN startdigest > ".TIMESTAMP." THEN 0 ELSE digest END digest";
		} else {
			$order = 't.'.$orderby;
		}
		$wheresql = !empty($wherearr) && is_array($wherearr) ? ' WHERE '.implode(' AND ', $wherearr) : '';
		$data = DB::fetch_all("SELECT *".$case." FROM %t t LEFT JOIN %t d ON t.fid = d.fid $wheresql ORDER BY $order DESC ".DB::limit($start, $limit), $parameter, $this->_pk);
		foreach ($data as $key => $value) {
			$data[$key]['subject'] = emoji_decode($value['subject']);
		}
		return $data;
	}

	public function fetch_all_by_tid($tids, $start = 0, $limit = 0, $tableid = 0) {
		$data = array();
		if(($data = $this->fetch_cache($tids)) === false || count($tids) != count($data)) {
			if(is_array($data) && !empty($data)) {
				$tids = array_diff($tids, array_keys($data));
			}
			if($data === false) $data = array();
			if(!empty($tids)) {
				$parameter = array($this->get_table_name($tableid), $tids);
				$query = DB::query("SELECT * FROM %t WHERE tid IN(%n)".DB::limit($start, $limit), $parameter);
				while($value = DB::fetch($query)) {
					$data[$value['tid']] = $value;
					$data[$value['tid']]['subject'] = emoji_decode($value['subject']);
					$data[$value['tid']]['forumname'] = emoji_decode($value['forumname']);
					$this->store_cache($value['tid'], $value, $this->_cache_ttl);
				}
			}
		}
		return $data;
	}

	public function fetch_all_by_tid_displayorder($tids, $displayorder = null, $glue = '>=', $fids = array(), $closed = null) {
		$data = array();
		if(!empty($tids)) {
			$data = $this->fetch_all_by_tid((array)$tids);
			$fids = $fids && !is_array($fids) ? array($fids) : $fids;
			foreach($data as $tid => $value) {
				if($displayorder !== null && !(helper_util::compute($value['displayorder'], $displayorder, $glue))) {
					unset($data[$tid]);
				} elseif(!empty($fids) && !in_array($value['fid'], $fids)) {
					unset($data[$tid]);
				} elseif($closed !== null && $value['closed'] != $closed) {
					unset($data[$tid]);
				}
			}
		}
		return $data;
	}

	public function fetch_all_by_tid_fid_displayorder($stick, $tids, $fids = null, $displayorder = null, $order = 'dateline', $start = 0, $limit = 0, $glue = '>=', $sort = 'DESC',$subject = 0, $tableid = 0) {
		$parameter = array($this->get_table_name($tableid), 'discuss');
		$wherearr = array();
		if(!empty($tids)) {
			$tids = dintval($tids, true);
			$parameter[] = $tids;
			$wherearr[] = is_array($tids) && $tids ? 't.tid IN(%n)' : 't.tid=%d';
		}
		if(!empty($fids)) {
			$fids = dintval($fids, true);
			$parameter[] = $fids;
			$wherearr[] = is_array($fids) && $fids ? 't.fid IN(%n)' : 't.fid=%d';
		}

		if($displayorder !== null) {
			$parameter[] = $displayorder;
			$glue = helper_util::check_glue($glue);
			$parameter[] = TIMESTAMP;
			if ($stick) {
				if ($glue == '>=') $wherearr[] = 'd.inarchive = 0';
				$wherearr[] = "(t.displayorder{$glue}%d and t.startstick < %d)";
			} else {
				$wherearr[] = "(t.displayorder{$glue}%d or t.startstick > %d)";
			}
			
		}
		if(!empty($subject)) {
			$parameter[] = '%'.$subject.'%';
			$wherearr[] = "subject LIKE %s";
		}
		if($order) {
			if ($order == 'digest') {
				$order = 'ORDER BY '.$order.' '.$sort;
				$case = ", CASE WHEN startdigest > ".TIMESTAMP." THEN 0 ELSE digest END digest";
			} else {
				$order = 'ORDER BY t.'.$order.' '.$sort;
				$case = '';
			}
		}
		// $wherearr[] = 't.isdelete < 1 and t.inarchive < 1 and d.isdelete < 1 and d.inarchive < 1';
		$wherearr[] = ' (case when d.inarchive = 1 then t.isdelete < 1 and d.isdelete = 0 else d.inarchive = 0 and d.isdelete = 0 and t.isdelete < 1 and t.inarchive < 1 end)';
		if(!empty($wherearr)) {
			$wheresql = ' WHERE '.implode(' AND ', $wherearr);
			$data = DB::fetch_all("SELECT t.*".$case." FROM %t t LEFT JOIN %t d ON t.fid = d.fid $wheresql $order ".DB::limit($start, $limit), $parameter, $this->_pk);
			foreach ($data as $k => $v) {
				$data[$k]['subject'] = emoji_decode($v['subject']);
				$data[$k]['forumname'] = emoji_decode($v['forumname']);
			}
			return $data;
		} else {
			return array();
		}
	}

	public function fetch_all_by_tid_or_fid($fid, $tids = array()) {
		$parameter = array($this->get_table_name(), $fid);
		$discussstickytids = '';
		if(!empty($tids)) {
			$tids = dintval($tids, true);
			$parameter[] = $tids;
			$discussstickytids = ' OR '.(is_array($tids) && $tids ? 'tid IN(%n)' : 'tid=%d');
		}
		return DB::fetch_all("SELECT * FROM %t WHERE fid=%d AND displayorder=1 $discussstickytids ORDER BY lastpost DESC", $parameter);
	}

	public function fetch_all_by_displayorder($displayorder = 0, $glue = '>=', $start = 0, $limit = 0, $tableid = 0) {
		$glue = helper_util::check_glue($glue);
		$displayorder = dintval($displayorder, true);
		return DB::fetch_all('SELECT * FROM %t WHERE %i '.DB::limit($start, $limit), array($this->get_table_name($tableid), DB::field('displayorder', $displayorder, $glue)));
	}

	public function fetch_all_by_authorid($authorid, $start = 0, $limit = 0, $tableid = 0) {
		$authorid = dintval($authorid, true);
		return DB::fetch_all("SELECT * FROM %t WHERE %i ORDER BY dateline DESC ".DB::limit($start, $limit), array($this->get_table_name($tableid), DB::field('authorid', $authorid)), $this->_pk);
	}

	public function fetch_all_by_dateline($starttime, $start = 0, $limit = 0, $order = 'dateline', $sort = 'DESC') {
		if($starttime) {
			$orderby = '';
			if(!empty($order)) {
				$orderby = "ORDER BY ".DB::order($order, $sort);
			}
			$parameter = array($this->get_table_name(), $starttime);
			return DB::fetch_all("SELECT * FROM %t WHERE dateline>=%d AND displayorder>'-1' $orderby ".DB::limit($start, $limit), $parameter, $this->_pk);
		}
		return array();
	}

	public function fetch_all_by_fid_displayorder($fids, $displayorder = null, $dateline = null, $recommends = null, $start = 0, $limit = 0, $order = 'dateline', $sort = 'DESC', $dglue = '>=') {
		$parameter = array($this->get_table_name());
		$wherearr = array();
		$fids = dintval($fids, true);
		if(!empty($fids)) {
			$parameter[] = $fids;
			$wherearr[] = is_array($fids) && $fids ? 'fid IN(%n)' : 'fid=%d';
		}
		if($displayorder !== null) {
			$parameter[] = $displayorder;
			$dglue = helper_util::check_glue($dglue);
			$wherearr[] = "displayorder{$dglue}%d";
		}
		if($dateline !== null) {
			$parameter[] = $dateline;
			$wherearr[] = "dateline>=%d";
		}
		if($recommends !== null) {
			$parameter[] = $recommends;
			$wherearr[] = "recommends>%d";
		}
		$ordersql = !empty($order) ? ' ORDER BY '.DB::order($order, $sort) : '';
		$wheresql = !empty($wherearr) && is_array($wherearr) ? ' WHERE '.implode(' AND ', $wherearr) : '';
		return DB::fetch_all("SELECT * FROM %t $wheresql $ordersql ".DB::limit($start, $limit), $parameter, $this->_pk);
	}

	public function fetch_all_new_thread_by_tid($tid = 0, $start = 0, $limit = 0, $tableid = 0, $glue = '>', $sort = 'ASC') {
		$glue = helper_util::check_glue($glue);
		return DB::fetch_all("SELECT * FROM %t WHERE tid{$glue}%d ORDER BY ".DB::order('tid', $sort).DB::limit($start, $limit), array($this->get_table_name($tableid), $tid), $this->_pk);
	}

	public function fetch_all_by_fid_authorid_displayorder($fids, $authorid, $displayorder = null, $lastpost = 0, $start = 0, $limit = 0) {
		$parameter = array($this->get_table_name());
		$wherearr = array();
		if($authorid) {
			$authorid = dintval($authorid, true);
			$parameter[] = $authorid;
			$wherearr[] = is_array($authorid) ? 'authorid IN(%n)' : 'authorid=%d';
		}
		$fids = dintval($fids, true);
		$parameter[] = $fids;
		$wherearr[] = is_array($fids) ? 'fid IN(%n)' : 'fid=%d';
		if($displayorder !== null) {
			$parameter[] = $displayorder;
			$wherearr[] = "displayorder=%d";
		}
		if($lastpost) {
			$parameter[] = $lastpost;
			$wherearr[] = "lastpost>%d";
		}
		$wheresql = ' WHERE '.implode(' AND ', $wherearr);
		return DB::fetch_all("SELECT * FROM %t $wheresql ORDER BY lastpost DESC ".DB::limit($start, $limit), $parameter, $this->_pk);
	}

	public function fetch_all_by_tid_fid($tids, $fids = array(), $isgroup = -1, $author = '', $subject = '', $start = 0, $limit = 0) {
		$data = array();
		$condition = $this->make_query_condition($tids, $fids, $isgroup, $author, $subject);
		$query = DB::query("SELECT * FROM %t $condition[0]".DB::limit($start, $limit), $condition[1]);
		while($value = DB::fetch($query)) {
			$data[$value['tid']] = $value;
			$this->_posttableid[$value['posttableid']][] = $value['tid'];
		}
		return $data;
	}

	public function fetch_all_by_fid($fids, $start = 0, $limit = 0, $tableid = 0) {
		$fids = dintval($fids, true);
		if($fids) {
			return DB::fetch_all("SELECT * FROM %t WHERE fid IN(%n) ".DB::limit($start, $limit), array($this->get_table_name($tableid), (array)$fids));
		}
		return array();
	}

	public function fetch_all_by_replies($number, $start = 0, $limit = 0, $glue = '>', $tableid = 0) {
		$number = dintval($number);
		if($number) {
			$glue = helper_util::check_glue($glue);
			return DB::fetch_all("SELECT * FROM %t WHERE replies{$glue}%d ".DB::limit($start, $limit), array($this->get_table_name($tableid), $number));
		}
		return array();
	}

	public function fetch_all_rank_thread($dateline, $notfid, $order = 'dateline', $start = 0, $limit = 0) {
		$parameter = array($this->get_table_name());
		$data = $fids = $wherearr = array();
		if($dateline) {
			$parameter[] = $dateline;
			$wherearr[] = 'dateline>%d';
		}
		$wherearr[] = 'displayorder>=0';
		if($notfid) {
			$parameter[] = $notfid;
			$wherearr[] = 'fid NOT IN(%n)';
		}
		$wheresql = ' WHERE '.implode(' AND ', $wherearr);
		$ordersql = !empty($order) ? ' ORDER BY '.DB::order($order, 'DESC') : '';
		$query = DB::query("SELECT tid, fid, author, authorid, subject, dateline, views, replies, favtimes,  heats FROM %t $wheresql $ordersql ".DB::limit($start, $limit), $parameter);
		while($value = DB::fetch($query)) {
			$data[$value['tid']] = $value;
			$fids[$value['fid']][$value['tid']] = $value['tid'];
		}
		if(!empty($fids)) {
			foreach(C::t('discuss_forum')->fetch_all_name_by_fid(array_keys($fids)) as $value) {
				foreach($fids[$value['fid']] as $tid) {
					$data[$tid]['forum'] = $value['name'];
				}
			}
		}
		return $data;
	}



	



	public function fetch_all_by_fid_cover_lastpost($fid, $cover = null, $starttime = 0, $endtime = 0, $start = 0, $limit = 0) {
		$parameter = array($this->get_table_name(), $fid);
		$wherearr = array('fid=%d', 'displayorder>=0');
		if($cover !== null) {
			$wherearr[] = 'cover=%d';
			$parameter[] = $cover;
		}
		if($starttime) {
			$wherearr[] = 'lastpost>%d';
			$parameter[] = $starttime;
		}
		if($endtime) {
			$wherearr[] = 'lastpost<%d';
			$parameter[] = $endtime;
		}
		$wheresql = ' WHERE '.implode(' AND ', $wherearr);
		return DB::fetch_all('SELECT * FROM %t '.$wheresql.DB::limit($start, $limit), $parameter, $this->_pk);
	}
	public function fetch_all_by_posttableid_displayorder($tableid = 0, $posttableid = 0, $displayorder = 0) {
		return DB::fetch_all('SELECT * FROM %t WHERE posttableid=%d AND displayorder>=%d ORDER BY lastpost'.DB::limit(1000), array($this->get_table_name($tableid), $posttableid, $displayorder), $this->_pk);
	}

	public function fetch_all_search($conditions, $tableid = 0, $start = 0, $limit = 0, $order = '', $sort = 'DESC', $forceindex='') {
		$ordersql = '';
		if(!empty($order)) {
			$ordersql =  " ORDER BY $order $sort ";
		}
		$data = array();
		$tlkey = !empty($conditions['inforum']) && !is_array($conditions['inforum']) ? $conditions['inforum'] : '';
		$firstpage = false;
		$defult = count($conditions) < 5 ? true : false;
		if(count($conditions) < 5) {
			foreach(array_keys($conditions) as $key) {
				if(!in_array($key, array('inforum', 'sticky', 'displayorder', 'intids'))) {
					$defult = false;
					break;
				}
			}
		}
		if(!defined('IN_MOBILE') && $defult && $conditions['sticky'] == 4 && $start == 0 && $limit && strtolower(preg_replace("/\s?/is", '', $order)) == 'displayorderdesc,lastpostdesc' && empty($sort)) {
			foreach($conditions['displayorder'] as $id) {
				if($id < 2) {
					$firstpage = true;
					if($id < 0) {
						$firstpage = false;
						break;
					}
				}
			}
			if($firstpage && !empty($tlkey) && ($ttl = getglobal('setting/memory/forum_thread_forumdisplay')) !== null && ($data = $this->fetch_cache($tlkey, 'forumdisplay_')) !== false) {
				$delusers = $this->fetch_cache('deleteuids', '');
				if(!empty($delusers)) {
					foreach($data as $tid => $value) {
						if(isset($delusers[$value['authorid']])) {
							$data = array();
						}
					}
				}
				if($data) {
					return $data;
				}
			}
		}
		$data = DB::fetch_all("SELECT * FROM ".DB::table($this->get_table_name($tableid))." $forceindex".$this->search_condition($conditions)." $ordersql ".DB::limit($start, $limit));
		if($firstpage && !empty($tlkey) && ($ttl = getglobal('setting/memory/forum_thread_forumdisplay')) !== null) {
			$this->store_cache($tlkey, $data, $ttl, 'forumdisplay_');
		}
		return $data;
	}

	
	public function fetch_all_heats() {
		$heatdateline = getglobal('timestamp') - 86400 * getglobal('setting/indexhot/days');
		$addtablesql = $addsql = '';
		if(!helper_access::check_module('group')) {
			$addtablesql = " LEFT JOIN ".DB::table('discuss_forum')." f ON f.fid = t.fid ";
			$addsql = " AND f.status IN ('0', '1') ";
		}
		return DB::fetch_all("SELECT t.tid,t.posttableid,t.views,t.dateline,t.replies,t.author,t.authorid,t.subject,t.price
				FROM ".DB::table('discuss_thread')." t $addtablesql
				WHERE t.dateline>'$heatdateline' AND t.heats>'0' AND t.displayorder>='0' $addsql ORDER BY t.heats DESC LIMIT ".(getglobal('setting/indexhot/limit') * 2));

	}

	private function make_query_condition($tids, $fids = array(), $isgroup = -1, $author = '', $subject = '', $displayorder = null, $dateline = null) {
		$parameter = array($this->get_table_name());
		$wherearr = array();
		if(!empty($tids)) {
			$tids = dintval($tids, true);
			$parameter[] = $tids;
			$wherearr[] = is_array($tids) ? 'tid IN(%n)' : 'tid=%d';
		}
		if(!empty($fids)) {
			$fids = dintval($fids, true);
			$parameter[] = $fids;
			$wherearr[] = is_array($fids) ? 'fid IN(%n)' : 'fid=%d';
		}
		if(in_array($isgroup, array(0, 1))) {
			$parameter[] = $isgroup;
			$wherearr[] = "isgroup=%d";
		}
		if(!empty($author)) {
			$parameter[] = $author;
			$wherearr[] = "author=%s";
		}
		if($displayorder !== null) {
			$parameter[] = $displayorder;
			$wherearr[] = 'displayorder=%d';
		}
		if($dateline !== null) {
			$parameter[] = getglobal('timestamp') - $dateline;
			$wherearr[] = 'dateline>=%d';
		}
		if(!empty($subject)) {
			$parameter[] = '%'.$subject.'%';
			$wherearr[] = "subject LIKE %s";
		}
		$wheresql = !empty($wherearr) && is_array($wherearr) ? ' WHERE '.implode(' AND ', $wherearr) : '';
		return array($wheresql, $parameter);
	}



	public function get_posttableid() {
		return $this->_posttableid;
	}
	public function get_url_param() {
		return $this->_urlparam;
	}

	public function update_displayorder_by_tid_displayorder($tids, $olddisplayorder, $newdisplayorder) {
		$tids = dintval((array)$tids, true);
		if($tids) {
			return DB::query('UPDATE %t SET displayorder=%d WHERE tid IN (%n) AND displayorder=%d', array($this->get_table_name(), $newdisplayorder, $tids, $olddisplayorder));
		}
		return 0;
	}

	public function update($tid, $data, $unbuffered = false, $low_priority = false, $tableid = 0, $realdata = false) {
		$tid = dintval($tid, true);
		if($data && is_array($data) && $tid) {
			if(!$realdata) {
				$num = DB::update($this->get_table_name($tableid), $data, DB::field('tid', $tid), $unbuffered, $low_priority);
				$this->update_batch_cache((array)$tid, $data);
			} else {
				$num = DB::query('UPDATE '.DB::table($this->get_table_name($tableid))." SET ".implode(',', $data)." WHERE ".DB::field('tid', $tid), 'UNBUFFERED');
				$this->clear_cache($tid);
			}
			return $num;
		}
		return !$unbuffered ? 0 : false;
	}

	public function update_by_fid($fid, $data, $tableid = 0) {
		$fid = dintval($fid, true);
		if($data && is_array($data) && $fid) {
			return DB::update($this->get_table_name($tableid), $data, DB::field('fid', $fid));
		}
		return array();
	}
	public function update_by_tid_displayorder($tid, $displayorder, $data, $fid = 0, $tableid = 0) {
		$condition = array();
		$tid = dintval($tid, true);
		$condition[] = DB::field('tid', $tid);
		if($fid) {
			$fid = dintval($fid, true);
			$condition[] = DB::field('fid', $fid);
		}
		$condition[] = DB::field('displayorder', $displayorder);
		if($data && is_array($data) && $tid) {
			return DB::update($this->get_table_name($tableid), $data, implode(' AND ', $condition));
		}
		return 0;
	}
	

	public function update_status_by_tid($tids, $value, $glue = '|') {
		$tids = dintval($tids, true);
		if($tids) {
			$this->clear_cache((array)$tids);
			$glue = helper_util::check_glue($glue);
			return DB::query("UPDATE %t SET status=status{$glue}%s WHERE tid IN(%n)", array($this->get_table_name(), $value, (array)$tids));
		}
		return 0;
	}

	

	public function increase($tids, $fieldarr, $low_priority = false, $tableid = 0, $getsetarr = false) {
		$tids = dintval((array)$tids, true);
		$sql = array();
		$num = 0;
		$allowkey = array('views', 'replies',  'favtimes', 'heats', 'lastposter', 'lastpost');
		foreach($fieldarr as $key => $value) {
			if(in_array($key, $allowkey)) {
				if(is_array($value)) {
					$sql[] = DB::field($key, $value[0]);
				} else {
					$value = dintval($value);
					$sql[] = "`$key`=`$key`+'$value'";
				}
			} else {
				unset($fieldarr[$key]);
			}
		}
		if($getsetarr) {
			return $sql;
		}
		if(!empty($sql)){
			$cmd = "UPDATE " . ($low_priority ? 'LOW_PRIORITY ' : '');
			$num = DB::query($cmd.DB::table($this->get_table_name($tableid))." SET ".implode(',', $sql)." WHERE tid IN (".dimplode($tids).")", 'UNBUFFERED');
			$this->increase_cache($tids, $fieldarr);
		}
		return $num;
	}

	public function insert($data, $return_insert_id = false, $replace = false, $silent = false) {
		if($data && is_array($data)) {
			$this->clear_cache($data['fid'], 'discussdisplay_');
			return DB::insert($this->_table, $data, $return_insert_id, $replace, $silent);
		}
		return 0;
	}

	public function insert_thread_copy_by_tid($tids, $origin = 0, $target = 0) {
		$tids = dintval($tids, true);
		if($tids) {
			$wheresql = is_array($tids) && $tids ? 'tid IN(%n)' : 'tid=%d';
			DB::query("INSERT INTO %t SELECT * FROM %t WHERE $wheresql", array($this->get_table_name($target), $this->get_table_name($origin), $tids));
		}
	}

	public function count_by_authorid($authorid, $tableid = 0) {
		return DB::result_first("SELECT COUNT(*) FROM %t t LEFT JOIN %t d ON t.fid = d.fid WHERE t.authorid=%d AND t.isdelete < 1 and t.inarchive < 1 AND d.isdelete < 1 and d.inarchive < 1", array($this->get_table_name($tableid), 'discuss', $authorid));
	}

	public function count_by_fid($fid, $tableid = 0) {
		return DB::result_first("SELECT COUNT(*) FROM %t WHERE fid=%d AND isdelete < 1", array($this->get_table_name($tableid), $fid));
	}

	public function count_by_displayorder($displayorder) {
		return DB::result_first("SELECT COUNT(*) FROM %t WHERE displayorder=%d", array($this->get_table_name(), $displayorder));
	}
	public function count_by_tid_fid_displayorder($stick, $tid=null,$fids=null,$displayorder,$glue='>=') {
		$parameter = array($this->get_table_name(), 'discuss');
		$wherearr = array();
		if(!empty($tids)) {
			$tids = dintval($tids, true);
			$parameter[] = $tids;
			$wherearr[] = is_array($tids) && $tids ? 't.tid IN(%n)' : 't.tid=%d';
		}
		if(!empty($fids)) {
			$fids = dintval($fids, true);
			$parameter[] = $fids;
			$wherearr[] = is_array($fids) && $fids ? 't.fid IN(%n)' : 't.fid=%d';
		}

		if($displayorder !== null) {
			$parameter[] = $displayorder;
			$glue = helper_util::check_glue($glue);
			$parameter[] = TIMESTAMP;
			if ($stick) {
				$wherearr[] = "(displayorder{$glue}%d and startstick < %d)";
			} else {
				$wherearr[] = "(displayorder{$glue}%d or startstick > %d)";
			}
		}
		$wherearr[] = ' (case when d.inarchive = 1 then t.isdelete < 1 and d.isdelete = 0 else d.inarchive = 0 and d.isdelete < 1 and t.inarchive < 1 and t.isdelete = 0 end)';
		if(!empty($wherearr)) {
			$wheresql = !empty($wherearr) && is_array($wherearr) ? ' WHERE '.implode(' AND ', $wherearr) : '';
			return DB::result_first("SELECT COUNT(*) FROM %t t LEFT JOIN %t d ON t.fid = d.fid $wheresql ", $parameter);
		} else {
			return 0;
		}
	}

	public function count_by_replies($number, $glue = '>') {
		$glue = helper_util::check_glue($glue);
		return DB::result_first("SELECT COUNT(*) FROM %t f LEFT JOIN %t d ON t.fid = d.fid WHERE replies{$glue}%d", array($this->get_table_name(), $number));
	}

	public function count_by_fid_typeid_displayorder($fid, $typeid = null, $displayorder = null, $glue = '=') {

		$parameter = array($this->get_table_name(), $fid);
		$wherearr = array();
		$fid = dintval($fid, true);
		$wherearr[] = is_array($fid) ? 'fid IN(%n)' : 'fid=%d';

		if($typeid) {
			$parameter[] = $typeid;
			$wherearr[] = "typeid=%d";
		}
		if($displayorder !== null) {
			$parameter[] = $displayorder;
			$glue = helper_util::check_glue($glue);
			$parameter[] = TIMESTAMP;
			$wherearr[] = "displayorder{$glue}%d or startstick > %d";
		}
		$wherearr[] = "isdelete = 0 and inarchive = 0";
		$wheresql = ' WHERE '.implode(' AND ', $wherearr);
		return DB::result_first("SELECT COUNT(*) FROM %t $wheresql", $parameter);
	}
	public function count_posts_by_fid($fid, $forcetableid = null) {
		$data = array('threads' => 0, 'posts' => 0);
		$threadtableids = array(0);
		$tableids = self::fetch_thread_table_ids();
		if(!empty($tableids)) {
			if($forcetableid === null || ($forcetableid > 0 && !in_array($forcetableid, $tableids))) {
				$threadtableids = array_merge($threadtableids, $tableids);
			} else {
				$threadtableids = array(intval($forcetableid));
			}
		}
		$threadtableids = array_unique($threadtableids);
		foreach($threadtableids as $tableid) {
			$value = DB::fetch_first('SELECT COUNT(*) AS threads, SUM(replies)+COUNT(*) AS posts FROM %t WHERE fid=%d AND displayorder>=0 AND isdelete = 0 AND inarchive = 0', array($this->get_table_name($tableid), $fid));
			$data['threads'] += intval($value['threads']);
			$data['posts'] += intval($value['posts']);
		}
		return $data;
	}
	public function count_by_fid_displayorder_authorid($fid, $displayorder, $authorid, $tableid=0) {
		return DB::result_first("SELECT COUNT(*) FROM %t WHERE fid=%d AND displayorder=%d AND authorid=%d", array($this->get_table_name($tableid), $fid, $displayorder, $authorid));
	}
	public function count_all_thread() {
		$count = 0;
		$settings['threadtableids'] =self::fetch_thread_table_ids();
		if(empty($settings['threadtableids']) || !is_array($settings['threadtableids'])) {
			$settings['threadtableids'] = array(0);
		}
		foreach($settings['threadtableids'] as $tableid) {
			$count += $this->count_by_tableid($tableid);
		}
		return $count;
	}
	public function count_by_posttableid_displayorder($tableid = 0, $posttableid = 0, $displayorder = 0) {
		return DB::result_first('SELECT COUNT(*) FROM %t WHERE posttableid=%d AND displayorder=%d', array($this->get_table_name($tableid), $posttableid, $displayorder));
	}

	public function count_by_tableid($tableid) {
		return DB::result_first("SELECT COUNT(*) FROM %t", array($this->get_table_name($tableid)));
	}

	public function count_by_tid_fid($tids, $fids = array(), $isgroup = -1, $author = '', $subject = '') {
		$condition = $this->make_query_condition($tids, $fids, $isgroup, $author, $subject);
		return DB::result_first("SELECT COUNT(*) FROM %t $condition[0]", $condition[1]);
	}

	public function delete_by_tid($tids, $unbuffered = false, $tableid = 0, $limit = 0) {
		$tids = dintval($tids, true);
		if($tids) {
			$this->clear_cache($tids);
			//C::t('discuss_newthread')->delete_by_tids($tids);
			return DB::delete($this->get_table_name($tableid), DB::field('tid', $tids), $limit, $unbuffered);
		}
		return !$unbuffered ? 0 : false;
	}
	public function delete($tids, $unbuffered = false, $tableid = 0, $limit = 0) {
		return $this->delete_by_tid($tids, $unbuffered, $tableid, $limit);
	}
	public function delete_by_fid($fid, $unbuffered = false, $tableid = 0, $limit = 0) {
		$fid = dintval($fid, true);
		if($fid) {
			foreach((array)$fid as $delfid) {
				$this->clear_cache($delfid, 'discussdisplay_');
			}
			//C::t('discuss_newthread')->delete_by_tids($fid);
			
			return DB::delete($this->get_table_name($tableid), DB::field('fid', $fid), $limit, $unbuffered);
		}
		return 0;
	}
	public function get_table_name($tableid = 0){
		$tableid = intval($tableid);
		return $tableid ? "discuss_thread_$tableid" : 'discuss_thread';
	}
	public function fetch_all_for_guide($type, $limittid, $tids = array(), $heatslimit = 3, $dateline = 0, $start = 0, $limit = 600, $fids = 0) {
		switch ($type) {
			case 'hot' :
				$addsql = ' AND heats>='.intval($heatslimit);
				break;
			case 'digest' :
				$addsql = ' AND digest>0';
				break;
			default :
				$addsql = '';
		}
		
		$tidsql = '';
		if($tids) {
			$tids = dintval($tids, true);
			$tidsql = DB::field('tid', $tids);
		} else {
			$limittid = intval($limittid);
			$tidsql = 'tid>'.$limittid;
			$fids = dintval($fids, true);
			if($fids) {
				$tidsql .= is_array($fids) && $fids ? ' AND fid IN('.dimplode($fids).')' : ' AND fid='.$fids;
			}
			if($dateline) {
				$addsql .= ' AND dateline > '.intval($dateline);
			}
			if($type == 'newthread') {
				$orderby = 'tid';
			} elseif($type == 'reply') {
				$orderby = 'lastpost';
				$addsql .= ' AND replies > 0';
			} else {
				$orderby = 'lastpost';
			}
			$addsql .= ' AND displayorder>=0 ORDER BY '.$orderby.' DESC '.DB::limit($start, $limit);

		}
		return DB::fetch_all("SELECT * FROM ".DB::table('discuss_thread')." WHERE ".$tidsql.$addsql);
	}
	public function fetch_max_tid() {
		return DB::result_first("SELECT MAX(tid) as maxtid FROM ".DB::table('discuss_thread'));
	}


	function gettablestatus($tableid = 0) {
		$table_info = DB::fetch_first("SHOW TABLE STATUS LIKE '".str_replace('_', '\_', DB::table($this->get_table_name($tableid)))."'");
		$table_info['Data_length'] = $table_info['Data_length'] / 1024 / 1024;
		$nums = intval(log($table_info['Data_length']) / log(10));
		$digits = 0;
		if($nums <= 3) {
			$digits = 3 - $nums;
		}
		$table_info['Data_length'] = number_format($table_info['Data_length'], $digits).' MB';

		$table_info['Index_length'] = $table_info['Index_length'] / 1024 / 1024;
		$nums = intval(log($table_info['Index_length']) / log(10));
		$digits = 0;
		if($nums <= 3) {
			$digits = 3 - $nums;
		}
		$table_info['Index_length'] = number_format($table_info['Index_length'], $digits).' MB';
		return $table_info;
	}


	public function create_table($maxtableid) {
		if($maxtableid) {
			DB::query('SET SQL_QUOTE_SHOW_CREATE=0', 'SILENT');
			$db = &DB::object();
			$query = DB::query("SHOW CREATE TABLE %t", array($this->get_table_name()));
			$create = $db->fetch_row($query);
			$createsql = $create[1];
			$createsql = str_replace(DB::table($this->get_table_name()), DB::table($this->get_table_name($maxtableid)), $createsql);
			DB::query($createsql);

			return true;
		} else {
			return false;
		}
	}
	public function drop_table($tableid) {
		$tableid = intval($tableid);
		if($tableid) {
			DB::query("DROP TABLE %t", array($this->get_table_name($tableid)), true);
			return true;
		} else {
			return false;
		}
	}
	private function compare_number($firstnum, $secondnum, $glue = '>=') {
		switch($glue) {
			case '==':
			case '=':
				return $firstnum == $secondnum;
				break;
			case '>':
				return $firstnum > $secondnum;
				break;
			case '<':
				return $firstnum < $secondnum;
				break;
			case '<>':
				return $firstnum <> $secondnum;
				break;
			case '<=':
				return $firstnum <= $secondnum;
				break;
			case '>=':
				return $firstnum >= $secondnum;
				break;
		}
		return false;
	}

	public function getQRcodeBytid($tid){
		$thread = $this->fetch($tid);
		$target='./qrcode/thread/'.$tid.'.png';
		if(@getimagesize(getglobal('setting/attachdir').$target)){
			return getglobal('setting/attachurl').$target;
		}else{//生成二维码
			$targetpath = dirname(getglobal('setting/attachdir').$target);
			dmkdir($targetpath);
			QRcode::png(getglobal('siteurl').MOD_URL.'&op=viewthread&fid='.$thread['fid'].'&tid='.$tid,getglobal('setting/attachdir').$target,'M',4,2);
			return getglobal('setting/attachurl').$target;
		}
	}

	public function archive_by_tid($tid) {//主题归档
		$thread = $this->fetch($tid);
		if ($thread) {
			$setarr = array('inarchive' => 1, 'archivetime' => TIMESTAMP);
			if ($this->update($tid, $setarr)) {
				$posts = DB::result_first('select count(*) from %t where tid = %d and isdelete = 0', array('discuss_post', $tid));
				C::t('discuss')->update_forum_counter($thread['fid'], 1, $posts, 0, 0, 0);
				//通知所有版主
				$uids= C::t('discuss_user')->fetch_uids_by_fid($thread['fid'],3);
				$appid=C::t('app_market')->fetch_appid_by_mod('discuss',0);
				foreach ($uids as $uid) {
					if ($uid != getglobal('uid')) {
						//发送通知
						$notevars = array(
											'from_id'=>$appid,
											'from_idtype'=>'app',
											'url'=>MOD_URL.'&op=viewthread&fid='.$thread['fid'].'&tid='.$tid,
											'author'=>getglobal('username'),
											'authorid'=>getglobal('uid'),
											'dataline'=>dgmdate(TIMESTAMP),
											'threadname'=>getstr($thread['subject'],30),
										);
						$action='thread_archive';
						$type='thread_archive_'.$tid;
						dzz_notification::notification_add($uid, $type, $action, $notevars, 0,'dzz/discuss');
					}
				}
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	public function fetch_archive($iscount = 0, $start = 0, $size = 20, $orderby = 'arhtime'){
		global $_G;
		$param = array($this->_table, 'discuss');
		$where = '';
		if (!$_G['adminid']) {
			$fids = array_keys(C::t('discuss_user')->fetch_all_by_uid($_G['uid']));
			$where = ' and t.fid in(%n)';
			$param[] = $fids;
		}
		if ($iscount) {
			return DB::result_first('select count(*) from %t t left join %t d on t.fid = d.fid where d.inarchive = 0 and t.inarchive = 1'.$where, $param);
		}
		$limit = ' limit '.$start.','.$size;
		$order = $orderby == 'arhtime' ? ' order by t.archivetime desc' : ' order by t.dateline desc';
		$data = DB::fetch_all('select t.*,d.name from %t t left join %t d on t.fid = d.fid where d.inarchive = 0 and t.inarchive = 1'.$where.$order.$limit, $param, 'tid');
		foreach ($data as $key => $value) {
			$data[$key]['name'] = emoji_decode($value['name']);
			$data[$key]['subject'] = emoji_decode($value['subject']);
		}
		return $data;
	}


	public function clean_thread_modopt_by_fid($fid) {
		return DB::update($this->_table, array('digest' => 0, 'highlight' => '', 'displayorder' => 0, 'startstick' => 0, 'starthighlight' => 0, 'startdigest' => 0), array('fid' => $fid));
	}

}

?>
