/*
** Script.js
** Creador: Jordi Jacas
** Archivo donde se alojan todas las funciones de Javascript del Proyecto "Vota"
*/

/*
** Variables Globales
*/
var numOpciones = 0;
var isConsultaNull = true;
var bloquearConsulta = true;

/*
** Funcion que se ejecuta al cargar la pagina "crearConsulta.php"
** Entrada: NULL
** Salida: NULL
*/
function onload(){
	//Desabilitar botones de Crear Opcion i Enviar Consulta al cargar la pagina.
	enableDisable('crearO');
	enableDisable('enviarC');
	enableDisable('borrarO');
}

/*
** Funcion que se ejecuta en el "onclick" del voton "crearO" de "crearConsulta.php"
** Entrada: NULL
** Salida: NULL
*/
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

/*
** Funcion que se ejecuta la funcion "validarConsulta" (funcion de arriba) para pintar los recuadros de "crearConsulta.php"
** Entrada: int id
** Salida: NULL
*/
function pintaRojo (id){
	document.getElementById(id).style.borderColor = 'red';
}

/*
** Funcion que hace la validacion de las fechas introducidas en la pagina "crearConsultas.php"
** Entrada: Date dFinal, Date dinicial
** Salida: true // false
*/
function validatFecha(dFinal, dInicial){
	
	//Obtenemos los elementos.
	var fechaActual = new Date();
	
	//fechaActual.setHours(00);
	//fechaActual.setMinutes(00)
	fechaActual.setSeconds(00)
	fechaActual.setMilliseconds(00)
	
	//Separamos los distintos numero (dd/mm/yyyy) i los introducimos en una array.
	dFinal = document.getElementById("fechaFinal").value.split("-");
	hFinal = document.getElementById("horaFinal").value.split(":");
	
	dInicial = document.getElementById("fechaInicial").value.split("-");
	hInicial = document.getElementById("horaInicial").value.split(":");
	
	//Obtenemos los valores de las arrays y passamos las variables a formato de fecha.
	dFinal = new Date(parseInt(dFinal[0]),parseInt(dFinal[1]-1),parseInt(dFinal[2]),parseInt(hFinal[0]),parseInt(hFinal[1]));
	dInicial = new Date(parseInt(dInicial[0]),parseInt(dInicial[1]-1),parseInt(dInicial[2]),parseInt(hInicial[0]),parseInt(hInicial[1]));
	
	//Calculamos la diferencia que hay entre las dos fechas.
	var tiempoFecha = dFinal - dInicial;
	
	tiempoFecha = tiempoFecha / 3600;
	
	//Comparamos las fechas, si hay algun error muestra un mensaje con ese error i devuelve false, si no devuleve true.
	if(dInicial > fechaActual && dInicial < dFinal && tiempoFecha >= 4000){
		return true;	
	}else if(tiempoFecha < 4000 && tiempoFecha >= 0){
		alert('Tiempo minimo 4 horas');
		pintaRojo('fechaInicial');
		pintaRojo('fechaFinal');
		pintaRojo('horaInicial');
		pintaRojo('horaFinal');
	}else if(tiempoFecha < 0){
		alert('El dia de cierre no puede ser menor que el de apertura');
		pintaRojo('fechaFinal');
		pintaRojo('horaFinal');
	}else if(dInicial <= fechaActual){
		alert('El dia ha de ser posterior al dia actual');
		pintaRojo('fechaInicial');
		pintaRojo('horaInicial');
	}else{
		alert('Formato Incorrecto');
		pintaRojo('fechaInicial');
		pintaRojo('fechaFinal');
		pintaRojo('horaInicial');
		pintaRojo('horaFinal');
	}

	return false;
}

/*
** Funcione que hace la validacion de los campos de la pagina "crearConsulta.php"
** Entrada: NULL
** Sallida: true // false
*/
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

/*
** Funcione que le da el atributo del borde en la funcion "crearConsulta" (funcion que esta mas abajo)
** Entrada: String this
** Sallida: NULL
*/
function colorLleno(b) {
    b.style.borderColor = "";

}

