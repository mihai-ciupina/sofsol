	<?php
		echo "<div class='error_msg'>";
		if(isset($message_display)) {
			echo $message_display;
		}
		echo "</div>";
	?>

	<!-- <br /> -->
	<div class="btn-group btn-group-top">
		<?php if($result[0]->runcodeurl) { ?>
			<a class="btn btn-default btn-xs" href="http://elixirplayground.com?gist=f92768359d5b374bd800dde7fe591528" target="_blank"><i class="fa fa-terminal" aria-hidden="true"></i></a>
			<a class="btn btn-default btn-xs" href="http://elixirplayground.com?gist=119cf64af278a5fcf8536772a8346977" target="_blank"><i class="fa fa-jsfiddle" aria-hidden="true"></i></a>
		<?php } else { ?>
			<a class="btn btn-default btn-xs" href="http://elixirplayground.com?gist=f92768359d5b374bd800dde7fe591528" target="_blank"><i class="fa fa-terminal" aria-hidden="true"></i></a>
		<?php }	?>

		<button class="btn btn-default btn-xs" id="detailView_basicAction_EDIT" onclick="window.location.href='<?php echo site_url('question/show_question_form/' . $result[0]->id)?>'">
			<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
		</button>

	</div>

	<br />
	<h4><?=htmlspecialchars($composed_title)?></h4>
	<b>Domain: </b><?=htmlspecialchars($result[0]->domain)?>
	<br />
	<b>Tags: </b><?=htmlspecialchars($result[0]->tags)?>

	<?php if($is_admin) { ?>
		<hr />
		<div><?=$this->markdown->parse(htmlspecialchars($result[0]->desc))?></div>
	<?php } ?>


	<hr />
	<div><?=$this->markdown->parse($result[0]->code)?></div>

	<br />
	<br />

	<?php if($result[0]->youtube) {
		echo $result[0]->youtube;
	 } ?>

		<!-- <br />
		<br />
		<div class="reward">

			<a href="https://paypal.me/CiupinaMihai" target="_blank">
				<input style="height: 50px" type="image" src="https://cdn1.iconfinder.com/data/icons/banking/512/E1-128.png" border="0" name="submit" alt="PayPal – The safer, easier way to pay online!">
			</a>
		</div> -->

	<?php
		if($result[0]->private === "1") {
			echo "<hr />";
			echo "<br />";
			echo "<b style='color: red'>Private record</b>";
		}
	?>

	<!-- <hr />
	<div class="btn-group">
		<button type="button" class="btn btn-default btn-sm"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></button>
		<button type="button" class="btn btn-default btn-sm"><i class="fa fa-thumb-tack" aria-hidden="true"></i></button>
		<button type="button" class="btn btn-default btn-sm"><i class="fa fa-files-o" aria-hidden="true"></i></button>
		<button type="button" class="btn btn-default btn-sm"><i class="fa fa-jsfiddle" aria-hidden="true"></i></button>
		<button type="button" class="btn btn-default btn-sm"><i class="fa fa-list-ul" aria-hidden="true"></i></button>
		<button type="button" class="btn btn-default btn-sm"><i class="fa fa-book" aria-hidden="true"></i></button>
		<button type="button" class="btn btn-default btn-sm"><i class="fa fa-stack-overflow" aria-hidden="true"></i></button>
		<button type="button" class="btn btn-default btn-sm"><i class="fa fa-stack-overflow" aria-hidden="true"></i></button>
		<button type="button" class="btn btn-default btn-sm"><i class="fa fa-stack-overflow" aria-hidden="true"></i></button>
		<button type="button" class="btn btn-default btn-sm"><i class="fa fa-comments" aria-hidden="true"></i></button>
		<button type="button" class="btn btn-default btn-sm"><i class="fa fa-university" aria-hidden="true"></i></button>
		<button type="button" class="btn btn-default btn-sm"><i class="fa fa-graduation-cap" aria-hidden="true"></i></button>
		<button type="button" class="btn btn-default btn-sm"><i class="fa fa-terminal" aria-hidden="true"></i></button>
		<button type="button" class="btn btn-default btn-sm"><i class="fa fa-tags" aria-hidden="true"></i></button>
		<button type="button" class="btn btn-default btn-sm"><i class="fa fa-picture-o" aria-hidden="true"></i></button>
		<button type="button" class="btn btn-default btn-sm"><i class="fa fa-code" aria-hidden="true"></i></button>
		<button type="button" class="btn btn-default btn-sm"><i class="fa fa-file-code-o" aria-hidden="true"></i></button>
		<button type="button" class="btn btn-default btn-sm"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>
		<button type="button" class="btn btn-default btn-sm"><i class="fa fa-facebook-official" aria-hidden="true"></i></button>
		<button type="button" class="btn btn-default btn-sm"><i class="fa fa-github" aria-hidden="true"></i></button>
		<button type="button" class="btn btn-default btn-sm"><i class="fa fa-youtube-play" aria-hidden="true"></i></button>
		<button type="button" class="btn btn-default btn-sm"><i class="fa fa-twitter" aria-hidden="true"></i></button>
		<button type="button" class="btn btn-default btn-sm"><i class="fa fa-share-alt" aria-hidden="true"></i></button>
		<button type="button" class="btn btn-default btn-sm"><i class="fa fa-quora" aria-hidden="true"></i></button>
	</div> -->
