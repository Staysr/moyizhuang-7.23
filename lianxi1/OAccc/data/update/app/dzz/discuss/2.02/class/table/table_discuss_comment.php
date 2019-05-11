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
class table_discuss_comment extends dzz_table
{
	public function __construct() {

		$this->_table = 'discuss_comment';
		$this->_pk    = 'cid';

		parent::__construct();
	}

	public function insert($setarr)
	{
		return parent::insert($setarr, 1);
	}

	public function fetch($cid, $first = 0)
	{
		$cid = is_array($cid) ? $cid : array($cid);
		$cmt = DB::fetch_all('select * from %t where cid in(%n)', array($this->_table, $cid), 'cid');
		foreach ($cmt as $k => $v) {
			$rcmt = $this->get_reply_by_cid($k);
			$author = C::t('user')->fetch_all_username_by_uid($v['uid']);
			$cmt[$k]['author'] = $author[$v['uid']];
			if ($v['reuid']) {
				$re = C::t('user')->fetch_all_username_by_uid($v['reuid']);
				$cmt[$k]['replyer'] = $re[$v['reuid']];
			}
			$cmt[$k]['replys'] = $rcmt;
		}
		if ($first) {
			return $cmt[$cid[0]];
		} else {
			return $cmt;
		}
	}

	//获取帖子的评论
	public function get_cmt_by_pid($pid, $start = 0, $iscount = 0, $size = 5)
	{
		include_once libfile('function/code');
		$limit = ' limit '.$start.', '.$size;
		if ($pid) {
			if ($iscount) return DB::result_first('select count(*) from %t where pid = %d and pcid = 0', array($this->_table, $pid));
			$cmts = DB::fetch_all('select * from %t where pid = %d and pcid = 0 order by time desc'.$limit, array($this->_table, $pid), 'cid');
			foreach ($cmts as $k => $v) {
				$cmts[$k]['content'] = emoji_decode(dzzcode($v['content']));
				$author = C::t('user')->fetch_all_username_by_uid($v['uid']);
				$cmts[$k]['author'] = $author[$v['uid']];
				if (!$value['pcid']) {
					$cmts[$k]['replycount'] = $this->get_reply_by_cid($v['cid'], 0, 1);
					$cmts[$k]['replys'] = $this->get_reply_by_cid($v['cid']);
				}
			}
			return $cmts;
		} else {
			return array();
		}
	}


	//获取评论的回复评论
	public function get_reply_by_cid($cid, $start = 0, $iscount = 0)
	{
		include_once libfile('function/code');
		$size = 5;
		$limit = ' limit '.$start.', '.$size;
		$cmt = parent::fetch($cid);
		if ($cmt) {
			if ($iscount) return DB::result_first('select count(*) from %t where pcid = %d', array($this->_table, $cid));
			$cmts = DB::fetch_all('select * from %t where pcid = %d'.$limit, array($this->_table, $cid), 'cid');
			foreach ($cmts as $k => $v) {
				$cmts[$k]['content'] = emoji_decode(dzzcode($v['content']));
				$author = C::t('user')->fetch_all_username_by_uid($v['uid']);
				$cmts[$k]['author'] = $author[$v['uid']];
				$re = C::t('user')->fetch_all_username_by_uid($v['reuid']);
				$cmts[$k]['replyer'] = $re[$v['reuid']];
			}
			return $cmts;
		} else {
			return array();
		}
	}

	//删除评论
	public function delete_cmt($cid)
	{

		if (parent::delete($cid)) {
			DB::delete($this->_table, array('pcid' => $cid));
			return 1;
		} else {
			return 0;
		}
	}

	//删除评论
	public function delete_cmt_by_pid($pid)
	{
		return DB::delete($this->_table, array('pid' => $pid));
	}

	//删除评论
	public function delete_cmt_by_tid($tid)
	{
		return DB::delete($this->_table, array('tid' => $tid));
	}

