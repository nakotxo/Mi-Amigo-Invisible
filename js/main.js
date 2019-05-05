/**
 * Variables Globales
 */
var arrayParticipantes= new Array() ; //array con el valor de los UsuId
var NumHijos;
var NumHijosUlFinal;
var botonCreado=0;
var contInput=0;
var liConDobleClick;
var contParticipantes = 0;
var ulFinal = $("#divParticipantes"); // nodo lista de participantes

	$(document).ready(function () {
		// $("#parrafo").dblclick(function () {
		// 	alert("has hecho doble click en el párrafo con id=parrafo");
		// });
		// $('.option').click(function () {
		// 	alert("has hecho doble click en el option");
		// });
		
		
		// $("li").dblclick(function(){
		// 	//alert("hello");
		// 	//debugger;
		// 	textoLi = $(this)[0].textContent;

		// 	if ( textoLi !== liConDobleClick){
		// 		AgregarUsuariosAListaSorteo($(this));
		// 		liConDobleClick = textoLi;
		// 	}
		// });

		$(".Usuarios").dblclick(function(){
			
			
			//alert("pulsado en la card");

			var textoLi = $(this)[0].textContent;
			if ( textoLi !== liConDobleClick){

				var padre = this.parentNode.id;
				var NumDelHijo=$(this).index();
				AgregarUsuariosADivParticipantes($(this)[0], padre, NumDelHijo);
				
				liConDobleClick = textoLi;
			}

		});

		// $("#LstUsuFin").dblclick(function(){
		// 	//alert("has hecho doble click en ul con numero hijos "+ NumHijos+", en el li hijo: ");
		// 	alert("Esta función todavía no está en funcionamiento\nPulse CORREGIR DATOS para reiniciar.");
		// });

		// $("#divParticipantes > p").dblclick(function(){
		// 	alert("hola tu");
		// })



	

	});

	

// function holahola(esto){
// 	alert("holahola: " + esto);
// }




	function AgregarUsuariosADivParticipantes(objTextoPulsado, padre, NumDelHijo){
		// textoPulsado = objTextoPulsado.textContent;
		// alert("texto " + textoPulsado );
		//p --> value = 0 - title="Jose Iganacio"

		var titulo = objTextoPulsado.title;
		var valor = objTextoPulsado.attributes.value.value;

		var DatosUsuClick = {"titulo":titulo, "valor":valor};	

		
	
		/*-----Creamos un nodo nuevo con su atributo para agregar a la lista definitiva de partiticipantes*/    
		var elementoP = $("<p></p>").text( DatosUsuClick.valor + " - " + DatosUsuClick.titulo); 
		elementoP.attr({"class": "Usuarios", "title": DatosUsuClick.titulo, "value": DatosUsuClick.valor})
		$("#divParticipantes").append(elementoP);
		contParticipantes = ulFinal[0].childElementCount;

		//alert(contParticipantes);
		/*--------------------------------------------- FIN --------------------------------------------- */

		/*------  Creamos un imput con la cantidad de hijos ------*/
		if (contParticipantes == 1){
			var nodoTotalInput=document.createElement("input");
			$(nodoTotalInput).attr("value",contParticipantes);
			$(nodoTotalInput).attr("id","hijos");
			$(nodoTotalInput).attr("name","hijos");
			$(nodoTotalInput).attr("type","hidden");
			formularioSorteo.appendChild(nodoTotalInput);
		}else{
			document.getElementById("hijos").value=contParticipantes;
		}
		/*--------------------------- FIN -------------------------*/

		/*------ Creamos input con el ID del Usuario a participar para realizar un envio de los datos y enviar por Post -----*/
		var nodoInput= document.createElement("input");
		$(nodoInput).attr("type","hidden");
		$(nodoInput).attr("value",valor);
		$(nodoInput).attr("name","input" + (contParticipantes-1));
		arrayParticipantes.unshift(valor);

		formularioSorteo.appendChild(nodoInput);
		/* ------------------------------------------FIN--------------------------------- */



		/*--- Si los participantes son mas de tres creamos un boton para el envio de datos ---*/
		if ((contParticipantes>3)&&(botonCreado==0)){
			var nodoBoton= document.createElement("input");
			$(nodoBoton).attr("value","SuperSorteo");
			$(nodoBoton).attr("name","Sorteo");
			$(nodoBoton).attr("type","submit");
			$(nodoBoton).attr("id","botoSor");
			$(nodoBoton).attr("class","btn btn-info");
			$("#forSor").append(nodoBoton);
			botonCreado=1;
		}
		/* ----------------------------------------- Fin -------------------------------------- */
		/*------Eliminación del mismo dato para no crear duplicados en las listas--------- */
			//debugger;
			$("#"+padre)[0].removeChild($("#"+padre)[0].children[NumDelHijo]);
		/*-------------------------------fin de eliminacion------------------------------- */

	}


