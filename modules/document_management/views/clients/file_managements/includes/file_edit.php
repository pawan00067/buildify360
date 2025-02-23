<?php 
if(isset($item)){
	$redirect_type = '';
	if($share_to_me == 1){
		$redirect_type = 'share_to_me';
	} ?>
	<?php echo form_open_multipart(site_url('document_management/document_management_client/edit_file'),array('id'=>'edit_file_form')); ?>             
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<input type="hidden" name="id" value="<?php echo htmldecode($item->id); ?>">
				<input type="hidden" name="default_parent_id" value="<?php echo htmldecode($parent_id); ?>">
				<input type="hidden" name="redirect_type" value="<?php echo htmldecode($redirect_type); ?>">
				<div class="col-md-12">
					<?php echo render_input('name', 'dmg_name', $item->name); ?>				
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<div id="inputTagsWrapper">
							<label for="tag" class="control-label"><i class="fa fa-tag" aria-hidden="true"></i> <?php echo _l('tags'); ?></label>
							<input type="text" class="tagsinput" id="tag" name="tag" value="<?php echo ($item->tag != null ? htmldecode($item->tag) : ''); ?>" data-role="tagsinput">
						</div>
					</div>

								 

				</div>
				<div class="col-md-12">
					<div class="form-group">
						<div id="inputTagsWrapper">
							<label for="signed_by" class="control-label"><i class="fa fa-tag" aria-hidden="true"></i> <?php echo _l('dmg_signed_by'); ?></label>
							<input type="text" class="tagsinput" id="signed_by" name="signed_by" value="<?php echo ($item->signed_by != null ? htmldecode($item->signed_by) : ''); ?>" data-role="tagsinput">
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<?php echo render_datetime_input('dateadded', 'dmg_date', $item->dateadded); ?>				
				</div>
				<div class="col-sm-6">
					<?php echo render_datetime_input('duedate', 'dmg_due_date', $item->duedate); ?>				
				</div>
				<div class="col-sm-6">
					<div class="form-group" app-field-wrapper="duedate">
						<label for="ocr_language" class="control-label"><?php echo _l('dmg_ocr_language'); ?></label>
						<select id="ocr_language" name="ocr_language" class="selectpicker" data-width="100%" data-none-selected-text="None selected" data-live-search="true" tabindex="-98">
							<option value=""></option>
							<?php foreach($this->app->get_available_languages() as $user_lang) { ?>
								<option value="<?php echo htmldecode($user_lang); ?>" <?php echo ($item->ocr_language == $user_lang ? 'selected' : '') ?> ><?php echo ufirst($user_lang); ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="col-sm-6">
					<?php echo render_input('document_number', 'dmg_document_number', $item->document_number); ?>				
				</div>
				<div class="col-md-12">
					<?php echo render_textarea('note', 'dmg_notes', $item->note); ?>				
				</div>
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-6">
							<?php 
							$data_custom_field_list = $this->document_management_model->get_custom_fields('','','id, title'); ?>

							<div class="form-group">
	                          <label for="all_custom_field"><?php echo _l('dmg_custom_fields'); ?></label><br />
	                          <select class="selectpicker" id="all_custom_field" name="all_custom_field" data-width="100%" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
	                             <?php
	                             	foreach ($data_custom_field_list as $key => $value) { ?>
	                             		<option value="<?php echo html_entity_decode($value['id']); ?>"><?php echo html_entity_decode($value['title']); ?></option>
	                             <?php
	                             	}
	                              ?>
	                          </select>
	                       </div>
						</div>
						<div class="col-md-6 ptop5">
							<button class="btn btn-default pull-left mtop25" id="add_custom_field" type="button"><i class="fa fa-plus mtop5"></i></button>		
						</div>
						<div class="col-md-12 custom_field_fr">
							<?php 
							$data_custom_field = [];
							if(!($item->custom_field == '' || $item->custom_field == null)){
								$data_custom_field = json_decode($item->custom_field); 
							} ?>
							<ul class="selectedFiles list-group list-group-flush mtop10 <?php echo (count($data_custom_field) == 0 ? 'hide' : '') ?>" id="custom_field_list">
								<?php 
								if(count($data_custom_field) > 0){
									$required = 1;
									foreach ($data_custom_field as $key => $customfield) { 
										$html = '';
										switch ($customfield->type) {
											case 'select':
											$data['option'] = $customfield->option;
											$data['title'] = $customfield->title;
											$data['id'] = $customfield->custom_field_id;
											$data['required'] = $required;
											$data['select'] = $customfield->value;
											$html = $this->load->view('includes/controls/select', $data, true);
											break;
											case 'multi_select':
											$data['option'] = $customfield->option;
											$data['title'] = $customfield->title;
											$data['id'] = $customfield->custom_field_id;
											$data['required'] = $required;
											$data['select'] = $customfield->value;
											$html = $this->load->view('includes/controls/multi_select', $data, true);
											break;
											case 'checkbox':
											$data['option'] = $customfield->option;
											$data['title'] = $customfield->title;
											$data['id'] = $customfield->custom_field_id;
											$data['required'] = $required;
											$data['select'] = $customfield->value;
											$html = $this->load->view('includes/controls/checkbox', $data, true);
											break;
											case 'radio_button':
											$data['option'] = $customfield->option;
											$data['title'] = $customfield->title;
											$data['id'] = $customfield->custom_field_id;
											$data['required'] = $required;
											$data['select'] = $customfield->value;
											$html = $this->load->view('includes/controls/radio_button', $data, true);
											break;
											case 'textarea':
											$data['id'] = $customfield->custom_field_id;
											$data['title'] = $customfield->title;
											$data['required'] = $required;
											$data['value'] = $customfield->value;
											$html = $this->load->view('includes/controls/textarea', $data, true);
											break;
											case 'numberfield':
											$data['id'] = $customfield->custom_field_id;
											$data['title'] = $customfield->title;
											$data['required'] = $required;
											$data['value'] = $customfield->value;
											$html = $this->load->view('includes/controls/numberfield', $data, true);
											break;
											case 'textfield':
											$data['id'] = $customfield->custom_field_id;
											$data['title'] = $customfield->title;
											$data['required'] = $required;
											$data['value'] = $customfield->value;
											$html = $this->load->view('includes/controls/textfield', $data, true);
											break;
										}
										$item_class = 'field-item-'.$customfield->custom_field_id;
										$item_html = '<li class="list-group-item list-group-item-action display-flex '.$item_class.'">';
										$item_html .= '<div class="control w100">'.$html.'</div>';
										$item_html .= '<input type="hidden" name="field_id[]" value="'.$customfield->custom_field_id.'">';
										$item_html .= '<button class="btn btn-sm btn-link remove-attachment" onclick="remove_attachment(this,\'customfield\')" type="button">';
										$item_html .= '<i class="fa fa-times"></i>';
										$item_html .= '</button>';
										$item_html .= '</li>';
										echo htmldecode($item_html);
									} 
								} 
								?>
							</ul>
						</div>
					</div>
				</div>

				<div class="col-md-12">
					<div class="row">
						<div class="col-md-6">
							<?php 
							$data_file_list = $this->document_management_model->get_item('', 'filetype != \'folder\' AND parent_id = '.$item->parent_id.' AND id != '.$item->id,'id, name'); 
							 ?>
							<div class="form-group">
	                          <label for="all_file"><?php echo _l('dmg_related_files'); ?></label><br />
	                          <select class="selectpicker" id="all_file" name="all_file" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>" data-width="100%">
	                             <?php
	                             	foreach ($data_file_list as $key => $value) { ?>
	                             		<option value="<?php echo html_entity_decode($value['id']); ?>"><?php echo html_entity_decode($value['name']); ?></option>
	                             <?php
	                             	}
	                              ?>
	                          </select>
	                       </div>
						</div>
						<div class="col-md-6 ptop5">
							<button class="btn btn-default pull-left mtop25" id="add_related_file" type="button"><i class="fa fa-plus mtop5"></i></button>		
						</div>
						<div class="col-md-12 related_file_fr">
							<?php 
							$data_file_selected = [];
							if($item->related_file != ''){
								$data_file_selected = explode(',', $item->related_file); ?>
							<?php } ?>
							<ul class="selectedFiles list-group list-group-flush mtop10 <?php echo (count($data_file_selected) == 0 ? 'hide' : '') ?>" id="related_file_list">
								<?php 
								if(count($data_file_selected) > 0){
									foreach ($data_file_selected as $key => $file_id) { 
										$file_name = dmg_get_file_name($file_id);
										if($file_name != ''){
											?>
											<li class="list-group-item list-group-item-action display-flex">
												<div class="name mtop7 w100"><?php echo htmldecode($file_name); ?></div>
												<input type="hidden" name="related_file[]" value="<?php echo htmldecode($file_id); ?>">
												<button class="btn btn-sm btn-link remove-attachment" onclick="remove_attachment(this,'file')" type="button">
													<i class="fa fa-times"></i>
												</button>
											</li>
											<?php 
										} 
									} 
								} 
								?>
							</ul>
						</div>
					</div>
				</div>

				<div class="col-md-12">
					<hr>
					<button class="btn btn-primary pull-right"><?php echo _l('dmg_save'); ?></button>
				</div>
			</div>
		</div>
	</div>
	<?php echo form_close(); ?>       
<?php } ?>     
