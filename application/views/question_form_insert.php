<?php
	//var_dump($category_page);
?>
<div class="bodyContents">
	<?php
			echo "<div class='error_msg'>";
			echo validation_errors();
			echo "</div>";
			echo "<div class='error_msg'>";
			if(isset($message_display)) {
				echo $message_display;
			}
			echo "</div>";
		?>


					<?php echo form_open_multipart('question/question_insert', array('class' => '', 'enctype' => 'multipart/form-data'));?>

					<div class="row-fluid">
						<div class="pull-right">
							<?php echo form_submit('submit', 'Save', "class = 'btn btn-success'")?>
							<a class="cancelLink" type="reset" onclick="javascript:window.history.back();">Cancel</a>
						</div>
						<div class="clearfix"></div>
					</div>

					<table class="table">
						<thead>
							<tr>
								<th class="" colspan="2">question details</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="">
									<?php echo form_label('Domain ', 'domain', array('class' => ''));?>

								</td>
								<td class="" >
										<span class="">
											<?php echo form_input(array('name' => 'domain', 'value' => set_value('domain', (isset($result) ? $result[0]->domain : '')), 'id' => 'domain', 'class' => '', 'size' => '15')) ?>
										</span>
										<span class="">
											Private:
											<input type="checkbox" name="private" value="1" />
										</span>

								</td>
							</tr>
							<tr>
								<td class="">
									<?php echo form_label('<span class="redColor">*</span> Question ', 'title', array('class' => 'muted pull-right marginRight10px'));?>
								</td>
								<td class="" >
										<span class="">
											<?php echo form_input(array('name' => 'title', 'value' => set_value('title', (isset($result) ? $result[0]->title : '')), 'id' => 'title', 'class' => '', 'size' => '100')) ?>
										</span>
								</td>
							</tr>
							<tr>
								<td class="">
									<?php echo form_label('Tags ', 'tags', array('class' => ''));?>
								</td>
								<td class="" >
										<span class="">
											<?php echo form_input(array('name' => 'tags', 'value' => set_value('tags', (isset($result) ? $result[0]->tags : '')), 'id' => 'tags', 'class' => '', 'size' => '70')) ?>
										</span>
										<span class="">
											<?php echo form_input(array('name' => 'solution_tags', 'value' => set_value('solution_tags', (isset($result) ? $result[0]->solution_tags : '')), 'id' => 'solution_tags', 'class' => '', 'size' => '23', 'placeholder' => 'solution tags')) ?>
										</span>
								</td>
							</tr>
						</tbody>
					</table>

					<br />
					<table class="table">
						<thead>
							<tr>
								<th class="" colspan="2">solution details</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="">
								</td>
								<td class="" >
									<?php echo form_label('Metadata', 'desc', array('class' => ''));?>
									<div class="row-fluid">
										<span class="">
											<?php echo form_textarea(array('name' => 'desc', 'value' => set_value('desc', (isset($result) ? $result[0]->desc : "phoenix v1.3.x\nelixir v1.5.x")), 'id' => 'desc', 'class' => '', 'rows' => 10, 'cols' => 100)) ?>
										</span>
									</div>
								</td>
							</tr>
							<tr>
								<td class="">
								</td>
								<td class="" >
									<?php echo form_label('Code', 'code', array('class' => ''));?>
									<div class="row-fluid">
										<span class="">
											<?php echo form_textarea(array('name' => 'code', 'value' => set_value('code', (isset($result) ? $result[0]->code : '')), 'id' => 'code', 'class' => '', 'rows' => 10, 'cols' => 100)) ?>
										</span>
									</div>
								</td>
							</tr>
						</tbody>
					</table>


					<br />
					<div class="row-fluid">
						<div class="pull-right">
							<?php echo form_submit('submit', 'Save', "class = 'btn btn-success'")?>
							<a class="cancelLink" type="reset" onclick="javascript:window.history.back();">Cancel</a>
						</div>
						<div class="clearfix"></div>
					</div>
					<br />
				<?php echo form_close();?>

</div>
