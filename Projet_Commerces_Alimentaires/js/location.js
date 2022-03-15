	function maPosition(position) {
		var infopos = "Position déterminée :\n";
		infopos += "Latitude : "+position.coords.latitude +"\n";
		infopos += "Longitude: "+position.coords.longitude+"\n";
		infopos += "Altitude : "+position.coords.altitude +"\n";
		$(".lat").val(position.coords.latitude);
		$(".lng").val(position.coords.longitude);
	}
	
	// Fonction de callback en cas d’erreur
	function erreurPosition(error) {
		var info = "Erreur lors de la géolocalisation : ";
		switch(error.code) {
		case error.TIMEOUT:
			info += "Timeout !";
		break;
		case error.PERMISSION_DENIED:
		info += "Vous n’avez pas donné la permission";
		break;
		case error.POSITION_UNAVAILABLE:
			info += "La position n’a pu être déterminée";
		break;
		case error.UNKNOWN_ERROR:
			info += "Erreur inconnue";
		break;
		}		
		document.getElementById("infoposition").innerHTML = info;	
	}