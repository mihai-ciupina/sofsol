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


					<?php echo form_open_multipart('question/question_update', array('class' => '', 'enctype' => 'multipart/form-data'));?>

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
									<?php echo form_label('<span class="redColor">*</span> Domain ', 'domain', array('class' => 'muted pull-right marginRight10px'));?>
								</td>
								<td class="" >
										<span class="">
											<?php echo form_input(array('name' => 'domain', 'value' => set_value('domain', (isset($result) ? $result[0]->domain : '')), 'id' => 'domain', 'class' => '', 'size' => '15')) ?>
										</span>
										<span class="">
											Private:
											<input type="checkbox" name="private" value="1" <?php echo (($result[0]->private === '1') ? 'checked="checked"' : '') ?> />
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
									<?php echo form_label('Desc', 'desc', array('class' => ''));?>
								</td>
								<td class="" >
									<div class="row-fluid">
										<span class="">
											<?php //echo form_textarea(array('name' => 'desc', 'value' => set_value('desc', (isset($result) ? $result[0]->desc : '')), 'id' => 'desc', 'class' => '', 'rows' => 10, 'cols' => 100)) ?>
											<textarea name="desc" id="desc" rows="10" cols="100"><?php echo (isset($result) ? $result[0]->desc : "") ?></textarea>

										</span>
									</div>
								</td>
							</tr>
							<tr>
								<td class="">
									<?php echo form_label('Code', 'code', array('class' => ''));?>
								</td>
								<td class="" >
									<div class="row-fluid">
										<span class="">
											<?php //echo form_textarea(array('name' => 'codeold', 'value' => set_value('code', (isset($result) ? $result[0]->code : "")), 'id' => 'codeold', 'class' => '', 'rows' => 10, 'cols' => 100)) ?>
											<textarea name="code" id="code" rows="10" cols="100"><?php echo (isset($result) ? $result[0]->code : "") ?></textarea>
											</div>
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

				<?php if(isset($result)){echo form_hidden('question_id', $result[0]->id);}?>
				<?php if(isset($question_id)){echo form_hidden('question_id', $question_id);}?>

				<?php echo form_close();?>

</div>
