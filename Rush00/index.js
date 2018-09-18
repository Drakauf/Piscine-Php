var balls = document.getElementById("button_ball");
var baies = document.getElementById("button_baies");
var soins = document.getElementById("button_soins");
var autre = document.getElementById("button_autre");
var tout = document.getElementById("button_all");
/*var balls = document.getElementById("button_ball");
  var balls = document.getElementById("button_ball");
  */
var class_ball = document.getElementsByClassName("ball");
var class_baies = document.getElementsByClassName("baie");
var class_soins = document.getElementsByClassName("soin");
var class_autre = document.getElementsByClassName("autre");
var class_all = document.getElementsByClassName("all_product");


balls.addEventListener("click", function() {
	for (var i = 0; i < class_all.length; i++) {
		class_all[i].style.display= "none";
	}
	for (var i = 0; i < class_ball.length; i++) {
		class_ball[i].style.display= "block";
	}
	balls.style.backgroundColor = "#42A5F5";
	baies.style.backgroundColor = "inherit";
	soins.style.backgroundColor = "inherit";
	autre.style.backgroundColor = "inherit";
	tout.style.backgroundColor = "inherit";
}
);


baies.addEventListener("click", function() {
	for (var i = 0; i < class_all.length; i++) {
		class_all[i].style.display= "none";
	}
	for (var i = 0; i < class_baies.length; i++) {
		class_baies[i].style.display= "block";
	}
	balls.style.backgroundColor = "inherit";
	baies.style.backgroundColor = "#42A5F5";
	soins.style.backgroundColor = "inherit";
	autre.style.backgroundColor = "inherit";
	tout.style.backgroundColor = "inherit";
}
);

soins.addEventListener("click", function() {
	for (var i = 0; i < class_all.length; i++) {
		class_all[i].style.display= "none";
	}
	for (var i = 0; i < class_soins.length; i++) {
		class_soins[i].style.display= "block";
	}
	for (var i = 0; i < class_baies.length; i++) {
		class_baies[i].style.display= "block";
	}
	balls.style.backgroundColor = "inherit";
	baies.style.backgroundColor = "inherit";
	soins.style.backgroundColor = "#42A5F5";
	autre.style.backgroundColor = "inherit";
	tout.style.backgroundColor = "inherit";
}
);


autre.addEventListener("click", function() {
	for (var i = 0; i < class_all.length; i++) {
		class_all[i].style.display= "none";
	}
	for (var i = 0; i < class_autre.length; i++) {
		class_autre[i].style.display= "block";
	}
	balls.style.backgroundColor = "inherit";
	baies.style.backgroundColor = "inherit";
	soins.style.backgroundColor = "inherit";
	autre.style.backgroundColor = "#42A5F5";
	tout.style.backgroundColor = "inherit";
}
);

tout.addEventListener("click", function() {
	for (var i = 0; i < class_all.length; i++) {
		class_all[i].style.display= "block";
	}
	balls.style.backgroundColor = "inherit";
	baies.style.backgroundColor = "inherit";
	soins.style.backgroundColor = "inherit";
	autre.style.backgroundColor = "inherit";
	tout.style.backgroundColor = "inherit";
}
);



var produit = document.getElementsByClassName("product_img");

produits_click();
/*
   function produits_click()
   {
   var i;

   i = 0;
   while (i < produit.length)
   {
   produit[i].addEventListener("click", function(){
   alert(produit[i].id);
   location.href = "products.php?id=" + produit[i].id;
   });
   i++;
   }
   }
   */
function produits_click()
{
	var i;

	i = 0;
	while (i < produit.length)
	{
		produit_clicked(i);
		i++;
	}
}

function produit_clicked(i)
{
	produit[i].addEventListener("click", function(){
		redirect(produit[i].id);
	});
}

function redirect(k)
{
	location.href = "products.php?id=" + k;
}
