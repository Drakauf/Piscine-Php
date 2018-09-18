/*********************************************************************/
/* Header: Div a afficher                                            */
/*********************************************************************/

var codiv = document.getElementById("connected");
var nocodiv = document.getElementById("noconnect");

if (log)
{
	codiv.style.display = "block";
	nocodiv.style.display = "none";
}
else
{
	codiv.style.display = "none";
	nocodiv.style.display = "block";
}

/*********************************************************************/
/* deconnection                                                      */
/*********************************************************************/


var deconnection = document.getElementById("deco");

deconnection.addEventListener("click", decoredirect);

function decoredirect()
{
	var xhr = new XMLHttpRequest();
	xhr.open('POST', 'deco.php');
	xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	xhr.send();
	location.href = "./index.php";
}

/*********************************************************************/
/* deconnection                                                      */
/*********************************************************************/

var connection = document.getElementById("cobutton");

connection.addEventListener("click", coredirect);

function coredirect()
{
	location.href = "insco.php";
}


/*********************************************************************/
/* pannier                                                           */
/*********************************************************************/

var pannierd = document.getElementById("pannierd");
var pannierc = document.getElementById("pannierc");

pannierc.addEventListener("click", paredirect);
pannierd.addEventListener("click", paredirect);

function paredirect()
{
	location.href = "pannier.php";
}

/*********************************************************************/
/* home                                                              */
/*********************************************************************/

var homed = document.getElementById("homed");
var homec = document.getElementById("homec");

homec.addEventListener("click", homeredirect);
homed.addEventListener("click", homeredirect);

function homeredirect()
{
	location.href = "./index.php";
}

