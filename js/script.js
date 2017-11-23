var numOpciones = 0;


function onload(){
	document.getElementById('crearO').disabled = true;
	//document.getElementById('enviarC').disabled = true;
}

function isNull(){
	if (document.getElementById('consulta').value != ""){
		enableDisable('crearO');
	}
}


function crearConsulta(){
	var label = document.createElement("label");
	var textNodeLabel = document.createTextNode("Escribe la consulta: ");
	label.appendChild(textNodeLabel);

	var textarea = document.createElement("textarea");
	textarea.setAttribute('id','consulta')
	textarea.setAttribute('name','consulta')
	
	var br = document.createElement("br");
	var br2 = document.createElement("br");


	var lugar = document.getElementById("myform").lastElement;
	document.body.getElementsByTagName("form")[0].insertBefore(label, lugar);
	document.body.getElementsByTagName("form")[0].insertBefore(br, lugar);
	document.body.getElementsByTagName("form")[0].insertBefore(textarea, lugar);
	document.body.getElementsByTagName("form")[0].insertBefore(br2, lugar);

	enableDisable('crearC');
	enableDisable('crearO');

}

function enableDisable(id){

	btn = document.getElementById(id);

	if(btn.disabled == true){
		btn.disabled = false;
	}
	else if(btn.disabled == false){
		btn.disabled = true;
	}
}

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
	input.setAttribute('name','i[]');
	borrar.setAttribute('id','b'+numOpciones);
	borrar.setAttribute('onclick','borrarOpcion('+numOpciones+')');

 	var lugar = document.getElementsByTagName("form")[0].lastElement;
 	document.body.getElementsByTagName("form")[0].insertBefore(label,lugar);
 	document.body.getElementsByTagName("form")[0].insertBefore(input,lugar);
 	document.body.getElementsByTagName("form")[0].insertBefore(borrar,lugar);
 	document.body.getElementsByTagName("form")[0].insertBefore(br,lugar);
}

function eSubmit(){
	var submit = document.getElementById('eConsulta')
	var formulario = document.getElementById("myform");
	submit.value = 'Crear Consulta';
	formulario.submit();
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
	var dato = document.getElementById('eConsulta');
	alert("ola");
 
	if (dato.value=="Crear Consulta"){
		formulario.submit();
		return true;
	} else {
		return false;
	}
}
