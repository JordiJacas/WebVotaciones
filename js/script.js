//Variables Globales
var numOpciones = 0;
var isConsultaNull = true;
var bloquearConsulta = true;


function onload(){
	//Desabilitar botones de Crear Opcion i Enviar Consulta al cargar la pagina.
	enableDisable('crearO');
	enableDisable('enviarC');
}

function validarConsulta(){
	//Obtenemos los elementos.
	var consulta = document.getElementById('consulta')
	var dFinal = document.getElementById('fechaFinal')
	var dInicial = document.getElementById('fechaInicial')
	
	//Comparamos el valor de los elementos para que no esten  vacios.
	if(consulta.value != "" && dFinal.value != "" && dInicial.value != ""){
		//Validamos que los campos de fecha esten correctos.
		if(validatFecha(dFinal, dInicial)){
			if(bloquearConsulta){
				//Desabilitamos los campos de consula i fechas para no poder modificarlos.
				enableDisable('consulta');
				enableDisable('fechaInicial');
				enableDisable('fechaFinal');
				bloquearConsulta = false;
			}
			//Ejecutamos la funcion para crear opciones i ponemos la variable global a false.
			isConsultaNull = false
			crearOpcion();
		}
	}else{
		//Ponemos la variable global a true i mostramos un mensaje.
		isConsultaNull = true;
		alert("Campos vacios");
		pintaRojo('consulta');
		pintaRojo('fechaInicial');
		pintaRojo('fechaFinal');
	}
}

function pintaRojo (id){
	document.getElementById(id).style.borderColor = 'red';
}

function validatFecha(dFinal, dInicial){
	
	//Obtenemos los elementos.
	var fechaActual = new Date();
    var dia = fechaActual.getDate();
	var mes = fechaActual.getMonth();
	
	//Separamos los distintos numero (dd/mm/yyyy) i los introducimos en una array.
	dFinal = document.getElementById("fechaFinal").value.split("/");
	dInicial = document.getElementById("fechaInicial").value.split("/");
	
	//Obtenemos los valores de las arrays y passamos las variables a formato de fecha.
	dFinal = new Date(parseInt(dFinal[2]),parseInt(dFinal[1]),parseInt(dFinal[0]))
	dInicial = new Date(parseInt(dInicial[2]),parseInt(dInicial[1]),parseInt(dInicial[0]))
	
	//Calculamos la diferencia que hay entre las dos fechas.
	var tiempoFecha = dFinal - dInicial;
	
	//Comparamos las fechas, si hay algun error muestra un mensaje con ese error i devuelve false, si no devuleve true.
	if(dInicial > fechaActual && dInicial < dFinal && tiempoFecha >= 1){
		return true;	
	}else if(tiempoFecha == 0){
		alert('Tiempo minimo 1 dia');
		pintaRojo('fechaInicial');
		pintaRojo('fechaFinal');
	}else if(tiempoFecha < 0){
		alert('El dia de cierre no puede ser menor que el de apertura');
		pintaRojo('fechaFinal');
	}else if(dInicial < fechaActual){
		alert('El dia ha de ser posterior al dia actual');
		pintaRojo('fechaInicial');
	}else{
		alert('Formato Incorrecto');
		pintaRojo('fechaInicial');
		pintaRojo('fechaFinal');
	}

	return false;
}

function validarOpciones(){
	
	//Obtenemos el elemento i creamos una variable para contar los valores no nulos.
	var numOpcionesNotNull = 0;
	var inputs = document.getElementsByClassName('iOpciones');
	
	//Hacemos un bucle para passar por todos los inputs.
	for(var num=0; num<inputs.length;num++){
		if(inputs[num].value != ""){
			//Sumamos 1 si los inputs tienen contenido.
			numOpcionesNotNull++;
			//Cambiamos el color del borde si esta dentro.
			inputs[num].style.borderColor = "";

		}else{
			//Cambiamos el color del borde si estan vacios.
			inputs[num].style.borderColor = "red";
		}
		
	}
	
	//Comparamos que la variable global sea mayor a 2 i que el numero de inputs con contenido sea igual a la cantidad de inputs en la pagina. 
	if(numOpciones >= 2 && numOpcionesNotNull == inputs.length){
		return true;
	}
	alert("Menos de 2 Opciones o Campos Vacios")
	
	return false;
}

