<?php
function saxue_randcode( $_len, $_isnum = false ) {
		if ( $_isnum ) {
				$_str = "1234567890";
		} else {
				$_str = "23456789abcdefghijkmnpqrstuvwxwzABCDEFGHIJKLMNPQRSTUVWXYZ";
		}
		$_result = "";
		$A = strlen( $_str ) - 1;
		srand( ( double )microtime() * 1000000 );
		$_i = 0;
		for ( ; $_i < $_len; ++$_i ) {
				$_num = rand( 0, $A );
				$_result .= $_str[$_num];
		} 
		return $_result;
} 

function draw_digit( $_x, $m, $_code ) {
		global $sx;
		global $sy;
		global $pixels;
		global $digits;
		global $lines;
		$_code = $digits[$_code];
		$_f = 6;
		$_g = 1;
		$_i = 0;
		for ( ; $_i < 7; ++$_i, $_g *= 2 ) {
				if ( ( $_g &$_code ) != $_g ) {
						continue;
				} 
				$_j = $_i * 4;
				$_s1 = $lines[$_j] * $_f + $_x;
				$_s2 = $lines[$_j + 1] * $_f + $m;
				$_s3 = $lines[$_j + 2] * $_f + $_x;
				$_s4 = $lines[$_j + 3] * $_f + $m;
				if ( $_s1 == $_s3 ) {
						$_pi = 3 * ( $sx * $_s2 + $_s1 );
						$M = $_s2;
						for ( ; $M <= $_s4; ++$M, $_pi += 3 * $sx ) {
								$pixels[$_pi] = chr( 0 );
								$pixels[$_pi + 1] = chr( 0 );
								$pixels[$_pi + 2] = chr( 0 );
						} 
				} else {
						$_pi = 3 * ( $sx * $_s2 + $_s1 );
						$_p = $_s1;
						for ( ; $_p <= $_s3; ++$_p ) {
								$pixels[$_pi++] = chr( 0 );
								$pixels[$_pi++] = chr( 0 );
								$pixels[$_pi++] = chr( 0 );
						} 
				} 
		} 
} 

function add_chunk( $_type ) {
		global $result;
		global $data;
		global $chunk;
		global $crc_table;
		$_len = strlen( $data );
		$chunk = pack( "c*", $_len >> 24 &255, $_len >> 16 &255, $_len >> 8 &255, $_len &255 );
		$chunk .= $_type;
		$chunk .= $data;
		$_z = 16777215;
		$_z |= -16777216;
		$_C = $_z;
		$p = 4;
		for ( ; $p < strlen( $chunk ); ++$p ) {
				$_H = $_C >> 8 &16777215;
				$_C = $crc_table[( $_C ^ ord( $chunk[$p] ) ) &255] ^ $_H;
		} 
		$_bi = $_C ^ $_z;
		$chunk .= chr( $_bi >> 24 &255 );
		$chunk .= chr( $_bi >> 16 &255 );
		$chunk .= chr( $_bi >> 8 &255 );
		$chunk .= chr( $_bi &255 );
		$result .= $chunk;
} 

