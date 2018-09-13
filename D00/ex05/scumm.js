var i;
i = 0;

var image = document.getElementById("bigimg");
var livre = document.getElementById("livre");
var intro = document.getElementById("intro");
var greenbox = document.getElementById("greenbox");
var serviette = document.getElementById("serviette");
var brique = document.getElementById("brique");
var namebox = document.getElementById("namebox");
var objectbox = document.getElementById("objectsbox");
var objects = document.getElementById("objects");
var gamine = document.getElementById("gamine");
var pokeball = document.getElementById("pokeball");
var pokebox = document.getElementById("pokebox");
var poklive = document.getElementById("live");

var pokeflute = 0;
var encounter = 0;
var pokeballnb = 0;
var briquenb = 0;
var soinnb = 0;
var salahit = 5;
var salalive = getRandomInt(3, 10);

greenbox.style.display = "none";
objectbox.style.display = "none";
serviette.style.display = "none";
brique.style.display = "none";
pokeball.style.display = "none";
pokebox.style.display = "none";

function lire(){
		if (i == 0)
		{
			alert("vous venez d'arriver dans un endroit pleins de Macs !!! :O, votre regard croise celui d'un gars, il vous interpelle parlez-lui ou ignorez-le)");
		}
		if (i == 1)
		{
			alert("vous avez reussi a passer le gars... avencer vers un mac");
		}
		if (i == 2)
		{
			alert("whaaa, une chambre d'ado fan de pokemon :o");
		}
		if (i == 3)
		{
			alert("vous tombez sur Bidule, parlez-lui");
		}
		if (i == 4 && encounter == 0)
		{
			alert("fouillez les hautes herbes");
		}
		if (encounter == 1)
		alert("Vous etes face a un pokemon, jetez des balls ou des briques ...");
		if (encounter == -10)
		alert("Essayer de jouer de la flute (utiliser) ...");
}


function getname(){
	var ans = document.getElementById("entername");
	if (i >= 0 && ans.value == "")
	{
		alert("me prend pas pour un con, casse toi");
		i = -1;
		intro.innerHTML = "Vous avez rate votre entre... Revenez avec un autre visage Arya...";
		intro.style.fontWeight = "900";
	}
	else if ( i == 0)
	{
		intro.innerHTML = ans.value;
		i++;
		greenbox.style.display = "none";
		namebox.style.backgroundColor = "#909090";
	}
}

function avancer(){
	if (i == 1)
	{
		alert("vous avez ete envoye dans un autre monde :O, Good Luck ;)");
		image.src="https://www.geek.com/wp-content/uploads/2014/07/pokebase-625x350.jpg";
		i++;
	}
	else if (i == 2)
	{
		image.src = "http://pokedream.com/games/pokemon-xy/images/shauna-trade.png";
		i++;
	}
	else if (i == 3)
	{
		image.src = "http://image.noelshack.com/fichiers/2014/35/1409053797-obstacle.png";
		gamine.innerHTML="vous allez dans les herbres";
		i++;
	}
	else if (i >= 4 && encounter == 0)
	{
		var j = getRandomInt(1, 4);
		if (j == 2)
			charencounter();
	}
}

function regarder(){
	if (i == 0 || i == 1)
		alert("y a pleins de Macs :o");
	if (i == 2)
		alert("OOOOooohhhh !!!! Une peluche DRACAUFEU :OOOO, et une pokeflute...");
	if (i == 3)
		alert("whhaaaa elle est mignone en fait :O, faut faire l'avanture avec elle hmmmm...");
	if (i == 4 && !encounter)
		alert("les herebs sont vraiment hautes ...");	
	if (encounter == 1)
		alert("Vous etes face a un pokemon...");
}

function parler(){
	if (i == 0)
	{
		greenbox.style.display = "block";
	}
	else if (i == 3)
	{
		greenbox.style.display = "block";
		document.getElementById("cach").style.display= "none";
		document.getElementById("cache").style.display= "none";
		document.getElementById("cacher").style.display= "none";
		gamine.innerHTML = "Hey " + intro.innerHTML + ", tu par deja ? Attends j'ai ca pour toi :) [La Bidule vient de vous donnez 5 Pokeballs, 1 Soin et 10 Briques]";
		gamine.style.display = "block";
	serviette.style.display = "block";
	brique.style.display = "block";
pokeball.style.display = "block";
		pokeballnb = 5;
		briquenb = 10;
		soinnb = 1;
	}
}