function colorLleno(b) {
    b.style.borderColor = "";

}
function colorVacio(b) {
	if(b.value == ""){
    	b.style.borderColor = "red";
	}
}

function crearConsulta(){
	
	//Creamos el label y el texto que tendra.	
	var label = document.createElement("label");
	var textNodeLabel = document.createTextNode("Escribe la consulta: ");
	label.appendChild(textNodeLabel);
	
	//Creamos el texarea y le añadimos atributos.
	var textareaConsulta = document.createElement("textarea");
	textareaConsulta.setAttribute('id','consulta')
	textareaConsulta.setAttribute('name','consulta')
	textareaConsulta.setAttribute('onfocusin','colorLleno(this)');
	textareaConsulta.setAttribute('onfocusout','colorVacio(this)');
	
	//Creamos los todos los br.
	var br = document.createElement("br");
	var br2 = document.createElement("br");
	var br3 = document.createElement("br");
	
	//Creamos el label de la fecha inicial.
	var labelDataInici = document.createElement("label");
	var textNodeLabelInici = document.createTextNode("Fecha de apertura: ");
	labelDataInici.appendChild(textNodeLabelInici);
	
	//Creamos el input de la fecha inicail y le añadimos atributos.
	var inputDataInici = document.createElement("input");
	inputDataInici.setAttribute('name','fechaInicial');
	inputDataInici.setAttribute('class','fecha');
	inputDataInici.setAttribute('id','fechaInicial');
	inputDataInici.setAttribute('onfocusin','colorLleno(this)');
	inputDataInici.setAttribute('onfocusout','colorVacio(this)');
	inputDataInici.setAttribute('placeholder','DD/MM/YYYY');
	
	//Creamos el label de la fecha final.
	var labelDataFinal = document.createElement("label");
	var textNodeLabelFinal = document.createTextNode(" Fecha de cierre: ");
	labelDataFinal.appendChild(textNodeLabelFinal);
	
	//Creamos el input de la fecha final y le añadimos atributos.
	var inputDataFinal = document.createElement("input");
	inputDataFinal.setAttribute('onfocusin','colorLleno(this)');
	inputDataFinal.setAttribute('onfocusout','colorVacio(this)');
	inputDataFinal.setAttribute('name','fechaFinal')
	inputDataFinal.setAttribute('class','fecha');
	inputDataFinal.setAttribute('id','fechaFinal');
	inputDataFinal.setAttribute('placeholder','DD/MM/YYYY');
	
	//Creamos un submit que ejecutara el formulario y le añadimos atributos.
	var bsubmit = document.createElement('input');
	bsubmit.setAttribute('id','eConsulta');
	bsubmit.setAttribute('value',' ');
	bsubmit.setAttribute('type','submit');
	bsubmit.setAttribute('name','eConsulta');
	bsubmit.setAttribute('style','display:none');
	
	//Creamos el formulario i le añadimos atributos.
	var formulario = document.createElement("form");
	formulario.setAttribute('action','enviarConsulta.php');
	formulario.setAttribute('method','post');
	formulario.setAttribute('id','myform');
	formulario.setAttribute('onsubmit','return enviar()');
	
	//Introduciomos todos los elementos dentro del formulario.
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
	
	//Intorducimos el formulario dentro del body,
	var padre = document.body;

	padre.insertBefore(formulario,padre.childNodes[4]);
	
	//Habilitamos los votones de Crear Opciones y Enviar Consula, y deshabilitamos el boton de Crear Consulta. 
	enableDisable('crearC');
	enableDisable('crearO');
	enableDisable('enviarC');


}

function enableDisable(id){
	
	btn = document.getElementById(id);
	
	//Deshabilitamos o habilitamo el elemento segun su estado. 
	if(btn.disabled == true){
		btn.disabled = false;
	}
	else if(btn.disabled == false){
		btn.disabled = true;
	}
}

