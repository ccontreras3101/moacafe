	var url = String(window.location.pathname);
	var url_1 = String("/moa/");
	var url_2 = String("/moa/index.php")

	if(url === url_1 || url === url_2){
		console.log("");
	}else{
		$('#bg-image-index').css("display","none");
		$('#mapa').css("display","none");

	}
	

