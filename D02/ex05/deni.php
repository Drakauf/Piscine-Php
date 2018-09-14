#!/usr/bin/php
<?PHP

if ($argc != 3)
	exit();
if (!(file_exists($argv[1])))
	exit();

$file = fopen($argv[1], "r");

if ($argv[2] == "nom")
	$main = 0;
else if ($argv[2] == "prenom")
	$main = 1;
else if ($argv[2] == "mail")
	$main = 2;
else if ($argv[2] == "IP")
	$main = 3;
else if ($argv[2] == "pseudo")
	$main = 4;
else 
	exit();

$var = $argv[2];

$prenom = array();
$nom = array();
$pseudo = array();
$mail = array();
$IP = array();

$i=0;
while ($line = fgets($file))
{
	if ($i != 0)
	{
		$linetab = explode(";", $line);
		$nom[trim($linetab[$main])] = trim($linetab[0]);
		$prenom[trim($linetab[$main])] = trim($linetab[1]);
		$mail[trim($linetab[$main])] = trim($linetab[2]);
		$IP[trim($linetab[$main])] = trim($linetab[3]);
		$pseudo[trim($linetab[$main])] = trim($linetab[4]);
	}
	$i++;
}

$entre = fopen("php://stdin", "r");

while ($entre && !feof($entre))
{
	echo("Entrez votre commande : ");
	$commande = fgets($entre);
	if (ord($commande) == 4)
		exit();
	else if ($commande)
		eval($commande);
}
echo("\n");
fclose($entre);
?>
