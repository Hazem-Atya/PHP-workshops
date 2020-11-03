<?php
$time=new DateTime('today+1 week');
echo $time->format('d/m/y h:m');