/*
** Funcione que le da el atributo del borde en la funcion "crearConsulta" (funcion que esta mas abajo)
** Entrada: String this
** Sallida: NULL
*/
function colorVacio(b) {
	if(b.value == ""){
    	b.style.borderColor = "red";
	}
}

/*
** Funcione se ejecuta al clickar el boton de "crearConsulta" en la pagina "crearConsulta.php"
** Entrada: NULL
** Sallida: NULL
*/
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
	var br4 = document.createElement("br");
	
	//Creamos el label de la fecha inicial(dias).
	var labelDataInici = document.createElement("label");
	var textNodeLabelInici = document.createTextNode("Fecha de apertura: ");
	labelDataInici.appendChild(textNodeLabelInici);
	
	//Creamos el input de la fecha inicial y le añadimos atributos(dias).
	var inputDataInici = document.createElement("input");
	inputDataInici.setAttribute('name','fechaInicial');
	inputDataInici.setAttribute('class','fecha');
	inputDataInici.setAttribute('id','fechaInicial');
	inputDataInici.setAttribute('type','date');
	inputDataInici.setAttribute('onfocusin','colorLleno(this)');
	inputDataInici.setAttribute('onfocusout','colorVacio(this)');
	
	//Creamos el label de la fecha inicial(horas).
	var labelHoraInici = document.createElement("label");
	var textNodeLabelHoraInici = document.createTextNode("Hora de apertura: ");
	labelHoraInici.appendChild(textNodeLabelHoraInici);
	
	//Creamos el input de la fecha inicial y le añadimos atributos(horas).
	var inputHoraInici = document.createElement("input");
	inputHoraInici.setAttribute('name','horaInicial');
	inputHoraInici.setAttribute('class','fecha');
	inputHoraInici.setAttribute('id','horaInicial');
	inputHoraInici.setAttribute('type','time');
	inputHoraInici.setAttribute('onfocusin','colorLleno(this)');
	inputHoraInici.setAttribute('onfocusout','colorVacio(this)');
	
	//Creamos el label de la fecha final.
	var labelDataFinal = document.createElement("label");
	var textNodeLabelFinal = document.createTextNode(" Fecha de cierre: ");
	labelDataFinal.appendChild(textNodeLabelFinal);
	
	//Creamos el input de la fecha final y le añadimos atributos.
	var inputDataFinal = document.createElement("input");
	inputDataFinal.setAttribute('onfocusin','colorLleno(this)');
	inputDataFinal.setAttribute('onfocusout','colorVacio(this)');
	inputDataFinal.setAttribute('name','fechaFinal');
	inputDataFinal.setAttribute('type','date');
	inputDataFinal.setAttribute('class','fecha');
	inputDataFinal.setAttribute('id','fechaFinal');
	
	//Creamos el label de la fecha final(horas).
	var labelHoraFinal = document.createElement("label");
	var textNodeLabelHoraFinal = document.createTextNode("Hora de cierre: ");
	labelHoraFinal.appendChild(textNodeLabelHoraFinal);
	
	//Creamos el input de la fecha final y le añadimos atributos(horas).
	var inputHoraFinal = document.createElement("input");
	inputHoraFinal.setAttribute('name','horaInicial');
	inputHoraFinal.setAttribute('class','fecha');
	inputHoraFinal.setAttribute('id','horaFinal');
	inputHoraFinal.setAttribute('type','time');
	inputHoraFinal.setAttribute('onfocusin','colorLleno(this)');
	inputHoraFinal.setAttribute('onfocusout','colorVacio(this)');
	
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
	formulario.appendChild(labelHoraInici);
	formulario.appendChild(inputHoraInici);
	
	formulario.appendChild(br3);

	formulario.appendChild(labelDataFinal);
	formulario.appendChild(inputDataFinal);
	formulario.appendChild(labelHoraFinal);
	formulario.appendChild(inputHoraFinal);

	formulario.appendChild(br4);

	formulario.appendChild(bsubmit);
	
	//Intorducimos el formulario dentro del body,
	var padre = document.body;

	padre.insertBefore(formulario,padre.childNodes[4]);
	
	//Habilitamos los votones de Crear Opciones y Enviar Consula, y deshabilitamos el boton de Crear Consulta. 
	enableDisable('crearC');
	enableDisable('crearO');
	enableDisable('enviarC');
	enableDisable('borrarO');


}

