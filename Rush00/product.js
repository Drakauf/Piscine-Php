var addtrigger= document.getElementById("addproduct");
var prodnbr= document.getElementById("prodnumber");
var prodid= document.getElementById("productid").value;

var divmsg= document.getElementById("msg");

addtrigger.addEventListener("click", function(){
	var xhr = new XMLHttpRequest();
	xhr.open('POST', 'add_product.php');
	xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	xhr.onload = function() {
			divmsg.innerHTML = xhr.responseText;
	};
	xhr.send('id='+prodid+'&nbr='+prodnbr.value);
});
