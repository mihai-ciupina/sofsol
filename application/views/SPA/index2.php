
	<hr />
	<div id="">

	<div id="tabs2">

	  <ul class="connectedSortable">
	    <li><a href="#notes-1">notes-1</a><span class="ui-icon ui-icon-close" role="presentation">Remove Tab</span></li>
	  </ul>

	  <div id="notes-1">
			<div class="form-group">
				<label for="notes">Notes:</label>
				<textarea class="form-control" rows="15" id="notes"></textarea>
			</div>
	  </div>

	</div>



</div>

<script>
$( function() {

	var tabs2 = $( "#tabs2" ).tabs();
	tabs2.find( ".ui-tabs-nav" ).sortable({
		axis: "x, y",
		connectWith: ".connectedSortable",
		stop: function() {
			tabs2.tabs( "refresh" );
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

					tabs2.tabs( "refresh" );
				}
      }
    });

	// Close icon: removing the tab on click
	tabs2.on( "click", "span.ui-icon-close", function() {
		var panelId = $( this ).closest( "li" ).remove().attr( "aria-controls" );
		$( "#" + panelId ).remove();
		tabs2.tabs( "refresh" );
	});

} );
</script>
