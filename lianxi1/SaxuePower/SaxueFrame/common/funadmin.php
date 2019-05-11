<?php
function saxue_getsort( $str, $field = '', $sort = '', $order = 'desc' ) {
		if ( $field == '' ) return $str;
		$sortstr = '<a href="javascript:void(0)" onclick="formSort(\'' . $field . '\',\'' . $sort . '\',\'' . $order . '\')">' . $str;
		if ( $field != $sort ) $sortstr .= '<img src="' . SAXUE_SKIN_SERVER . '/icon/sort.png" align="absmiddle"></a>';
		else $sortstr .= '<img src="' . SAXUE_SKIN_SERVER . '/icon/' . $order . '.png" align="absmiddle"></a>';
		return $sortstr;
} 
function saxue_geticon( $action = 'add', $alt = '', $role = 1 ) {
		$action .= $role ? '' : '_off';
		//return '<img src="' . SAXUE_SKIN_SERVER . '/icon/' . $action . '.png" align="absmiddle" title="' . $alt . '" style="margin-right:10px;" />';
		return "<img src='" . SAXUE_SKIN_SERVER . "/icon/" . $action . ".png' align='absmiddle' title='" . $alt . "' style='margin-right:10px;' />";
} 