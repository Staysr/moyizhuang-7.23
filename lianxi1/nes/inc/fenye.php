<?php
function getPageHtml($xzv_5, $xzv_9, $xzv_11) {
	$xzv_0 = 5;
	$xzv_5 = $xzv_5 < 1 ? 1 : $xzv_5;
	$xzv_5 = $xzv_5 > $xzv_9 ? $xzv_9 : $xzv_5;
	$xzv_9 = $xzv_9 < $xzv_5 ? $xzv_5 : $xzv_9;
	$xzv_10 = $xzv_5 - floor($xzv_0 / 2);
	$xzv_10 = $xzv_10 < 1 ? 1 : $xzv_10;
	$xzv_6 = $xzv_5 + floor($xzv_0 / 2);
	$xzv_6 = $xzv_6 > $xzv_9 ? $xzv_9 : $xzv_6;
	$xzv_7 = $xzv_6 - $xzv_10 + 1;
	if ($xzv_7 < $xzv_0 && $xzv_10 > 1) {
		$xzv_10 = $xzv_10 - ($xzv_0 - $xzv_7);
		$xzv_10 = $xzv_10 < 1 ? 1 : $xzv_10;
		$xzv_7 = $xzv_6 - $xzv_10 + 1;
	}
	if ($xzv_7 < $xzv_0 && $xzv_6 < $xzv_9) {
		$xzv_6 = $xzv_6 + ($xzv_0 - $xzv_7);
		$xzv_6 = $xzv_6 > $xzv_9 ? $xzv_9 : $xzv_6;
	}
	if ($xzv_5 > 1) {
		$xzv_8.= '<a  title="上一页" href="' . $xzv_11 . ($xzv_5 - 1) . '&page=' . ($xzv_5 - 1) . '"">上一页</a>';
	}
	for ($xzv_3 = $xzv_10;$xzv_3 <= $xzv_6;$xzv_3++) {
		if ($xzv_3 == $xzv_5) {
			$xzv_8.= '<a style="background:#ff6651;"><font color="#fff">' . $xzv_3 . '</font></a>';
		} else {
			$xzv_8.= '<a href="' . $xzv_11 . $xzv_3 . '&page=' . $xzv_3 . '">' . $xzv_3 . '</a>';
		}
	}
	if ($xzv_5 < $xzv_6) {
		$xzv_8.= '<a  title="下一页" href="' . $xzv_11 . ($xzv_5 + 1) . '&page=' . ($xzv_5 + 1) . '"">下一页</a>';
	}
	return $xzv_8;
} ?>