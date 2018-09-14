#!/usr/bin/php
<?php

date_default_timezone_set("Europe/Paris");

function ft_error(){
	print ("Wrong Format\n");
	exit();
}

function verifday($day)
{
	if ($day == "Lundi" || $day == "lundi" || $day == "Mardi" || $day == "mardi" || $day == "Mercredi"  || $day == "mercredi" || $day == "jeudi" || $day == "Jeudi" || $day == "Vendredi" || $day == "vendredi" || $day == "Samedi" || $day == "samedi" || $day == "Dimanche" || $day == "dimanche")
		return (0);
	return (1);
}
function monthdigit($str)
{
	$month = 0;
	if ($str === "Janvier" || $str === "janvier")
		$month = 1;
	if ($str === "Fevrier" || $str === "Février" || $str === "fevrier" || $str === "février")
		$month = 2;
	if ($str === "Mars" || $str === "mars")
		$month = 3;
	if ($str === "Avril" || $str === "avril")
		$month = 4;
	if ($str === "Mai" || $str === "mai")
		$month = 5;
	if ($str === "Juin" || $str === "juin")
		$month = 6;
	if ($str === "Juillet" || $str === "juillet")
		$month = 7;
	if ($str === "aout" || $str === "août" || $str === "Aout" || $str === "Août")
		$month = 8;
	if ($str === "Septembre" || $str === "Septembre")
		$month = 9;
	if ($str === "Octobre" || $str === "octobre")
		$month = 10;
	if ($str === "Novembre" || $str === "novembre")
		$month = 11;
	if ($str === "decembre" || $str === "Decembre" || $str === "Décembre" || $str === "décembre")
		$month = 12;
	return ($month);
}

$str = preg_split('/[\s+]/', $argv[1]);
if (count($str) != 5)
	ft_error();
$time = preg_split('/:/', $str[4]);
if (count($time) != 3)
	ft_error();
if (verifday($str[0]) == 1)
	ft_error();
$mois = monthdigit($str[2]);
if ($mois == 0)
	ft_error();
$r = mktime($time[0],$time[1],$time[2], $mois, $str[1], $str[3]);
print ("$r\n");
?>
