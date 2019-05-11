<?php
function httpPost($url, $parms) {
    $url = $url . $parms;
    print_r($parms);
    die();
    if (($ch = curl_init($url)) == false) {
        throw new Exception(sprintf("curl_init error for url %s.", $url));
    }
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 600);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    if (is_array($parms)) {
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: multipart/form-data;'));
    }
    $postResult = @curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if ($postResult === false || $http_code != 200 || curl_errno($ch)) {
        $error = curl_error($ch);
        curl_close($ch);
        throw new Exception("HTTP POST FAILED:$error");
    } else {
        // $postResult=str_replace("\xEF\xBB\xBF", '', $postResult);
        switch (curl_getinfo($ch, CURLINFO_CONTENT_TYPE)) {
            case 'application/json':
                $postResult = json_decode($postResult);
                break;
        }
        curl_close($ch);
        return $postResult;
    }
}
 
$postUrl = "http://pujia.test.com/api/server.php";
 
$p=$_GET['p'];
if ($p =="selectuserinfo") {
 
    $username = $_GET['username'];
    $parms = "?action=selectuserinfo&username=" . $username . "";
 
} elseif ($p =="adduserinfo") {
 
    $username = $_GET['username'];
    $userpassword = $_GET['userpassword'];
    $parms = "?action=adduserinfo&username=" . $username . "&userpassword=" . $userpassword . "";
 
} elseif ($p =="userlogin") {
    $username = $_GET['username'];
    $userpassword = $_GET['userpassword'];
    $parms = "?action=userlogin&username=" . $username . "&userpassword=" . $userpassword . "";
 
}
$res = httpPost($postUrl, $parms); //$parms
$res = json_decode($res);
print_r(urldecode(json_encode($res)));
?>
