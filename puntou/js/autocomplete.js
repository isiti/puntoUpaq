$(document).ready(function(){
	$("input[name=search_query]").off('change blur input keyUp').on('change blur input keyUp',function() {
		//$(".search_auto_load").show("slow");
		
		var textoBusqueda = $("#autocomplete_origen").val();
		//console.log("textoBusqueda");
		if(textoBusqueda=="") {
			$(".autocomplete-suggestions").html("");
			$(".autocomplete-suggestions").hide();
			//$(".search_auto_load").hide("slow");
		}		
	   	else
	   	{
			$.post("ajax/autocomplete.php", {valorBusqueda:textoBusqueda}, function(mensaje) {
				$(".autocomplete-suggestions").html(mensaje);
				$(".autocomplete-suggestions").show();
				
				$(".autocomplete-suggestions li").on('click', function(){
					var texto = $(this).text();
					if ($(this).attr("id")=="auto-suggest") texto = $(this).data("text");
					var id = $(this).attr('data-index');
					//console.log(id);
					//console.log(texto);
					$("#autocomplete_origen").val(texto);
					$(".autocomplete-suggestions").hide();
				});
			}); 
	 	} 
	});

	$("input[name=search_query-2]").off('change blur input keyUp').on('change blur input keyUp',function() {
		//$(".search_auto_load").show("slow");
		
		var textoBusqueda = $("#autocomplete_destino").val();
		//console.log("textoBusqueda");
		if(textoBusqueda=="") {
			$(".autocomplete-suggestions-2").html("");
			$(".autocomplete-suggestions-2").hide();
			//$(".search_auto_load").hide("slow");
		}		
	   	else
	   	{
			$.post("ajax/autocomplete.php", {valorBusqueda:textoBusqueda}, function(mensaje) {
				$(".autocomplete-suggestions-2").html(mensaje);
				$(".autocomplete-suggestions-2").show();
				
				$(".autocomplete-suggestions-2 li").on('click', function(){
					var texto = $(this).text();
					if ($(this).attr("id")=="auto-suggest") texto = $(this).data("text");
					var id = $(this).attr('data-index');
					//console.log(id);
					//console.log(texto);
					$("#autocomplete_destino").val(texto);
					$(".autocomplete-suggestions-2").hide();
				});
			}); 
	 	} 
	});

	/*$("input[name=search_query-3]").on('change blur input keyUp',function() {
		//$(".search_auto_load").show("slow");
		
		var textoBusqueda = $("#autocomplete_ask").val();
		//console.log("textoBusqueda");
		if(textoBusqueda=="") {
			$(".autocomplete-suggestions-3").html("");
			$(".autocomplete-suggestions-3").hide();
			//$(".search_auto_load").hide("slow");
		}		
	   	else
	   	{
			$.post("ajax/autocomplete.php", {valorBusqueda:textoBusqueda}, function(mensaje) {
				$(".autocomplete-suggestions-3").html(mensaje);
				$(".autocomplete-suggestions-3").show();
				
				$(".autocomplete-suggestions-3 li").on('click', function(){
					var texto = $(this).text();
					if ($(this).attr("id")=="auto-suggest") texto = $(this).data("text");
					var id = $(this).attr('data-index');
					//console.log(id);
					//console.log(texto);
					$("#autocomplete_ask").val(texto);
					$(".autocomplete-suggestions-3").hide();
				});
			}); 
	 	} 
	});*/

	$("input[name=ubicacion-actual]").on('click',function() {
		//$(".search_auto_load").show("slow");
		var textoBusqueda = $("#ubicacion-actual").val();
		//console.log("textoBusqueda");
		// $.post("ajax/autocomplete.php", {valorBusqueda:textoBusqueda,ubi_ac:'si'}, function(mensaje) {
		// 	$(".completar-ubicacion-actual").html(mensaje);
		// 	$(".completar-ubicacion-actual").show();
		// 	//geocode(get_latactual(),get_longactual())
		// 	$(".completar-ubicacion-actual li").on('click', function(){
		// 		$(".completar-ubicacion-actual").hide();
		// 		var texto = $(this).text();
		// 		if ($(this).attr("id")=="auto-suggest") texto = $(this).data("text");
		// 		var id = $(this).attr('data-index');
		// 		//console.log(id);
		// 		//console.log(texto);
		// 		$("#ubicacion-actual").val(texto);

		// 		console.log(id);

		// 		if (id=='ua')
		// 		{
		// 			//var dir_actual = "";
		// 			var resultado_q = geocode(get_latactual(), get_longactual(), "ubicacion-actual");
		// 			/*$.when(geocode(get_latactual(), get_longactual())).then(function(result){
		// 				console.log(result);
		// 			});*/
		// 			/*geocode(get_latactual(),get_longactual()).then(function(res){
		// 				console.log(res);
		// 			});*/
		// 			//console.log(resultado_q);
		// 			//if (resultado_q != 'na') $("#ubicacion-actual").val(resultado_q);
		// 		}
		// 	});
		// });

		$(".completar-ubicacion-actual").show();
 	 
	});

	$("input[name=ubicacion-actual-r]").on('click',function() {
		var textoBusqueda = $("#ubicacion-actual").val();		
		$(".completar-ubicacion-actual").show(); 	 
	});

	$("input[name=ubicacion-actual-flota]").on('click',function() {
		var textoBusqueda = $("#ubicacion-actual").val();		
		$(".completar-ubicacion-actual").show(); 	 
	});

	$("input[name=ubicacion-actual-flota-r]").on('click',function() {
		var textoBusqueda = $("#ubicacion-actual").val();		
		$(".completar-ubicacion-actual").show(); 	 
	});

	$("input[name=ubicacion-actual-esp]").on('click',function() {
		var textoBusqueda = $("#ubicacion-actual").val();		
		$(".completar-ubicacion-actual").show(); 	 
	});
});