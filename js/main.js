let funcId = null;

$(document).ready(function(){

	$(document).on("keyup", "[name='full']", function(){
		let search_value = $(this).val().toLowerCase();
		let domain = $("[name='domain']").val().toLowerCase();

		clearTimeout(funcId)

		funcId = setTimeout(function() {
			searchQuestions({"search_value":search_value, "domain":domain}, "get", null)
		}, 2000);

	});

})



my_ajax = function (params, action, field){

	$.ajax({
		type: "GET",
		url: "http://stackoverflow.solutions/index.php/question/" + action + "",
		data : params,
		success: function(data, textStatus, jqXHR ){
			switch(action){
				case "get":
					$("#search_results").html(data);
					break;
			}
		},
		error: function(jqXHR, textStatus, errorThrown){
			console.log(errorThrown);
		}
	});
}

function searchQuestions(params, action, field) {
	my_ajax(params, action, field);
}
