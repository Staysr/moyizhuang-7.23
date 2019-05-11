<?php
include("inc.php");
if( is_mobile() ){
include_once("dede_moblie.php");
	}else{//电脑
	include_once("dede_web.php");
}