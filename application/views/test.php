<?php
if($result) {



	$tmp = json_decode(json_encode($result), true);
	$result = array_intersect_key($tmp, array_unique(array_column($tmp, 'id')));


	if(isset($result)) {
		$counter = 0;
		foreach($result as $question) {
			$counter++;
		?>
		<tr class="listViewEntries" >
			<td><?= $question["top"] ?></td>
			<td><?= $question["domain"].':' ?></td>
			<td>
				<a href="<?php echo site_url('question/show_question_details/'. $question["id"] .'') ?>"><?= $counter . ". " . $question["title"] ?></a>
			</td>
		</tr>
		<?php
		}
	}



} else {
	echo "<tr><td>no data</td></tr>";
}
?>
