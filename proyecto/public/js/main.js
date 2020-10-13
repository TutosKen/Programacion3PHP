function mostrar(){
	var x = document.getElementById("servers");

	if (x.style.display != "block") {
		x.style.display = "block";
	}else{
		x.style.display = "none";
	}
}

function trailer(){
	var myIframe = document.getElementById("iframePelicula");
	var trailer = document.getElementById("trailer").value;
	myIframe.contentWindow.location.replace(trailer);
}

function server2(){
	var myIframe = document.getElementById("iframePelicula");
	var server2 = document.getElementById("servidor2").value;
	myIframe.contentWindow.location.replace(server2);
}

function server3(){
	var myIframe = document.getElementById("iframePelicula");
	var server3 = document.getElementById("servidor3").value;
	myIframe.contentWindow.location.replace(server3);
}

function server1(){
	var myIframe = document.getElementById("iframePelicula");
	var server3 = document.getElementById("servidor1").value;
	myIframe.contentWindow.location.replace(server3);
}