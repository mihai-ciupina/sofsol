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
				<a href="#"><?= $counter . ". " . $question["title"] ?>
					<span data-panel="1" data-question-id="<?= $question["id"] ?>" style="background-color: bisque;">1</span>
					<span data-panel="2" data-question-id="<?= $question["id"] ?>" style="background-color: khaki;">2</span>
				</a>
			</td>
		</tr>
		<?php
		}
	}



} else {
	echo "<tr><td>no data</td></tr>";
}
?>
