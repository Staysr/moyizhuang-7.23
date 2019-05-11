<?php
/*
��ȷ������libcurl�汾�Ƿ�֧��˫����֤���汾����7.20.1
*/


function curl_post_ssl($url, $vars, $second=30,$aHeader=array()){
	$ch = curl_init();
	//��ʱʱ��
	curl_setopt($ch,CURLOPT_TIMEOUT,$second);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
	//�������ô�������еĻ�
	//curl_setopt($ch,CURLOPT_PROXY, '10.206.30.98');
	//curl_setopt($ch,CURLOPT_PROXYPORT, 8080);
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
	curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
	
	//�������ַ�ʽ��ѡ��һ��
	
	//��һ�ַ�����cert �� key �ֱ���������.pem�ļ�
	//Ĭ�ϸ�ʽΪPEM������ע��
	// curl_setopt($ch,CURLOPT_SSLCERTTYPE,'PEM');
	// curl_setopt($ch,CURLOPT_SSLCERT,getcwd().'/cert.pem');
	//Ĭ�ϸ�ʽΪPEM������ע��
	// curl_setopt($ch,CURLOPT_SSLKEYTYPE,'PEM');
	// curl_setopt($ch,CURLOPT_SSLKEY,getcwd().'/private.pem');
	
	//�ڶ��ַ�ʽ�������ļ��ϳ�һ��.pem�ļ�
	curl_setopt($ch,CURLOPT_SSLCERT,getcwd().'/all.pem');
 
	if( count($aHeader) >= 1 ){
		curl_setopt($ch, CURLOPT_HTTPHEADER, $aHeader);
	}
 
	curl_setopt($ch,CURLOPT_POST, 1);
	curl_setopt($ch,CURLOPT_POSTFIELDS,$vars);
	$data = curl_exec($ch);
	if($data){
		curl_close($ch);
		return $data;
	}else { 
		$error = curl_errno($ch);
		echo "call faild, errorCode:$error\n"; 
		curl_close($ch);
		return false;
	}
}

$data = curl_post_ssl('https://api.mch.weixin.qq.com/secapi/pay/refund', 'merchantid=1001000');
print_r($data);
