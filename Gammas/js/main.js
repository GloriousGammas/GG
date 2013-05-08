// Main file for JavaScript.

// Används för att kontrollera om både email och lösenord är ok.
var eOk = false;
var pOk = false;

// Validerar att användaren matat in rätt uppgifter innan det skickas iväg.
function emailValidate () {

	// Kontrollerar att godkänd email.
	var emailInput = document.forms.formLogin.emailInput.value;
	var aPos = emailInput.indexOf("@"); // Letar upp @.
	var dotPos = emailInput.lastIndexOf("."); // Letar upp om ".".

	if (emailInput === null || emailInput === "") {
		document.getElementById("emailIcon").className = "btn btn-inverse"; // Ändrar till svart knapp.
		document.getElementById("emailIcon").innerHTML = "<i class='icon-user icon-white'></i>"; // Sätter en gubbe bock.
		eOk = false;
	}

	else if (aPos < 1 || dotPos < aPos + 2 || dotPos + 2 >= emailInput.length) {
		document.getElementById("emailIcon").className = "btn btn-danger"; // Ändrar till röd knapp.
		document.getElementById("emailIcon").innerHTML = "<i class='icon-remove icon-white'></i>"; // Sätter ett kryss som bock.
		eOk = false;
	}

	else {
		// Om email ok!
		document.getElementById("emailIcon").className = "btn btn-success"; // Ändrar till grön knapp.
		document.getElementById("emailIcon").innerHTML = "<i class='icon-ok icon-white'></i>"; // Sätter en ok bock.
		eOk = true;
	}
}

// Kontrollerar att lösenordsfältet ej är tomt. Ingen koll av lösenordet i sig.
function passValidate () {
	var pass = document.forms.formLogin.passInput.value;

	if (pass === null || pass === "") {
		document.getElementById("passIcon").className = "btn btn-danger"; // Ändrar till röd knapp.
		document.getElementById("passIcon").innerHTML = "<i class='icon-remove icon-white'></i>"; // Sätter ett kryss som bock.
		pOk = false;
	}
	else {
		document.getElementById("passIcon").className = "btn btn-success"; // Ändrar till grön knapp.
		document.getElementById("passIcon").innerHTML = "<i class='icon-ok icon-white'></i>"; // Sätter en ok bock.
		pOk = true;
	}
}

// Denna kallas när båda ovan är true.
function emailAndPassOk () {
	if (eOk === true && pOk === true) {
		document.getElementById("login").className = "btn btn-success"; // Ändrar till grön knapp.
		document.getElementById("login").innerHTML = "Login <i class='icon-off icon-white'></i>"; // Sätter en ok bock.
		document.getElementById("login").disabled = false;
	}
	else if (eOk !== true || pOk !== true) {
		document.getElementById("login").className = "btn btn-danger"; // Ändrar till röd knapp.
		document.getElementById("login").innerHTML = "Login <i class='icon-remove icon-white'></i>"; // Sätter ett kryss som bock.
		document.getElementById("login").disabled = true;
	}	
}










