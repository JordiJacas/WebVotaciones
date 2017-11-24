//Globales
var numOpciones = 0;
var isConsultaNull = true;

function onload(){
	document.getElementById('crearO').disabled = true;
	document.getElementById('enviarC').disabled = true;
}

function validarConsulta(){
	var consulta = document.getElementById('consulta')
	var dFinal = document.getElementById('fechaFinal')
	var dInicial = document.getElementById('fechaInicial')

	if(consulta.value != "" && dFinal.value != "" && dInicial.value != ""){
		isConsultaNull = false
		crearOpcion();
	}else{
		isConsultaNull = true;
		alert("Campos vacios");
	}
}

function validarNumOpciones(){
	if(numOpciones >= 2){
		return true;
	}

	return false;
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
	var br3 = document.createElement("br");

	var labelDataInici = document.createElement("label");
	var textNodeLabelInici = document.createTextNode("Fecha de apertura: ");
	labelDataInici.appendChild(textNodeLabelInici);

	var inputDataInici = document.createElement("input");
	inputDataInici.setAttribute('name','fechaInicial');
	inputDataInici.setAttribute('class','fecha');
	inputDataInici.setAttribute('id','fechaInicial');

	var labelDataFinal = document.createElement("label");
	var textNodeLabelFinal = document.createTextNode(" Fecha de cierre: ");
	labelDataFinal.appendChild(textNodeLabelFinal);

	var inputDataFinal = document.createElement("input");
	inputDataFinal.setAttribute('name','fechaFinal')
	inputDataFinal.setAttribute('class','fecha');
	inputDataFinal.setAttribute('id','fechaFinal');

	var submit = document.createElement('submit');
	submit.setAttribute('id','eConsulta');
	submit.setAttribute('value',' ');
	submit.setAttribute('type','submit');
	submit.setAttribute('name','eConsulta');
	submit.setAttribute('style','display:none');

	var form = document.createElement("form");
	form.setAttribute('action','enviarConsulta.php');
	form.setAttribute('method','post');
	form.setAttribute('id','myform');
	form.setAttribute('onsubmit','return enviar()');

	form.appendChild(label);
	form.appendChild(br);
	form.appendChild(textarea);
	form.appendChild(br2);

	form.appendChild(labelDataInici);
	form.appendChild(inputDataInici);

	form.appendChild(labelDataFinal);
	form.appendChild(inputDataFinal);

	form.appendChild(br3);

	form.appendChild(submit);

	var padre = document.body;

	padre.insertBefore(form,padre.childNodes[3]);

	enableDisable('crearC');
	enableDisable('crearO');
	enableDisable('enviarC');


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

	if(!isConsultaNull && validarNumOpciones){
		var submit = document.getElementById('eConsulta')
		var formulario = document.getElementById("myform");
		submit.value = 'Crear Consulta';
		formulario.submit();
	}

	alert("ola");
}

function borrarOpcion(id){
	var iBorrar = document.getElementById('i'+id)
	var bBorrar = document.getElementById('l'+id)
	var lBorrar = document.getElementById('b'+id)
	iBorrar.parentNode.removeChild(iBorrar);
	bBorrar.parentNode.removeChild(bBorrar);
	lBorrar.parentNode.removeChild(lBorrar);
	numOpciones--;
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
