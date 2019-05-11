<?php // created by joe lumbroso 

// see some other good php3 scripts 

// goto http://www.dtheatre.com/scripts echo "<font color=\"red\"><blink><b>Pinging</b></blink></font><br>"; 

$to_ping = "117.50.72.111"; 

$count = 3; 

$psize = 65; 

echo " Please be patient, this can take a few moments...\n<br><br>"; 
die();

flush(); while (1) { 

?> 

<pre> 

<? 

exec("ping -c $count -s $psize $to_ping", $list); 

for ($i=0;$i < count($list);$i++) { 

print $list[$i]."\n"; 

} 

?> 

</pre> 

<? 

flush(); 

sleep(3); 

} 