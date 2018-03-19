
	<hr />
	<div id="">

	<div id="tabs1">
	  <ul class="connectedSortable">
	    <li><a href="#tabs-11">#tabs-11</a><span class="ui-icon ui-icon-close" role="presentation">Remove Tab</span></li>
	    <li><a href="#tabs-12">#tabs-12</a><span class="ui-icon ui-icon-close" role="presentation">Remove Tab</span></li>
	    <li><a href="#tabs-13">#tabs-13</a><span class="ui-icon ui-icon-close" role="presentation">Remove Tab</span></li>
	  </ul>
	  <div id="tabs-11">

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
	  </div>
	  <div id="tabs-12">
			<p>tabs 12</p>
	  </div>
	  <div id="tabs-13">
			<p>tabs 13</p>
	  </div>
	</div>

	<div id="tabs2">
	  <ul class="connectedSortable">
	    <li><a href="#tabs-21">#tabs-21</a><span class="ui-icon ui-icon-close" role="presentation">Remove Tab</span></li>
	    <li><a href="#tabs-22">#tabs-22</a><span class="ui-icon ui-icon-close" role="presentation">Remove Tab</span></li>
	    <li><a href="#tabs-23">#tabs-23</a><span class="ui-icon ui-icon-close" role="presentation">Remove Tab</span></li>
	  </ul>
	  <div id="tabs-21">
			<p>tabs 21</p>
	  </div>
	  <div id="tabs-22">
			<p>tabs 22</p>
	  </div>
	  <div id="tabs-23">
			<p>tabs 23</p>
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

					tabs1.tabs( "refresh" );
				}
      }
    });

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
	tabs1.on( "click", "span.ui-icon-close", function() {
		var panelId = $( this ).closest( "li" ).remove().attr( "aria-controls" );
		$( "#" + panelId ).remove();
		tabs1.tabs( "refresh" );
	});
	tabs2.on( "click", "span.ui-icon-close", function() {
		var panelId = $( this ).closest( "li" ).remove().attr( "aria-controls" );
		$( "#" + panelId ).remove();
		tabs2.tabs( "refresh" );
	});

} );
</script>
