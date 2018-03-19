let funcId = null;
let tabCounter = 3;
let elementToFill = null;

$(document).ready(function(){

	// .triggers
	$(document).on("keyup", "[name='full']", function(event){

		console.log(
			$(this).closest(".tab-container")
		)
		console.log(
			$(this).closest(".tab-container").find(".search_results_SPA")
		)
		elementToFill = $(this).closest(".tab-container").find(".search_results_SPA");

		let search_value = $(this).val().toLowerCase();
		let domain = $("[name='domain']").val().toLowerCase();

		clearTimeout(funcId);

		funcId =	setTimeout(function() {
			my_ajax({"search_value":search_value, "domain":domain}, "sospa/search", null, onSuccess_search);
		}, 2000);

	});

	$(document).on("click", "#SPA_navbar .fa-search", function(){
		my_ajax({}, `search`, {}, onSuccess_getSearchForm);
	});

	$(document).on("click", ".search_results_SPA span", function(){
		let panelPosition = $(this).data("panel");
		let questionId = $(this).data("questionId");

		my_ajax({}, `sospa/show_question_details/${questionId}`, {panelPosition: panelPosition}, onSuccess_getSolution);
	});
	// triggers.

	$(document).on('click', 'a[href="#"]', function(event) {
		event.preventDefault();
	})

})



my_ajax = function (params, action, other, onSuccess){

	$.ajax({
		type: "GET",
		url: "https://stackoverflow.solutions/index.php/SPA/" + action + "",
		data : params,
		success: function(data, textStatus, jqXHR ){
			onSuccess(data, other);
		},
		error: function(jqXHR, textStatus, errorThrown){
			console.log(errorThrown);
		}
	});
}



function onSuccess_search(data, other) {
	// $("#search_results_SPA").html(data);
	elementToFill.html(data);

}

function onSuccess_getSearchForm(data, other) {
	addTab(`#tabs${1}`, "search", data);
}

function onSuccess_getSolution(data, other) {
	let panelPosition = other.panelPosition;
	let label = "sol"

	addTab(`#tabs${panelPosition}`, label, data);
}
function addTab(tabs_, label_, tabContentHtml) {
	let tabs = $(tabs_).tabs();

	let label = `${label_}-${tabCounter}`;
	// var label = tabTitle.val() || "Tab " + tabCounter,
	// id = "tabs-" + tabCounter,
	let id = label;
	let tabTemplate = "<li><a href='#{href}'>#{label}</a> <span class='ui-icon ui-icon-close' role='presentation'>Remove Tab</span></li>";
	let li = $( tabTemplate.replace( /#\{href\}/g, "#" + id ).replace( /#\{label\}/g, label ) );
	// tabContentHtml = tabContent.val() || "Tab " + tabCounter + " content.";

	tabs.find( ".ui-tabs-nav" ).append( li );
	tabs.append( "<div id='" + id + "' class='tab-container'> " + tabContentHtml + "</div>" );
	tabs.tabs( "refresh" );
	tabCounter++;
}
