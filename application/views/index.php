<h4>List of most used developer requests for quick development</h4>

<br />
<table class="table table-striped" id="urls_table">
	<thead>
		<tr class="listViewHeaders">
			<th nowrap >Title&nbsp;</th>
		</tr>
	</thead>
	<?php
	if(isset($result)) {
		$counter = 0;
		foreach($result as $question) {
			$counter++;
		?>
		<tr class="listViewEntries" >
			<td class="listViewEntryValue medium" data-field-type="string" nowrap>

			<a href="<?php echo site_url('question/show_question_details/'. $question->id .'') ?>"><?= $counter . ". " . $question->title . " : " . $question->private ?></a>

			</td>
		</tr>
		<?php
		}
	}
	?>
</table>







<br />
