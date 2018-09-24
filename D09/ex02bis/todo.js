var todolist;
var cookies = [];

function gettodo()
{
	var newtodo = prompt("qu'est-ce que tu dois faire ?", '');
	if (newtodo == '')
		return;
	else
		addnewtodo(newtodo);
}

function addnewtodo(newtodo)
{
	$("#ft_list").prepend("<div class=test>"+newtodo+"</div>");
	$(".test").first().on("click", deletetodo);
}

function deletetodo (){
	if (confirm("Really ? tu veux vraiment supprimer ?"))
		$(this).remove();
}

window.onload = function() 
{
	$("#new").on("click", gettodo);
	oldcookies = document.cookie;
	if (oldcookies)
	{
		var cook = oldcookies.split("; ")[2];
		cookies = JSON.parse(cook);
		cookies.forEach(function (cookie)
				{
					addnewtodo(cookie);
				});
	}
}

window.onunload = function() {
	var tosave = $("#ft_list").children();
	var savecookies = [];
	var i = 0;
	while (i < tosave.length)
	{
		savecookies.unshift(tosave[i].innerHTML);
		i++;
	}
	document.cookie = JSON.stringify(savecookies);
}