function crearOpcion(){
	//Sumamos uno a la variable global siempre que se ejecute la funcion.
	numOpciones++;
	
	//Creamos el label, le añadimos atributos y le introducimos el texto.
	var label = document.createElement("label");
	label.setAttribute('class','lOpciones');
	label.setAttribute('id','l'+numOpciones);
	var textNodeLabel = document.createTextNode("Opcion " + numOpciones + ": ");
	label.appendChild(textNodeLabel);
	
	//Creamos el input y le añadimos atributos.
	var input = document.createElement("input");
	input.setAttribute('class','iOpciones');
	input.setAttribute('onfocusin','colorLleno(this)');
	input.setAttribute('onfocusout','colorVacio(this)');
	input.setAttribute('id','i'+numOpciones);
	input.setAttribute('name','i[]');
	
	//Creamos el boton de borrar, le añadimos los atributos y el texo.
	var borrar = document.createElement("button");
	borrar.setAttribute('id','b'+numOpciones);
	borrar.setAttribute('class','borrarButtons');
	borrar.setAttribute('onclick','borrarOpcion('+numOpciones+')');
	var textNodeButton = document.createTextNode("X");
	borrar.appendChild(textNodeButton);
	
	//Creamos el br y le intoducimos atributos.
	var br = document.createElement("br");
	br.setAttribute('id','br'+numOpciones);
	
	//Insertamos todos los elementos dentro del form, en la ultima posicion.
 	var lugar = document.getElementsByTagName("form")[0].lastElement;
 	document.body.getElementsByTagName("form")[0].insertBefore(label,lugar);
 	document.body.getElementsByTagName("form")[0].insertBefore(input,lugar);
 	document.body.getElementsByTagName("form")[0].insertBefore(borrar,lugar);
 	document.body.getElementsByTagName("form")[0].insertBefore(br,lugar);
}

function eSubmit(){
	
	//Comprovamos que todos los campos estan conrrectos.
	if(!isConsultaNull && validarOpciones()){
		
		//Obtenemos los elementos.
		var bsubmit = document.getElementById('eConsulta')
		var formulario = document.getElementById("myform");
		
		//Cambia el valor del submit.
		bsubmit.value = 'Crear Consulta';
		//Habilita los inputs de consulta, fechaInicial y fechaFinal.
		enableDisable('consulta');
		enableDisable('fechaInicial');
		enableDisable('fechaFinal');
		//Ejecuta el formulario.
		formulario.submit();
	}

	
}

function borrarOpcion(id){
	//Variable inicial.
	var numLabel = 1;
	
	//Obtenemos los elementos con su id.
	var iBorrar = document.getElementById('i'+id)
	var bBorrar = document.getElementById('b'+id)
	var lBorrar = document.getElementById('l'+id)
	var brBorrar = document.getElementById('br'+id)
	
	//Borramos todos los elementos.
	iBorrar.parentNode.removeChild(iBorrar);
	bBorrar.parentNode.removeChild(bBorrar);
	lBorrar.parentNode.removeChild(lBorrar);
	brBorrar.parentNode.removeChild(brBorrar);
	
	//Resta 1 a la variable global.
	numOpciones--;
	
	//cambiaos el texto que contienen los label de cada input.
	var label = document.getElementsByClassName('lOpciones');
	
	for(var num=0; num<label.length;num++){
		label[num].innerHTML = "Opcion " + numLabel + ": "
		numLabel++
	}

	habilitarConsulta();
}


function enviar(){
	//Variables para los elementos.
	var formulario = document.getElementById("myform");	
	var dato = document.getElementById('eConsulta');
	
	//Comparamos el valor del submit para decidir si ejecutamos o no el formulario.
	if (dato.value=="Crear Consulta"){
		formulario.submit();
		alert('Formulario enviado correctamente.');
		return true;
	} else {
		return false;
	}
}

function mostrar(elemento){
	//Obtenomos el id del elemento seleccionado.
	var numId = elemento.id;
	//Obtenemos la classe que tiene el elemento.
	var nombreClasse = document.getElementById('o'+ numId).className
	
	//Cambiamos de classe segun la que tenga en este momento.
	if(nombreClasse == 'opcionesOculto'){
		document.getElementById('o'+ numId).className = 'opcionesVisible';
		
	}else if(nombreClasse == 'opcionesVisible'){
		document.getElementById('o'+ numId).className = 'opcionesOculto';
	}
}

function mostrarOpciones(elemento){
	//Obtenomos el id del elemento seleccionado.
	var numId = elemento.id;
	//Obtenemos la classe que tiene el elemento.
	var nombreClasse = document.getElementById('o'+ numId).className
	
	//Cambiamos de classe segun la que tenga en este momento.
	if(nombreClasse == 'opcionesOculto'){
		document.getElementById('o'+ numId).className = 'opcionesVisible';
		
	}else if(nombreClasse == 'opcionesVisible'){
		document.getElementById('o'+ numId).className = 'opcionesOculto';
	}
}
