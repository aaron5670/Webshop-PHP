$(function(){

	$("#drop-box").click(function(){
		$("#upl").click();
	});

	// To prevent Browsers from opening the file when its dragged and dropped on to the page
	$(document).on('drop dragover', function (e) {
        e.preventDefault();
    }); 

	// Add events
	$('input[type=file]').on('change', fileUpload);

	// File uploader function

	function fileUpload(event){  
		$("#drop-box").html("<p>"+event.target.value+" uploading...</p>");
		files = event.target.files;
		var data = new FormData();
		var error = 0;
		for (var i = 0; i < files.length; i++) {
  			var file = files[i];
  			console.log(file.size);
			if(!file.type.match('image.*')) {
		   		$("#drop-box").html("<p> ERROR!! Alleen afbeeldingen!</p>");
		   		error = 1;
		  	}else if(file.size > 1048576){
		  		$("#drop-box").html("<p> Te groot bestand. Selecteer iets kleiners!</p>");
		   		error = 1;
		  	}else{
		  		data.append('image', file, file.name);
		  	}
	 	}
	 	if(!error){
		 	var xhr = new XMLHttpRequest();
		 	xhr.open('POST', 'upload.php', true);
		 	xhr.send(data);
		 	xhr.onload = function () {
				if (xhr.status === 200) {
					$("#drop-box").html("<p> Afbeelding geupload.</p>");
				} else {
					$("#drop-box").html("<p> Error in uploading, probeer opnieuw.</p>");
				}
			};
		}
	}

});