	//我的评论
	public function my_comment($uid = 0, $iscount = 0,$start = 0, $size = 20, $order = 'dateline')
	{
		include_once libfile('function/code');
		$uid = $uid ? $uid : getglobal('uid');
		$wherearr = array('c.uid = %d', 'd.isdelete = 0', 'd.inarchive = 0', 't.isdelete = 0', 't.inarchive = 0');
		$params = array($this->_table, 'discuss', 'discuss_thread', $uid);
		if ($iscount) {
			return DB::result_first('select count(*) from %t c left join %t d on c.fid = d.fid left join %t t on c.tid = t.tid where '.implode(' and ', $wherearr), $params);
		}
		$limit = ' limit '.$start.','.$size;
		if ($order == 'dateline') {
			$list = DB::fetch_all('select * from %t c left join %t d on c.fid = d.fid left join %t t on c.tid = t.tid where '.implode(' and ', $wherearr).' order by time desc'.$limit, $params, 'rid');
		} else {
			array_splice($params,3, 0, array('discuss_post'));
			$list = DB::fetch_all('select c.*,t.subject from %t c left join %t d on c.fid = d.fid left join %t t on c.tid = t.tid left join %t p on c.pid = p.pid where c.uid = %d order by p.dateline desc,c.time desc'.$limit, $params, 'rid');
		}
		foreach ($list as $k => $v) {
			$discuss = C::t('discuss')->fetch_by_fid($v['fid'], $_G['uid']);
			$list[$k]['content'] = dzzcode(emoji_decode($v['content']));
			if ($discuss['viewperm'] == 0 || $discuss['users'][$uid]) {
				$post = C::t('discuss_post')->fetch('tid:'.$v['tid'], $v['pid']);
				$patterns = array('/<img(.*?)src=\"(.*?)\"(.*?)>/is', '/<table[^>]*?>(.*?)<\/table>/s');
				$replace = array(' [图片] ', ' [表格] ');
				$post['message'] = preg_replace($patterns, $replace, $post['message']);
				$post['message'] = strip_tags($post['message'], '<a>');
				$list[$k]['post'] = $post;
			} else {
				$list[$k]['noviewpost'] = 1;
			}
		}
		return $list;
	}

	//我收到的评论
	public function received_comment($uid = 0, $iscount = 0, $start = 0, $size = 20, $order = 'dateline')
	{
		include_once libfile('function/code');
		global $_G;
		$uid = $uid ? $uid : $_G['uid'];
		$params = array($this->_table, 'discuss', 'discuss_thread', $uid, $uid);
		if ($_G['adminid']) {
			$wherearr = array('pauthorid = %d', 'c.uid <> %d', 'd.isdelete = 0', 'd.inarchive = 0', 't.isdelete = 0', 't.inarchive = 0');	
		} else {
			$fids = array_keys(C::t('discuss_user')->fetch_all_by_uid($uid));
			$params[] = $fids;
			$wherearr = array('pauthorid = %d', 'c.uid <> %d', 'd.isdelete = 0', 'd.inarchive = 0', 'd.fid in(%n)');
		}
		
		if ($iscount) {
			return DB::result_first('select count(*) from %t c left join %t d on c.fid = d.fid left join %t t on c.tid = t.tid where '.implode(' and ', $wherearr), $params);
		}
		$limit = ' limit '.$start.','.$size;
		if ($order == 'dateline') {
			$list = DB::fetch_all('select c.* from %t c left join %t d on c.fid = d.fid left join %t t on c.tid = t.tid where '.implode(' and ', $wherearr).' order by c.time desc'.$limit, $params, 'rid');
		} else {
			array_splice($params,3, 0, array('discuss_post'));
			$list = DB::fetch_all('select c.* from %t c left join %t d on c.fid = d.fid left join %t t on c.tid = t.tid left join %t p on c.pid = p.pid where '.implode(' and ', $wherearr).' order by p.dateline desc, c.time desc'.$limit, $params, 'rid');
		}

		foreach ($list as $k => $v) {
			$list[$k]['content'] = dzzcode(emoji_decode($v['content']));
			$discuss = C::t('discuss')->fetch_by_fid($v['fid'], $_G['uid']);
			$post = C::t('discuss_post')->fetch('tid:'.$v['tid'], $v['pid']);
			$patterns = array(
								'/<img(.*?)src=\"(.*?)\"(.*?)>/is', 
								'/<table[^>]*?>(.*?)<\/table>/s'
							);
			$replace = array(' [图片] ', ' [表格] ');
			$post['message'] = preg_replace($patterns, $replace, $post['message']);
			$post['message'] = strip_tags($post['message'], '<a>');
			$list[$k]['post'] = $post;
			$author = C::t('user')->fetch_all_username_by_uid($v['uid']);
			$list[$k]['author'] = $author[$v['uid']];
		}
		return $list;
	}

	public function delete_cmt_by_fid($fid) {
		return DB::delete($this->_table, array('fid' => $fid));
	}
}

?>