/*
** Funcion que se ejecuta para habilitar o deshabilitar elementos
** Entrada: int id
** Sallida: NULL
*/
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

/*
** Funcion que crea la opcion en la pagina "crearConsulta.php" y se ejecuta en la funcion "validarConsulta" (funcion arriba del todo)
** Entrada: NULL
** Salida: NULL
*/
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
	br.setAttribute('class','brOpciones');

	//Creamos el boton de subir, le añadimos los atributos y el texo.
	var subir = document.createElement("button");
	subir.setAttribute('id','s'+numOpciones);
	subir.setAttribute('class','subirButtons');
	subir.setAttribute('onclick','subirOpcion('+numOpciones+')');
	var textNodeButton = document.createTextNode("▲");
	subir.appendChild(textNodeButton);

	//Creamos el boton de bajar, le añadimos los atributos y el texo.
	var bajar = document.createElement("button");
	bajar.setAttribute('id','u'+numOpciones);
	bajar.setAttribute('class','bajarButtons');
	bajar.setAttribute('onclick','bajarOpcion('+numOpciones+')');
	var textNodeButton = document.createTextNode("▼");
	bajar.appendChild(textNodeButton);
	
	//Insertamos todos los elementos dentro del form, en la ultima posicion.
 	var lugar = document.getElementsByTagName("form")[0].lastElement;
 	document.body.getElementsByTagName("form")[0].insertBefore(label,lugar);
 	document.body.getElementsByTagName("form")[0].insertBefore(input,lugar);
 	document.body.getElementsByTagName("form")[0].insertBefore(borrar,lugar);
 	document.body.getElementsByTagName("form")[0].insertBefore(subir,lugar);
 	document.body.getElementsByTagName("form")[0].insertBefore(bajar,lugar);
 	document.body.getElementsByTagName("form")[0].insertBefore(br,lugar);
}

/*
** Funcion que se ejecuta al clickar en el boton "Enviar consulta" de la pagina "crearConsulta.php"
** Entrada: NULL
** Salida: NULL
*/
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

/*
** Funcion que borra la opcion, tambien en la funcion "crearOpcion" y le da la propiedad al boton (arriba) 
** Entrada: int id
** Salida: NULL
*/
function borrarOpcion(id){
	//Variable inicial.
	var numId = 1;
	
	//Obtenemos los elementos con su id.
	var iBorrar = document.getElementById('i'+id)
	var bBorrar = document.getElementById('b'+id)
	var lBorrar = document.getElementById('l'+id)
	var brBorrar = document.getElementById('br'+id)
	var sBorrar = document.getElementById('s'+id);
	var uBorrar = document.getElementById('u'+id);
	
	//Borramos todos los elementos.
	iBorrar.parentNode.removeChild(iBorrar);
	bBorrar.parentNode.removeChild(bBorrar);
	lBorrar.parentNode.removeChild(lBorrar);
	brBorrar.parentNode.removeChild(brBorrar);
	sBorrar.parentNode.removeChild(sBorrar);
	uBorrar.parentNode.removeChild(uBorrar);
	
	//Resta 1 a la variable global.
	numOpciones--;
	
	//cambiaos el texto que contienen los label de cada input.
	var label = document.getElementsByClassName('lOpciones');
	var input = document.getElementsByClassName('iOpciones');
	var boton = document.getElementsByClassName('borrarButtons');
	var br = document.getElementsByClassName('brOpciones');
	var subir = document.getElementsByClassName('subirButtons');
	var bajar = document.getElementsByClassName('bajarButtons');
	
	for(var num=0; num<numOpciones;num++){
		label[num].innerHTML = "Opcion " + numId + ": ";
		label[num].id = "l"+numId;
		input[num].id = "i" + numId;
		
		boton[num].id = "b" + numId;
		boton[num].removeAttribute("onclick");
		boton[num].setAttribute("onclick","borrarOpcion("+numId+")");
		
		br[num].id = "br" + numId;
		
		subir[num].id = "s" + numId;
		subir[num].removeAttribute("onclick");
		subir[num].setAttribute("onclick","subirOpcion("+numId+")");
		
		bajar[num].id = "u" + numId;
		bajar[num].removeAttribute("onclick");
		bajar[num].setAttribute("onclick","bajarOpcion("+numId+")");
		
		numId++
	}
}

