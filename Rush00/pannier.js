var activate = document.getElementById("validate");

activate.addEventListener("click", activatepan);
var divmsg= document.getElementById("panval");
function activatepan()
{
	var xhr = new XMLHttpRequest();
	xhr.open('POST', 'active_pan.php');
	xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	xhr.onload = function() {
				divmsg.innerHTML = xhr.responseText;
						};
	xhr.send();
}
