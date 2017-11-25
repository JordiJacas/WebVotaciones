//Globales
var numOpciones = 0;
var isConsultaNull = true;
var bloquearConsulta = true;


function onload(){
	document.getElementById('crearO').disabled = true;
	document.getElementById('enviarC').disabled = true;
}

function validarConsulta(){
	var consulta = document.getElementById('consulta')
	var dFinal = document.getElementById('fechaFinal')
	var dInicial = document.getElementById('fechaInicial')

	if(consulta.value != "" && dFinal.value != "" && dInicial.value != ""){
		if(validatFecha(dFinal, dInicial)){
			if(bloquearConsulta){
				enableDisable('consulta');
				enableDisable('fechaInicial');
				enableDisable('fechaFinal');
				bloquearConsulta = false;
			}
			isConsultaNull = false
			crearOpcion();
		}
	}else{
		isConsultaNull = true;
		alert("Campos vacios");
	}
}

function validatFecha(dFinal, dInicial){
	
	var fechaActual = new Date();
    var dia = fechaActual.getDate();
	var mes = fechaActual.getMonth();
	
	dFinal = document.getElementById("fechaFinal").value.split("/");
	dInicial = document.getElementById("fechaInicial").value.split("/");
	
	dFinal = new Date(parseInt(dFinal[2]),parseInt(dFinal[1]),parseInt(dFinal[0]))
	dInicial = new Date(parseInt(dInicial[2]),parseInt(dInicial[1]),parseInt(dInicial[0]))
	
	var tiempoFecha = dFinal - dInicial;
		
	if(dInicial > fechaActual && dInicial < dFinal && tiempoFecha >= 1){
		return true;	
	}else if(tiempoFecha == 0){
		alert('Timepo minimo 1 dia');
	}else if(tiempoFecha < 0){
		alert('El dia de cierre no puede ser menor que el de apertura');
	}else if(dInicial <= fechaActual){
		alert('El dia ha de ser posterior al dia actual');
	}else{
		alert('Formato Incorrecto');
	}

	return false;
}

function validarOpciones(){
	
	var numOpcionesNull = 0;
	var inputs = document.getElementsByClassName('iOpciones');
	
	for(var num=0; num<inputs.length;num++){
		if(inputs[num].value != ""){
			numOpcionesNull++;
		}else{
			inputs[num].style.border = "2px solid red";
		}
		
	}
	
	if(numOpciones >= 2 && numOpcionesNull == inputs.length){
		return true;
	}
	alert("Menos de 2 Opciones o Campos Vacios")
	
	return false;
}

function crearConsulta(){
		
	var label = document.createElement("label");
	var textNodeLabel = document.createTextNode("Escribe la consulta: ");
	label.appendChild(textNodeLabel);

	var textareaConsulta = document.createElement("textarea");
	textareaConsulta.setAttribute('id','consulta')
	textareaConsulta.setAttribute('name','consulta')
	
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
	inputDataInici.setAttribute('placeholder','DD/MM/YYYY');

	var labelDataFinal = document.createElement("label");
	var textNodeLabelFinal = document.createTextNode(" Fecha de cierre: ");
	labelDataFinal.appendChild(textNodeLabelFinal);

	var inputDataFinal = document.createElement("input");
	inputDataFinal.setAttribute('name','fechaFinal')
	inputDataFinal.setAttribute('class','fecha');
	inputDataFinal.setAttribute('id','fechaFinal');
	inputDataFinal.setAttribute('placeholder','DD/MM/YYYY');

	var bsubmit = document.createElement('input');
	bsubmit.setAttribute('id','eConsulta');
	bsubmit.setAttribute('value',' ');
	bsubmit.setAttribute('type','submit');
	bsubmit.setAttribute('name','eConsulta');
	bsubmit.setAttribute('style','display:none');

	var formulario = document.createElement("form");
	formulario.setAttribute('action','enviarConsulta.php');
	formulario.setAttribute('method','post');
	formulario.setAttribute('id','myform');
	formulario.setAttribute('onsubmit','return enviar()');

	formulario.appendChild(label);
	formulario.appendChild(br);
	formulario.appendChild(textareaConsulta);
	formulario.appendChild(br2);

	formulario.appendChild(labelDataInici);
	formulario.appendChild(inputDataInici);

	formulario.appendChild(labelDataFinal);
	formulario.appendChild(inputDataFinal);

	formulario.appendChild(br3);

	formulario.appendChild(bsubmit);

	var padre = document.body;

	padre.insertBefore(formulario,padre.childNodes[3]);

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
	label.setAttribute('class','lOpciones');
	label.setAttribute('id','l'+numOpciones);
	var textNodeLabel = document.createTextNode("Opcion " + numOpciones + ": ");
	label.appendChild(textNodeLabel);
	
	var input = document.createElement("input");
	input.setAttribute('class','iOpciones');
	input.setAttribute('id','i'+numOpciones);
	input.setAttribute('name','i[]');
	
	var borrar = document.createElement("button");
	borrar.setAttribute('id','b'+numOpciones);
	borrar.setAttribute('class','borrarButtons');
	borrar.setAttribute('onclick','borrarOpcion('+numOpciones+')');
	
	var textNodeButton = document.createTextNode("X");
	borrar.appendChild(textNodeButton);
	
	var br = document.createElement("br");
	br.setAttribute('id','br'+numOpciones);

 	var lugar = document.getElementsByTagName("form")[0].lastElement;
 	document.body.getElementsByTagName("form")[0].insertBefore(label,lugar);
 	document.body.getElementsByTagName("form")[0].insertBefore(input,lugar);
 	document.body.getElementsByTagName("form")[0].insertBefore(borrar,lugar);
 	document.body.getElementsByTagName("form")[0].insertBefore(br,lugar);
}

function eSubmit(){

	if(!isConsultaNull && validarOpciones()){
		var submit = document.getElementById('eConsulta')
		var formulario = document.getElementById("myform");
		submit.value = 'Crear Consulta';
		enableDisable('consulta');
		enableDisable('fechaInicial');
		enableDisable('fechaFinal');
		formulario.submit();
	}

	
}

function borrarOpcion(id){
	var numLabel = 1;
	
	var iBorrar = document.getElementById('i'+id)
	var bBorrar = document.getElementById('b'+id)
	var lBorrar = document.getElementById('l'+id)
	var brBorrar = document.getElementById('br'+id)
	
	iBorrar.parentNode.removeChild(iBorrar);
	bBorrar.parentNode.removeChild(bBorrar);
	lBorrar.parentNode.removeChild(lBorrar);
	brBorrar.parentNode.removeChild(brBorrar);
	
	numOpciones--;
	
	var label = document.getElementsByClassName('lOpciones');
	
	for(var num=0; num<label.length;num++){
		label[num].innerHTML = "Opcion " + numLabel + ": "
		numLabel++
	}
}


function enviar(){
	var formulario = document.getElementById("myform");	
	var dato = document.getElementById('eConsulta');
 
	if (dato.value=="Crear Consulta"){
		formulario.submit();
		return true;
	} else {
		return false;
	}
}

function mostrarOpciones(b){
	var numId = b.id;
	var nombreClasse = document.getElementById('o'+ numId).className
	
	if(nombreClasse == 'opcionesOculto'){
		document.getElementById('o'+ numId).className = 'opcionesVisible';
		
	}else if(nombreClasse == 'opcionesVisible'){
		document.getElementById('o'+ numId).className = 'opcionesOculto';
	}
	
	
}
