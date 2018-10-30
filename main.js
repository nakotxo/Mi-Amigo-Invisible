

newFunction();


function newFunction() {
	$(document).ready(function () {
		$("#parrafo").dblclick(function () {
			alert("has hecho doble click en el párrafo con id=parrafo");
		});
		$('.option').click(function () {
			alert("has hecho doble click en el option");
		});
	});
}

