<?php

require '../conn/conn2.php';
require '../conn/function.php';

echo splitx(dirname(__FILE__),"\\",count(explode("\\",dirname(__FILE__)))-1);
?>