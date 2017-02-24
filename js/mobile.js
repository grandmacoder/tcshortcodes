var elmId = "";
var stepX = 0;
var stepY = 0;
var top_img;

function startStep(num) {
	if (elmId == "") {
		switch(num) {
			case 1:
				elmId = "mobile_weight1";
				var temp = document.getElementById(elmId);
				temp.style.display = "block";
				temp.style.left = "-140px";
				temp.style.top = "60px";
				stepX = -5;
				stepY = 2;
				break;
			case 2:
				elmId = "mobile_weight2";
				var temp = document.getElementById(elmId);
				temp.style.display = "block";
				temp.style.left = "110px";
				temp.style.top = "50px";
				stepX = 4;
				stepY = 2;
				break;
			case 3:
				elmId = "mobile_weight3";
				var temp = document.getElementById(elmId);
				temp.style.display = "block";
				temp.style.left = "-270px";
				temp.style.top = "70px";
				stepX = -8;
				stepY = 2;
				break;
			case 4:
				elmId = "mobile_weight4";
				var temp = document.getElementById(elmId);
				temp.style.display = "block";
				temp.style.left = "270px";
				temp.style.top = "55px";
				stepX = 10;
				stepY = 2;
				break;
			case 5:
				elmId = "mobile_weight5";
				var temp = document.getElementById(elmId);
				temp.style.display = "block";
				temp.style.left = "-140px";
				temp.style.top = "60px";
				stepX = -4;
				stepY = 2;
				break;
			default:
				return null;
				break;
		}
		runStep(num);
	}
}

function runStep(num) {
	var obj = document.getElementById(elmId);
	var top = parseInt(obj.style.top.replace("px",""));
	var left = parseInt(obj.style.left.replace("px", ""));
	if (Math.abs(top) < 5 || Math.abs(obj.style.left) < 5) {
		obj.style.top = "0px";
		obj.style.left = "0px";
		if (num == 1 || num == 3 || num == 5)
			rotateRight();
		else
			rotateLeft();
	} else {
		obj.style.top = (top - stepY) + "px";
		obj.style.left = (left - stepX) + "px";
		setTimeout("runStep(" + num + ")",15);
	}
}

function rotateRight() {
	top_img.rotate(5);
	document.getElementById("mobile_characteristics").style.marginTop = "-25px";
	document.getElementById("mobile_interactions").style.marginTop = "-8px";
	document.getElementById("mobile_functions").style.marginTop = "10px";
	document.getElementById("mobile_lifecycle").style.marginTop = "22px";
	setTimeout("returnToNormal(-5)",2000);
}

function rotateLeft() {
	top_img.rotate(-5);
	document.getElementById("mobile_characteristics").style.marginTop = "22px";
	document.getElementById("mobile_interactions").style.marginTop = "8px";
	document.getElementById("mobile_functions").style.marginTop = "-8px";
	document.getElementById("mobile_lifecycle").style.marginTop = "-18px";
	setTimeout("returnToNormal(5)",2000);
}

function returnToNormal(amt) {
	if (elmId != "")
		document.getElementById(elmId).style.display = "none";
	top_img.rotate(amt);
	document.getElementById("mobile_characteristics").style.marginTop = "0px";
	document.getElementById("mobile_interactions").style.marginTop = "0px";
	document.getElementById("mobile_functions").style.marginTop = "0px";
	document.getElementById("mobile_lifecycle").style.marginTop = "8px";
	elmId = "";
}