function prendre()
{
	if (i == 0)
	{
		alert("vous avez essayer de prendre quelque chose... vous avez pris un marron : le gars vous a mis une patate, vous etes K.O");
		i = -1;
		intro.innerHTML = "Vous avez rate votre entre... Revenez une prochaine fois Chipper...";
		intro.style.fontWeight = "900";
	}
	if ( i == 2 && pokeflute == 0)
	{
		namebox.style.width = "50%";
		objectbox.style.width = "50%";
		objectbox.style.display = "block";
		objects.innerHTML = 	objects.innerHTML + " Pokeflute";
		objectbox.style.backgroundColor = "#909090";
		pokeflute = 1;
	}
}

function utiliser(){
if (encounter == -10 && pokeflute)
{
		gamine.innerHTML = "Vous jouez de la pokeflute, Salameche est tres content, partez a l'aventure avec ce puissant pokemon !";
		image.src = "https://d2rd7etdn93tqb.cloudfront.net/wp-content/uploads/2018/06/pokemon-lets-go-charmander-conversation-1024x570.jpg";
}
else if (encounter == -10);
		gamine.innerHTML = "Vous avez pas pris la pokeflute, vous rentrez chez vous sans mem delog, quelqu'un vous achetera une tig, vous le vallez bien !";

}
 
function lanceball(){
	if (encounter == 0)
	{
		if (pokeballnb >= 0)
		{
			pokeballnb--;
			gamine.innerHTML="Vous avez jete une pokeball... just WHY ????";
		}
		else
			gamine.innerHTML="Vous avez plus de balls a jeter...";
	}
	if (encounter == 1)
	{
		if (pokeballnb >= 0)
		{
			gamine.innerHTML="Vous lancez une pokeball sur Salameche, il en est sorti :(";
			pokeballnb--;	
			if (getRandomInt(0, salalive) == 1)
			{
				gamine.innerHTML="Bravo vous avez capture Salameche";
				encounter = -10;
			}
		}
	}
}

function lancebrique()
{
	if (encounter == 0)
	{
		if (briquenb >= 0)
		{
			briquenb--;
			gamine.innerHTML="Vous avez jete une pierre... why not ?!";
		}
		else
			gamine.innerHTML="vous avez plus de pierre a jeter";
	}
	if (encounter == 1)
	{
		if (briquenb >= 0)
		{
			gamine.innerHTML="Vous lancez une pierre sur Salameche, il s'enerve";
			salalive--;
			briquenb--;
			pokmninf();
			if (getRandomInt(0, salalive) == 1)
			{
				gamine.innerHTML="Vous lancez une pierre sur Salameche, ca l'as tellement enerve qu'il utilise lance-flamme, oui oui, lance-flamme!!!, triste vous etes mort. A la prochaine :p";
		image.src = "https://i.ytimg.com/vi/ozn3kFniaq8/maxresdefault.jpg";
		encounter = -20;
			}
		}
		else
			gamine.innerHTML="vous avez plus de pierre a jeter";
	}
}

function getRandomInt(min, max) {
	    return Math.floor(Math.random() * (max - min + 1)) + min;
}

function pokmninf(){
	namebox.style.width = "33%";
	pokebox.style.width = "33%";
	objectbox.style.width = "33%";
	poklive.innerHTML = "live : " + salalive;
	pokebox.style.backgroundColor = "#909090";
	pokebox.style.display = "block";
}

function charencounter()
{
	if (pokeballnb > 0)
	{
		pokmninf();
	gamine.innerHTML="Whoooaaaa un Salameche sauvage apparait :O";
	image.src="https://media.indiedb.com/images/games/1/32/31345/8b8fa57f2564624696ae418e392a62dd.png";
	encounter++;
	}
	else
	{
		greenbox.style.display = "none";
		gamine.innerHTML="Il y a pleins de pokemon ici, mais vous avez ignore la fille, du coup vous allez errer ici eternellement, Bye :p";}
}

function useserviette()
{
	
		gamine.innerHTML="Vous utiliser votre serviette, ca n'as pas l'air tres efficace";
}
