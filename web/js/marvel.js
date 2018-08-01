//Archivo para la conexión con la API oficial de Marvel

var marvel ={
	render:function(){
		//URL para la conexión, la cual esta compuesta por una Public Key + una Private Key encryptadas en MD5, las cuales son proporcionadas por la web de marvel
		var url = "http://gateway.marvel.com/v1/public/characters?ts=1&apikey=169bb5a37651fba80a1a75e9369d2f47&hash=412ee36d270234157ae3f06bda643e55";
		//Variable message, con el objetivo de obtener el mensaje del status de la conexión
		var message = document.getElementById("message");
		//Variable footer, con el objetivo de obtener el mensaje de CopyRight de Marvel para ser mostrado en el footer
		var footer = document.getElementById("footer");
		var marvelContainer = document.getElementById("marvel-container");

		$.ajax({
			url: url,
			type: "GET",
			//Mientras carga mostrar el mensaje : "Cargando contenido..."
			beforeSend: function (){
				message.innerHTML= "Cargando contenido...";
			},
			//Una vez halla cargado mostrar el mensaje...
			complete: function (){
				message.innerHTML= "Cargado satisfactoriamente";
			},
			
			success: function(data){
				//Obteniendo el mensaje de Copyright de Marvel
				footer.innerHTML = data.attributionHTML;
				var string = "";
				string +="<div class='row'>";

				for (var i = 0; i < data.data.results.length; i++) {
					var element = data.data.results[i];

					string +="<div class='col-md-3'>";
					string +=" <a href='"+ element.urls[0].url+"'target='_blank'>";
					string +=" <img src='"+ element.thumbnail.path +"/portrait_fantastic."+ element.thumbnail.extension+"'/>";
					string +="</a>";
					string +="<h5>" + element.name + "</h5>";
					string +="</div>";

					if ((i+1) % 4 == 0) {
						string +="</div>";
						string +="<div class='row'>";
					}
				}

				marvelContainer.innerHTML = string;
			},
			//Si no su pudo conectar mostrar el mensaje...
			error: function(){
				message.innerHTML= "Lo sentimos, hubo un error.";
			}
		});
	}
};

marvel.render();