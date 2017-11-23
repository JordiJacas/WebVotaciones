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
	label.setAttribute('id','l'+numOpciones);
	input.setAttribute('class','iOpciones');
	input.setAttribute('id','i'+numOpciones);
	input.setAttribute('name','i['+numOpciones+']');
	borrar.setAttribute('id','b'+numOpciones);
	borrar.setAttribute('onclick','borrarOpcion('+numOpciones+')');

 	var lugar = document.getElementsByTagName("form")[0].lastElement;
 	document.body.getElementsByTagName("form")[0].insertBefore(label,lugar);
 	document.body.getElementsByTagName("form")[0].insertBefore(input,lugar);
 	document.body.getElementsByTagName("form")[0].insertBefore(borrar,lugar);
 	document.body.getElementsByTagName("form")[0].insertBefore(br,lugar);
}

function eSubmit(){
	document.getElementById('crearConsulta').value = 'Crear Consulta';
}

function borrarOpcion(id){
	var iBorrar = document.getElementById('i'+id)
	var bBorrar = document.getElementById('l'+id)
	var lBorrar = document.getElementById('b'+id)
	iBorrar.parentNode.removeChild(iBorrar);
	bBorrar.parentNode.removeChild(bBorrar);
	lBorrar.parentNode.removeChild(lBorrar);
}


function enviar(){
	var formulario = document.getElementById("myform");	
	var dato = document.getElementById('crearConsulta');
 
	if (dato.value=="Crear Consulta"){
		formulario.submit();
		return true;
	} else {
		return false;
	}
}
