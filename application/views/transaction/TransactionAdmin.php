<?php

$s = substr(str_shuffle(str_repeat("04BGHCFSQ1UAEVYDNR5OILPZ673928WTJKXM", 3)), 0, 3);
$varnota = strtoupper(date('ymNBs')) . $s;

echo $varnota;