// function AgregarUsuariosAListaSorteo(liPulsado){
// 			//Declaración de variables
// 			var ulUsu = document.getElementById("LstUsu"); // nodo Lista de usuarios
// 			var ulFinal = document.getElementById("LstUsuFin"); // nodo lista de participantes
// 			var formularioSorteo = document.getElementById("formularioSorteo");
// 			NumHijos= ulUsu.children.length; //numero de hijos que tiene la lista
// 			var NumDelHijo=$(liPulsado).index(); // numero del indice del hijo
// 			var valor= $(liPulsado).attr("value"); //valor del attr value del li
// 			var Title = $(liPulsado).attr("title"); //valor de attr title del li
		   
// /*-----Creamos un nodo nuevo con su atributo para agregar a la lista definitiva de partiticipantes*/    
			
// 			var nodo = document.createElement("li");
// 			var textoNodo = document.createTextNode(valor+" - "+Title);
// 			nodo.appendChild(textoNodo);
// 			$(nodo).attr("title",Title);
// 			$(nodo).attr("value",valor);
			
// 			ulFinal.insertBefore(nodo,ulFinal.children[0]);
// 			arrayParticipantes.unshift(valor);
// 			NumHijosUlFinal=ulFinal.children.length;

// /*------ Creamos input para realizar un envio de los datos y enviar por Post -----*/
// 			var nodoInput= document.createElement("input");
// 			//$(nodoInput).attr("type","hidden");
// 			$(nodoInput).attr("value",valor);
// 			$(nodoInput).attr("name","input"+contInput);
			
// 			formularioSorteo.appendChild(nodoInput);
// /* ------------------------------------------------------------------------------ */
// 			if (contInput==0){
// 			   var nodoTotalInput=document.createElement("input");
// 			   $(nodoTotalInput).attr("value",contInput+1);
// 			   $(nodoTotalInput).attr("id","hijos");
// 			   $(nodoTotalInput).attr("name","hijos");
// 			   //$(nodoTotalInput).attr("type","hidden");
// 			   formularioSorteo.insertBefore(nodoTotalInput,formularioSorteo.children[0]);
// 			}else{
// 				document.getElementById("hijos").value=contInput+1;
// 			}
// 			contInput++;
// 			if ((NumHijosUlFinal>=3)&&(botonCreado==0)){
// 				var nodoBoton= document.createElement("input");
// 				$(nodoBoton).attr("value","SuperSorteo");
// 				$(nodoBoton).attr("name","Sorteo");
// 				$(nodoBoton).attr("type","submit");
// 				$(nodoBoton).attr("id","botoSor");
// 				$(nodoBoton).attr("margin-right","30px");
// 				formularioSorteo.appendChild(nodoBoton);
// 				botonCreado=1;
// 			}

// /* ------------------------------fin de la inserción---------------------------------------------- */
// /*------Eliminación del mismo dato para no crear duplicados en las listas--------- */
		
// 			//alert("has hecho doble click en ul con numero hijos "+ NumHijos+", en el li hijo: "+NumDelHijo);
// 			ulUsu.removeChild(ulUsu.children[NumDelHijo]);
// /*-------------------------------fin de eliminacion------------------------------- */



// 		/*$("#Corregir").click(function(){
// 			alert("has hecho doble click botón Corregir");
// 		   // header('Location: Crear_Sorteo');
// 			//window.location.href=http://'.URLSERVIDOR.'/index.php/Home
// 			//location.reload;
// 			alert("has hecho doble click botón Corregir");
// 		});*/
	
// }