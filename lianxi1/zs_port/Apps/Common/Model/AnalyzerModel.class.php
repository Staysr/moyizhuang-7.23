<?php

/**
 * 数据传输加密解密类
 */

namespace Common\Model;

class AnalyzerModel {

    private $_mKey = ""; //原始值，最终配置为准

    public function __construct($sKey = "") {
	if (!empty($sKey)) {
	    $this->_mKey = $sKey;
	}
    }

    public function encrypt($input) {
	if (!empty($input)) {
	    $size = mcrypt_get_block_size('des', 'ecb');
	    $input = $this->pkcs5_pad($input, $size);
	    $key = $this->_mKey;
	    $td = mcrypt_module_open('des', '', 'ecb', '');
	    $iv = @mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
	    @mcrypt_generic_init($td, $key, $iv);

	    $data = mcrypt_generic($td, $input);
	    mcrypt_generic_deinit($td);
	    mcrypt_module_close($td);
	    return urlencode(base64_encode($data));
	} else {
	    return "";
	}
    }

    public function decrypt($encrypted) {
	//file_put_contents("../Log/".date("Ymd").".log", date("Y-m-d H:i:s")." POST:".$encrypted."\r\n",FILE_APPEND);
	if (!empty($encrypted)) {
	    $encrypted = base64_decode(urldecode($encrypted));
	    $key = $this->_mKey;
	    $td = mcrypt_module_open('des', '', 'ecb', '');
	    $iv = @mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
	    $ks = mcrypt_enc_get_key_size($td);
	    @mcrypt_generic_init($td, $key, $iv);
	    $decrypted = mdecrypt_generic($td, $encrypted);
	    mcrypt_generic_deinit($td);
	    mcrypt_module_close($td);
	    $sResult = $this->pkcs5_unpad($decrypted);
	    //file_put_contents("../Log/".date("Ymd").".log", date("Y-m-d H:i:s")." DECRYPT:".$sResult."\r\n",FILE_APPEND);
	    return $sResult;
	} else {
	    return "";
	}
    }

    private function pkcs5_pad($text, $blocksize) {
	$pad = $blocksize - (strlen($text) % $blocksize);
	return $text . str_repeat(chr($pad), $pad);
    }

    private function pkcs5_unpad($text) {
	$pad = ord($text{strlen($text) - 1});
	if ($pad > strlen($text))
	    return false;
	if (strspn($text, chr($pad), strlen($text) - $pad) != $pad)
	    return false;
	return substr($text, 0, -1 * $pad);
    }

}

?>