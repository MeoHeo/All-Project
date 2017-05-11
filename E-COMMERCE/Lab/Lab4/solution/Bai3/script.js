function moveImg(){
	var x = Math.floor(Math.random()*500);
	var y = Math.floor(Math.random()*500);


	var obj = document.getElementById("beginImg");

	obj.style.top = x + "px";
	obj.style.left = y + "px";
	obj.src = "./cat/grey-cat-007.gif";
}

function catchImg(){
	document.getElementById("beginImg").src = "./cat/cat3_small.gif";
}