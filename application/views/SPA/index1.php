
	<hr />
	<div id="">

	<div id="tabs1" class="tabs-container">

		<ul class="connectedSortable">
	    <li><a href="#search-1">search-1</a><span class="ui-icon ui-icon-close" role="presentation">Remove Tab</span></li>
	  </ul>

	  <div id="search-1" class="tab-container">

			<div class="search-box">
				<div role="search" class="search-line">
					<input autofocus name="full" placeholder="How to get last n items from list" autocomplete="off" required="required" class="sbx-custom full" type="search">
				</div>
				<hr />
				<div role="search" class="search-line">
					<input style="width: 140px" name="domain" placeholder="elixir" autocomplete="off" required="required" class="sbx-custom" type="search">
					<input style="width: 140px" name="version" placeholder="last version" autocomplete="off" required="required" class="sbx-custom" type="search">
					<input style="width: 140px" name="ask-tags" placeholder="question tags" autocomplete="off" required="required" class="sbx-custom" type="search">
					<input style="width: 140px" name="quest-tags" placeholder="answer tags" autocomplete="off" required="required" class="sbx-custom" type="search">
				</div>
			</div>
			<hr />
			<table class="table table-striped">
				<thead>
					<tr class="listViewHeaders">
						<th nowrap="">top</th>
						<th nowrap="">domain</th>
						<th nowrap="">questions</th>
					</tr>
				</thead>
				<tbody class="search_results_SPA">
				</tbody>
			</table>




	  </div>
	</div>

</div>

<script>
$( function() {

	var tabs1 = $( "#tabs1" ).tabs();
	tabs1.find( ".ui-tabs-nav" ).sortable({
		axis: "x, y",
		connectWith: ".connectedSortable",
		stop: function() {
			tabs1.tabs( "refresh" );
		}
	}).droppable({
      drop: function( event, ui) {
				var panelId = $(ui.draggable[0]).attr( "aria-controls" );
				let panel = $( "#" + panelId );
				let p1id = panel.parent().attr("id");

				let newParent = $( event.target.offsetParent );
				let p2id = newParent.attr("id");

				if(p1id !== p2id) {
					panel.attr("style", "display: none");
					panel.attr("aria-hidden", "true");
					panel.detach().appendTo(newParent);

					let tabraw = ui.draggable[0];
					let tab = $( tabraw );

					tabs1.tabs("refresh");

				}
      }
    });



	// Close icon: removing the tab on click
	tabs1.on( "click", "span.ui-icon-close", function() {
		var panelId = $( this ).closest( "li" ).remove().attr( "aria-controls" );
		$( "#" + panelId ).remove();
		tabs1.tabs( "refresh" );
	});

} );
</script>
