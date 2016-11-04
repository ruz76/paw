	$(document).ready(function(){
		
		$("body").append("<div id='mapframe' style='position : fixed; left:0; top:0'><p id='closemap'>Close X</p><div id='mapid' style='width: 600px; height: 400px;'></div></div>" );	
		$("#mapframe").hide();
		setMap("mapid");
		
		$("acronym").click(function(){
			
			var position = $(this).position();
			$("#mapframe").css('top', position.top);
			$("#mapframe").css('left', position.left);

			$("#mapframe").show();	
			
			var lat = $(this).attr("lat");
			var lon = $(this).attr("lon");
			var zoom = $(this).attr("zoom");
			var text = $(this).attr("text");
			
			showPlace(lat, lon, zoom, text);

			
		});

		$("#closemap").click(function(){
			$("#mapframe").hide();	
		});
	});