@session_start();
if ( function_exists( 'date_default_timezone_set' ) ) date_default_timezone_set( 'Etc/GMT-8' );
header( "Last-Modified: " . date( "D, d M Y H:i:s", time() ) . " GMT" );
define( "CHECK_CODE_LENGTH", 4 ); //字符个数
if ( !empty( $_GET['h'] ) && is_numeric( $_GET['h'] ) ) {
		define( "CHECK_CODE_HEIGHT", $_GET['h'] ); //图片高
} else {
		define( "CHECK_CODE_HEIGHT", 24 ); //图片高
}
define( "CHECK_CODE_WIDTH", 10 ); //单字符宽
define( "CHECK_CODE_SPACEX", 6 ); //字符与图片左右间距
define( "CHECK_CODE_SPACEY", 4 ); //字符与图片上下间距
define( "CHECK_CODE_SPACEM", 3 ); //字符间隔
header( "Content-type: image/png" );
$digits = array( 95, 5, 118, 117, 45, 121, 123, 69, 127, 125 );
$lines = array( 1, 1, 1, 2, 0, 1, 0, 2, 1, 0, 1, 1, 0, 0, 0, 1, 0, 2, 1, 2, 0, 1, 1, 1, 0, 0, 1, 0 );
$sx = CHECK_CODE_WIDTH * CHECK_CODE_LENGTH + CHECK_CODE_SPACEM * ( CHECK_CODE_LENGTH - 1 ) + CHECK_CODE_SPACEX + CHECK_CODE_SPACEX;
$sy = CHECK_CODE_HEIGHT;
if ( isset( $_GET['v'] ) ) $_GET['v'] = trim( $_GET['v'] );
if ( function_exists( "gd_info" ) ) {
		$checkcode = saxue_randcode( CHECK_CODE_LENGTH );
		if ( !empty( $_GET['v'] ) ) $GLOBALS['_SESSION'][$_GET['v']] = strtolower( $checkcode );
		else $GLOBALS['_SESSION']['saxueCheckCode'] = strtolower( $checkcode );
		$im = imagecreate( $sx, $sy );
        $r = Array(225, 255, 255, 223);
        $g = Array(225, 236, 237, 255);
        $b = Array(225, 236, 166, 125);
        $key = mt_rand(0, 3);
        $backColor = imagecolorallocate($im, $r[$key], $g[$key], $b[$key]);    //背景色（随机）
        $stringColor = imagecolorallocate($im, mt_rand(0, 200), mt_rand(0, 120), mt_rand(0, 120));    //字符颜色（随机）
        //$borderColor = imagecolorallocate($im, 100, 100, 100);                    //边框色
        imagefilledrectangle($im, 0, 0, $sx - 1, $sy - 1, $backColor);
        //imagerectangle($im, 0, 0, $sx - 1, $sy - 1, $borderColor);
        // 干扰
        for ($i = 0; $i < 10; $i++) {
            imagearc($im, mt_rand(-10, $sx), mt_rand(-10, $sy), mt_rand(30, 300), mt_rand(20, 200), 55, 44, $stringColor);
        }
        for ($i = 0; $i < 25; $i++) {
            imagesetpixel($im, mt_rand(0, $sx), mt_rand(0, $sy), $stringColor);
        }
        for ($i = 0; $i < CHECK_CODE_LENGTH; $i++) {
            imagestring($im, 5, $i * 10 + 5, mt_rand(1, 8), $checkcode{$i}, $stringColor);
        }
		imagepng( $im );
		imagedestroy( $im );
} else {
		$checkcode = saxue_randcode( CHECK_CODE_LENGTH, true );
		if ( !empty( $_GET['v'] ) ) $GLOBALS['_SESSION'][$_GET['v']] = strtolower( $checkcode );
		else $GLOBALS['_SESSION']['saxueCheckCode'] = strtolower( $checkcode );
		$pixels = "";
		$h = 0;
		for ( ; $h < $sy; ++$h ) {
				$w = 0;
				for ( ; $w < $sx; ++$w ) {
						$r = 100 / $sx * $w + 155;
						$g = 100 / $sy * $h + 155;
						$b = 255 - 100 / ( $sx + $sy ) * ( $w + $h );
						$pixels .= chr( $r );
						$pixels .= chr( $g );
						$pixels .= chr( $b );
				} 
		} 
		$x = CHECK_CODE_SPACEX;
		$i = 0;
		for ( ; $i < CHECK_CODE_LENGTH; ++$i ) {
				draw_digit( $x, CHECK_CODE_SPACEY, substr( $checkcode, $i, 1 ) );
				$x += CHECK_CODE_WIDTH + CHECK_CODE_SPACEM;
		} 
		$z = -306674912;
		$n = 0;
		for ( ; $n < 256; ++$n ) {
				$c = $n;
				$k = 0;
				for ( ; $k < 8; ++$k ) {
						$c2 = $c >> 1 &2147483647;
						if ( $c &1 ) {
								$c = $z ^ $c2;
						} else {
								$c = $c2;
						} 
				} 
				$crc_table[$n] = $c;
		} 
		$result = pack( "c*", 137, 80, 78, 71, 13, 10, 26, 10 );
		$data = pack( "c*", $sx >> 24 &255, $sx >> 16 &255, $sx >> 8 &255, $sx &255, $sy >> 24 &255, $sy >> 16 &255, $sy >> 8 &255, $sy &255, 8, 2, 0, 0, 0 );
		add_chunk( "IHDR" );
		$len = ( $sx * 3 + 1 ) * $sy;
		$data = pack( "c*", 120, 1, 1, $len &255, $len >> 8 &255, 255 - ( $len &255 ), 255 - ( $len >> 8 &255 ) );
		$start = strlen( $data );
		$i2 = 0;
		$h = 0;
		for ( ; $h < $sy; ++$h ) {
				$data .= chr( 0 );
				$w = 0;
				for ( ; $w < $sx * 3; ++$w ) {
						$data .= $pixels[$i2++];
				} 
		} 
		$s1 = 1;
		$s2 = 0;
		$n = $start;
		for ( ; $n < strlen( $data ); ++$n ) {
				$s1 = ( $s1 + ord( $data[$n] ) ) % 65521;
				$s2 = ( $s2 + $s1 ) % 65521;
		} 
		$adler = $s2 << 16 | $s1;
		$data .= chr( $adler >> 24 &255 );
		$data .= chr( $adler >> 16 &255 );
		$data .= chr( $adler >> 8 &255 );
		$data .= chr( $adler &255 );
		add_chunk( "IDAT" );
		$data = "";
		add_chunk( "IEND" );
		echo $result;
} 
