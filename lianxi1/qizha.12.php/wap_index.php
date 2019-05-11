<?php
/**
 *
 *****************************************************************************************************
 *    如果您通过浏览器访问网站时看到了这个提示，那么我们很遗憾地通知您，您的空间不支持 PHP 。
 *    也就是说，您的空间可能是静态空间，或没有安装PHP，或没有为 Web 服务器打开 PHP 支持。
 *    Sorry, PHP is not installed on your web hosting if you see this prompt.
 *    Please check out the PHP configuration.
 *
 *    如您使用虚拟主机：
 *
 *        > 联系空间商，更换空间为支持 PHP 的空间。
 *        > Contact your service provider, and let them provice a new service which supports PHP.
 *
 *
 *    如您自行搭建服务器，推荐您：
 *    Configuring manually? Recommend:
 *
 *        > 访问 PHP 官方网站获取安装帮助。
 *        > Visit PHP Official Website to get the documentation of installion and configuration.
 *        > 如果您需要ASP版本，请前往 https://www.s-cms.cn/download.html?code=asp 进行下载
 *
 ******************************************************************************************************
 */

if (file_get_contents("data/first.txt") == "1") {
    Header("Location: install.php");
    die();
}

require 'conn/conn.php';
require 'conn/function.php';
require 'qq/include.php';


if ($_GET["action"] == "update_dir") {
    mysqli_query($conn, "update SL_config set C_dir='" . splitx( $_SERVER["PHP_SELF"], "wap_index.php",0) . "'");
    box("更新成功！", "wap_index.php", "success");
}
if (substr($_SERVER["PHP_SELF"], -13) == "wap_index.php" && $C_dir != splitx( $_SERVER["PHP_SELF"], "wap_index.php",0)) {
    echo ("系统检测到您移动了安装目录，是否更新数据库？（<a href='?action=update_dir'>是</a>/否）" . splitx( $_SERVER["PHP_SELF"], "wap_index.php",0));
}
$S_page = $_GET["page"];

if ($_GET["type"] == "") {
    $U_type = "index";
} else {
    $U_type = $_GET["type"];
}

if(isset($_GET["S_id"])){
    $S_id = $_GET["S_id"];
}else{
	$S_id = "0";
}

if ($_GET["style"] == "") {
    $style = $U_type;
} else {
    $style = $_GET["style"];
}

if ($C_close == 1) {
    Header("Location: close.html");
}
if ($C_todomain <> "empty" && $C_todomain <> "" && $C_todomain <> $C_domain) {
    Header("Location: //" . $C_todomain);
}

switch ($U_type) {
    case "index":
        $page_info = ReplaceLableFlag(ReplaceWapTag(CreateHTMLReplace(CreateIndex(ReplaceWapPart(LoadWapTemplate($style, 1))))));
        break;

    case "contact":
        $page_info = ReplaceLableFlag(ReplaceWapTag(CreateHTMLReplace(CreateContact(ReplaceWapPart(LoadWapTemplate($style, 1))))));
        break;

    case "guestbook":
        $page_info = ReplaceLableFlag(ReplaceWapTag(CreateHTMLReplace(CreateGuestbook(ReplaceWapPart(LoadWapTemplate($style, 1))))));
        break;

    case "bbs":
        Header("location:bbs");
        break;

    case "member":
        Header("location:member");
        break;

    case "text":
        if (getrs("select * from SL_text where T_id=" . $S_id, "T_title") == "") {
            box("菜单指向的简介已被删除，请到“菜单管理”重新编辑", "back", "error");
        } else {
            $page_info = ReplaceLableFlag(ReplaceWapTag(CreateHTMLReplace(CreateText(ReplaceWapPart(LoadWapTemplate($style, $S_id)) , $S_id))));
        }
        break;

    case "form":
        if (getrs("select * from SL_form where F_id=" . $S_id, "F_title") == "") {
            box("菜单指向的简介已被删除，请到“菜单管理”重新编辑", "back", "error");
        } else {
            $page_info = ReplaceLableFlag(ReplaceWapTag(CreateHTMLReplace(CreateForm(ReplaceWapPart(LoadWapTemplate($style, $S_id)) , $S_id))));
        }
        break;

    case "news":
        if (is_numeric($S_id)) {
            if (getrs("select * from SL_nsort where S_id=" . $S_id, "S_title") == "" && $S_id <> 0) {
                box("菜单指向的新闻分类已被删除，请到“菜单管理”重新编辑", "back", "error");
            } else {
                $page_info = ReplaceLableFlag(ReplaceWapTag(CreateHTMLReplace(CreateNewsList(ReplaceWapPart(LoadWapTemplate($style, $S_id)) , $S_id, $S_page))));
            }
        } else {
            $page_info = ReplaceLableFlag(ReplaceWapTag(CreateHTMLReplace(CreateNewsList(ReplaceWapPart(LoadWapTemplate($style, $S_id)) , $S_id, $S_page))));
        }
        break;

    case "newsinfo":
        if (getrs("select * from SL_news where N_id=" . $S_id, "N_title") == "") {
            box("该新闻不存在或已被删除", "back", "error");
        } else {
            $page_info = ReplaceLableFlag(ReplaceWapTag(CreateHTMLReplace(CreateNewsInfo(ReplaceWapPart(LoadWapTemplate($style, $S_id)) , $S_id))));
        }
        break;

    case "product":
        if (is_numeric($S_id)) {
            if (getrs("select * from SL_psort where S_id=" . $S_id, "S_title") == "" && $S_id > 0) {
                box("菜单指向的产品分类已被删除，请到“菜单管理”重新编辑", "back", "error");
            } else {
                $page_info = ReplaceLableFlag(ReplaceWapTag(CreateHTMLReplace(CreateProductList(ReplaceWapPart(LoadWapTemplate($style, $S_id)) , $S_id, $S_page))));
            }
        } else {
            $page_info = ReplaceLableFlag(ReplaceWapTag(CreateHTMLReplace(CreateProductList(ReplaceWapPart(LoadWapTemplate($style, $S_id)) , $S_id, $S_page))));
        }
        break;

    case "productinfo":
        if (getrs("select * from SL_product where P_id=" . $S_id, "P_title") == "") {
            box("该产品不存在或已被删除", "back", "error");
        } else {
            $page_info = ReplaceLableFlag(ReplaceWapTag(CreateHTMLReplace(CreateProductInfo(ReplaceWapPart(LoadWapTemplate($style, $S_id)) , $S_id))));
        }
        break;

    default:
        $page_info = ReplaceLableFlag(ReplaceWapTag(CreateHTMLReplace(CreateIndex(ReplaceWapPart(LoadWapTemplate($style, 1))))));
}


if ($_SESSION["f"] == 1) {
    echo cnfont($page_info, "f");
} else {
    echo cnfont($page_info, "j");
}

?>