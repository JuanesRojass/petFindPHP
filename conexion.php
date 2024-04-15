<?php

$connect = new mysqli("localhost","root","","mascotasbga");

if($connect){
	 
}else{
	echo "Fallo, revise ip o firewall";
	exit();
}