/*
** Funcion que permite subir opciones un puesto para arriba
** Entrada: int id
** Salida: NULL
*/
function subirOpcion(id){
	//Variable inicial.
	var nuevaPos = id - 1;

	//Obtenemos los elementos con su id.
	var input = document.getElementById('i'+id);
	var input2 = document.getElementById('i'+nuevaPos);

	if(input2 != null){
	
		//Cojemos el valor de los inputs.
		var valorInput = input.value;
		var valorInput2 = input2.value;

		//Cambiamos los valores de posicion;
		input.value = valorInput2;
		input2.value = valorInput;
	}
}

/*
** Funcion que permite bajar de puesto una opcion
** Entrada: int id
** Salida: NULL
*/
function bajarOpcion(id){
	//Variable inicial.
	var nuevaPos = id + 1;

	//Obtenemos los elementos con su id.
	var input = document.getElementById('i'+id);
	var input2 = document.getElementById('i'+nuevaPos);

	if(input2 != null){
		//Cojemos el valor de los inputs.
		var valorInput = input.value;
		var valorInput2 = input2.value;

		//Cambiamos los valores de posicion;
		input.value = valorInput2;
		input2.value = valorInput;
	}

}

/*
** Funcion que permite borrar todas las opciones creadas para la consulta
** Entrada: NULL
** Salida: NULL
*/
function borrarTodasOpciones(){
	
	//Obtenemos los elementos con su id.
	var iBorrar = document.getElementsByClassName('iOpciones');
	var bBorrar = document.getElementsByClassName('borrarButtons');
	var lBorrar = document.getElementsByClassName('lOpciones');
	var brBorrar = document.getElementsByClassName('brOpciones');
	var sBorrar = document.getElementsByClassName('subirButtons');
	var uBorrar = document.getElementsByClassName('bajarButtons');
	
	//Borramos todos los elementos.
	for(var num=0; num < numOpciones;num++){
		
		iBorrar[0].parentNode.removeChild(iBorrar[0]);
		bBorrar[0].parentNode.removeChild(bBorrar[0]);
		lBorrar[0].parentNode.removeChild(lBorrar[0]);
		brBorrar[0].parentNode.removeChild(brBorrar[0]);
		sBorrar[0].parentNode.removeChild(sBorrar[0]);
		uBorrar[0].parentNode.removeChild(uBorrar[0]);
	}
	
	//Pone la variable a su valor inicial.
	numOpciones = 0;
}

/*
** Funcion que envia el formulario y crea en el boton "enviar" de la funcion "crearConsulta" (arriba)
** Entrada: NULL
** Salida: true // false
*/
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
/*
** Funcion que muestra las opciones en la pagina "consulta.php"
** Entrada: NULL
** Salida: NULL
*/
function mostrarOpciones(){
	//Obtenemos la classe que tiene el elemento.
	var consulta = document.getElementsByClassName('opcionesOculto');
	
	consulta[0].className = 'opcionesVisible';
		
}

/*
** Funcion que muestra la consulta elgida y se usa en "funciones.php"
** Entrada: String elem
** Salida: NULL
*/
function mostrarConsultaSel(elem){
	var idConsulta = "consulta"+elem.id;
	var formConsulta = document.getElementById(idConsulta);
	formConsulta.submit();
}

