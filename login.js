function handleInput(element) {
	if(element.value != "<") {
		var oldInnerText = document.getElementById("number-output").innerText;
		if(oldInnerText.length >= 3) {
			return;
		} else {
			document.getElementById("number-output").innerText = document.getElementById("number-output").innerText + element.value;
			return;	
		}
	} else {
		var currentValue = document.getElementById("number-output").innerText;
		document.getElementById("number-output").innerText = currentValue.slice(0, currentValue.length - 1);
		return;	
	}
}

function handleStyleDown(element) {
	element.style.color = "#ffffff";
	element.style.backgroundColor = "#e7e7e7";
	return;
}

function handleStyleUp(element) {
	if(element.value == "<") {
		element.style.color = "#000000";
		element.style.backgroundColor = "#ffffff";
		return;
	} else if(element.value == "Submit") {
		element.style.color = "#ffffff";
		element.style.backgroundColor = "#4CAF50";
		return;		
	} else if(element.value == "Clear" ) {
		element.style.color = "#ffffff";
		element.style.backgroundColor = "#f44336";
		return;		
	} else {
		element.style.color = "#000000";
		element.style.backgroundColor = "#ffffff";
		return;		
	}
}

function clearInput() {
	document.getElementById("number-output").innerText = "";
	return;
}

function validateInput() {
	var input = document.getElementById("number-output").innerText;
	if (input.length == 3) {
		window.location.replace("order-creation.php");
	} else {
		return;
	}
}


// $(function () {
// 	$(".number").click(function () {

// 		var value = $(this).find(".number-button").text();

// 		if (value !== "<") {
// 			$(".numberinput").each(function () {
// 				var a = $(this).text();
// 				if (!a) {
// 					$(this).text(value);
// 					return false;
// 				}
// 			});
// 		} else {
// 			$($(".numberinput").get().reverse()).each(function () {
// 				var a = $(this).text();
// 				if (a) {
// 					$(this).text("");
// 					return false;
// 				}
// 			});
// 		}
// 	});
// });