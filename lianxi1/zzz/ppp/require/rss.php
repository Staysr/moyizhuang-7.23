<?php
!defined('IN_PHPVOD') && exit('Forbidden');

function print_rss($cid,$listnum,$updatetime)
{
	global $db,$db_wwwname,$db_wwwurl,$db_charset,$db_htmifopen,$db_dir,$db_ext,$timestamp,$imgpath,$stylepath,$version,$vertype;
	$cache_path = PHPVOD_ROOT . 'data/cache/rss_' . $cid . '_cache.xml';

	if(!file_exists($cache_path) || $timestamp - filemtime($cache_path) > $updatetime * 60)
	{
		include PHPVOD_ROOT . 'data/cache/class.php';

		$sql = '';
		if($cid)
		{
			if(!isset($_class[$cid]) || $_class[$cid]['allowvisit'] != '' || $_class[$cid]['type'] != 'free')
			{
				echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=rss.php'>";
				exit();
			}
			else
			{
				$description = "Latest $listnum article of " . $_class[$cid]['caption'];

				if($_class[$cid]['cup'] == '0') //版块
				{
					$cids = getsubcid($cid);
					$sql = "WHERE v.cid IN($cids) AND v.yz='1' ORDER BY v.lastdate DESC LIMIT $listnum";
				}
				else //栏目
				{
					$sql = "WHERE v.cid='$cid' AND v.yz='1' ORDER BY v.lastdate DESC LIMIT $listnum";
				}
			}
		}
		else
		{
			$cids = getsubcid('-1');
			$description = "Latest $listnum article of all";
			if($cids)
			{
				$sql = "WHERE v.cid IN($cids) AND v.yz='1' ORDER BY lastdate DESC LIMIT $listnum";
			}
		}

		$channel = array('title' => $db_wwwname, 'link' => $db_wwwurl, 'description' => $description, 'copyright' => "Copyright(C) $db_wwwname", 'generator' => "PHPvod $version $vertype", 'lastBuildDate' => get_date($timestamp,'r'));
		$image = array('url' => "$db_wwwurl/$imgpath/$stylepath/rss.gif", 'title' => "PHPvod $version $vertype", 'link' => $db_wwwurl, 'description' => $db_wwwname);

		$rss = new rss(array('xml' => "1.0", 'rss' => "2.0", 'encoding' => $db_charset));
		$rss->channel($channel);
		$rss->image($image);

		if($sql)
		{
			$query = $db->query("SELECT v.vid,v.cid,v.subject,v.author,v.postdate,vd.synopsis FROM pv_video AS v LEFT JOIN pv_videodata AS vd ON v.vid=vd.vid $sql");
			while($rt = $db->fetch_array($query))
			{
				$rt['synopsis'] = pv_substr($rt['synopsis'], 300);
				$link = pv_url('read.php?vid=' . $rt['vid'], true);
				$item = array('title' => $rt['subject'], 'description' => $rt['synopsis'], 'link' => $link, 'author' => $rt['author'], 'category' => $_class[$rt['cid']]['caption'], 'pubdate' => get_date($rt['postdate'],'r'));
				$rss->item($item);
			}
		}
		$rss->generate($cache_path);
	}

	header("Content-type: application/xml");
	@readfile($cache_path);
}


class rss
{

	var $rssHeader;
	var $rssChannel;
	var $rssImage;
	var $rssItem;

	function __construct($rss = array('xml'=>"1.0",'rss'=>"2.0",'encoding'=>"utf-8"))
	{

		$this->rssHeader = "<?xml version=\"$rss[xml]\" encoding=\"$rss[encoding]\"?>\n";
		$this->rssHeader .= "<rss version=\"$rss[rss]\">\n";
	}

	function channel($channel)
	{

		$this->rssChannel = "<channel>\n";
		foreach($channel as $key => $value)
		{
			$this->rssChannel .= " <$key><![CDATA[" . $value . "]]></$key>\n";
		}
	}

	function image($image)
	{

		$this->rssImage = "  <image>\n";
		foreach($image as $key => $value)
		{
			$this->rssImage .= " <$key><![CDATA[" . $value . "]]></$key>\n";
		}
		$this->rssImage .= "  </image>\n";
	}

	function item($item)
	{

		$this->rssItem .= "<item>\n";
		foreach($item as $key => $value)
		{
			$this->rssItem .= " <$key><![CDATA[" . $value . "]]></$key>\n";
		}
		$this->rssItem .= "</item>\n";
	}

	function generate($rss_path)
	{
		$all = $this->rssHeader;
		$all .= $this->rssChannel;
		$all .= $this->rssImage;
		$all .= $this->rssItem;
		$all .= "</channel></rss>";
		writeover($rss_path, $all);
	}
}
?>