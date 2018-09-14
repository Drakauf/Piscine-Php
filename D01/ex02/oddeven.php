#!/usr/bin/php
<?PHP

echo "Entrez un nombre: ";
$handle = fopen("php://stdin", "r");
while ($line = fgets($handle)):
$trline = trim($line);
$test = is_numeric($trline);
if (!$test)
	echo "'$trline' n'est pas un chiffre\n";
else if ($test && $trline % 2 === 0)
	echo "Le chiffre $trline est Pair\n";
else
	echo "Le chiffre $trline est Impair\n";
echo "Entrez un nombre: ";
endwhile;
print "\n";
?>
