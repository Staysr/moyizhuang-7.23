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
if($_GET['position'] == 'getdiscuss') {
	$threadtypes = array();
	if ($discuss['threadtypes']['available']) {
		$types = C::t('discuss_threadclass')->fetch_all_by_fid($discuss['fid']);
		foreach ($types as $k => $v) {
			if ($discuss['perm'] > 2) {
				if ($v['enable'] || $v['moderators']) {
					$threadtypes[] = array('typeid' => $v['typeid'], 'name' => $v['name']);
				}
			} else {
				if ($v['enable']) {
					$threadtypes[] = array('typeid' => $v['typeid'], 'name' => $v['name']);
				}
			}
		}
	}
	exit(json_encode(array('rules' => dzzcode($discuss['rules']), 'anonymous' => $discuss['anonymous'], 'threadtypes' => $threadtypes)));
}


?>
