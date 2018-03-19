function logOut() {
	window.location.replace("login.php");
}

function handleStyleDown(element) {
	var originalColor = element.style.color;
	element.style.color = "#ffffff";
	element.style.backgroundColor = "#e7e7e7";
	// element.style.backgroundColor = originalColor;
	return;
}

function handleStyleUp(element) {	
	if (element.value == "Delete Last") {
		element.style.color = "#ffffff";
		element.style.backgroundColor = "red";
		return;		
	}
	else if (element.value == "Print Order") {
		element.style.color = "#ffffff";
		element.style.backgroundColor = "rgb(4, 2, 131)";
		return;		
	}
	else if (element.value == "Exit") {
		element.style.color = "#ffffff";
		element.style.backgroundColor = "green";
		return;		
	}
	else if (element.value == "SendStay" || element.value == "SendExit") {
		element.style.color = "#ffffff";
		element.style.backgroundColor = "rgb(255, 145, 0)";
		return;		
	}
	else if (element.value == "Promos") {
		element.style.color = "#ffffff";
		element.style.backgroundColor = "rgb(102, 102, 102)";
		return;		
	}
	else if (element.value == "Sides") {
		element.style.color = "#ffffff";
		element.style.backgroundColor = "blue";
		return;		
	}
	else if (element.value == "Desserts") {
		element.style.color = "#ffffff";
		element.style.backgroundColor = "rgb(235, 99, 99)";
		return;		
	}
	else if (element.value == "Entrees") {
		element.style.color = "#ffffff";
		element.style.backgroundColor = "rgba(255, 217, 0, 0.877)";
		return;		
	}
	else if (element.value == "Apps") {
		element.style.color = "#ffffff";
		element.style.backgroundColor = "rgb(122, 76, 175)";
		return;		
	}
	else if (element.value == "Drinks") {
		element.style.color = "#ffffff";
		element.style.backgroundColor = "rgb(8, 177, 255)";
		return;		
	}
}

function styleMenuButtons() {
    var currentCategory = <?php echo $_SESSION["category"]; ?>;

    /*        
        $_SESSION["category"] = "Drinks";
    } else if (isset($_POST["appetizers"])) {
        $_SESSION["category"] = "Appetizers";
    } else if (isset($_POST["entrees"])) {
        $_SESSION["category"] = "Entrees";
    } else if (isset($_POST["desserts"])) {
        $_SESSION["category"] = "Desserts";
    } else if (isset($_POST["sides"])) {
        $_SESSION["category"] = "Sides";
    } else if (isset($_POST["promos"])) {
        $_SESSION["category"] = "Promos";
    */

    if(currentCategory == "Drinks") {
        handleStyleDown(document.getElementById("apps"));
        handleStyleDown(document.getElementById("entrees"));
        handleStyleDown(document.getElementById("desserts"));
        handleStyleDown(document.getElementById("sides"));
        handleStyleDown(document.getElementById("promos"));
    }
}