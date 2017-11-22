var numOpciones = 0;

function crearOpcion(){
	numOpciones++;

	var label = document.createElement("label");
	var input = document.createElement("input");
	var borrar = document.createElement("button");
	var textNodeButton = document.createTextNode("X");
	var br = document.createElement("br");
	borrar.appendChild(textNodeButton);
	var textNodeLabel = document.createTextNode("Opcion " + numOpciones + ": ");
	label.appendChild(textNodeLabel);

	label.setAttribute('class','lOpciones');
	label.setAttribute('id',numOpciones);
	input.setAttribute('class','iOpciones');
	input.setAttribute('id',numOpciones);
	borrar.setAttribute('id',numOpciones);
	borrar.setAttribute('onclick','borrarOpcion()');

 	var lugar = document.getElementsByTagName("form")[0].lastElement;
 	document.body.getElementsByTagName("form")[0].insertBefore(label,lugar);
 	document.body.getElementsByTagName("form")[0].insertBefore(input,lugar);
 	document.body.getElementsByTagName("form")[0].insertBefore(borrar,lugar);
 	document.body.getElementsByTagName("form")[0].insertBefore(br,lugar);
}

function eSubmit(){
	document.forms["crearConsulta"].submit();
}

function enviar(){
	var formulario = document.getElementById("myform");	
	var dato = formulario[0];
 
	if (dato.value=="Crear Consulta"){
		alert("ola");
		formulario.submit();
		return true;
	} else {
		alert("ola2");
		return false;
	}
}
