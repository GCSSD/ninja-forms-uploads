<?php

/* *
 * Browse Uploads Sidebar Functions

 */
add_action('init', 'ninja_forms_register_sidebar_select_uploads');

function ninja_forms_register_sidebar_select_uploads(){
	$args = array(
		'name' => 'Find File Uploads',
		'page' => 'ninja-forms-uploads',
		'tab' => 'browse_uploads',
		'display_function' => 'ninja_forms_sidebar_select_uploads',
		'save_function' => 'ninja_forms_save_sidebar_select_uploads',
	);
	if( function_exists( 'ninja_forms_register_sidebar' ) ){
		ninja_forms_register_sidebar('select_uploads', $args);
	}

	if( is_admin() AND isset( $_REQUEST['page'] ) AND $_REQUEST['page'] == 'ninja-forms-uploads' ){
		if( !isset( $_REQUEST['paged'] ) AND !isset( $_REQUEST['form_id'] ) ){
			unset( $_SESSION['ninja_forms_form_id'] );
			unset( $_SESSION['ninja_forms_begin_date'] );
			unset( $_SESSION['ninja_forms_end_date'] );
			unset( $_SESSION['ninja_forms_upload_types'] );
			unset( $_SESSION['ninja_forms_upload_name'] );
			unset( $_SESSION['ninja_forms_upload_user'] );
		}
	}
}

function ninja_forms_sidebar_select_uploads(){
	$form_results = ninja_forms_get_all_forms();

	if(isset($_REQUEST['form_id']) AND !empty($_REQUEST['form_id'])){
		$form_id = $_REQUEST['form_id'];
	}else if(isset($_SESSION['ninja_forms_form_id']) AND !empty($_SESSION['ninja_forms_form_id'])){
		$form_id = $_SESSION['ninja_forms_form_id'];
	}else{
		$form_id = '';
	}

	if(isset($_REQUEST['upload_types']) AND !empty($_REQUEST['upload_types'])){
		$upload_types = $_REQUEST['upload_types'];
	}else if(isset($_SESSION['ninja_forms_upload_types']) AND !empty($_SESSION['ninja_forms_upload_types'])){
		$upload_types = $_SESSION['ninja_forms_upload_types'];
	}else{
		$upload_types = '';
	}

	if(isset($_REQUEST['upload_name']) AND !empty($_REQUEST['upload_name'])){
		$upload_name = $_REQUEST['upload_name'];
	}else if(isset($_SESSION['ninja_forms_upload_name']) AND !empty($_SESSION['ninja_forms_upload_name'])){
		$upload_name = $_SESSION['ninja_forms_upload_name'];
	}else{
		$upload_name = '';
	}	

	if(isset($_REQUEST['upload_user']) AND !empty($_REQUEST['upload_user'])){
		$upload_user = $_REQUEST['upload_user'];
	}else if(isset($_SESSION['ninja_forms_upload_user']) AND !empty($_SESSION['ninja_forms_upload_user'])){
		$upload_user = $_SESSION['ninja_forms_upload_user'];
	}else{
		$upload_user = '';
	}

	if(isset($_REQUEST['begin_date']) AND !empty($_REQUEST['begin_date'])){
		$begin_date = $_REQUEST['begin_date'];
	}else if(isset($_SESSION['ninja_forms_begin_date']) AND !empty($_SESSION['ninja_forms_begin_date'])){
		$begin_date = $_SESSION['ninja_forms_begin_date'];
	}else{
		$begin_date = '';
	}

	if(isset($_REQUEST['end_date']) AND !empty($_REQUEST['end_date'])){
		$end_date = $_REQUEST['end_date'];
	}else if(isset($_SESSION['ninja_forms_end_date']) AND !empty($_SESSION['ninja_forms_end_date'])){
		$end_date = $_SESSION['ninja_forms_end_date'];
	}else{
		$end_date = '';
	}

	?>
		<label><strong><?php _e('Select A Form', 'ninja-forms');?>:</strong></label>
		<p>
			<select name="filter_form_id" id="" class="">
				<option value="all">-- All Forms </option>
			<?php
			if(is_array($form_results)){
				foreach($form_results as $form){
					$data = $form['data'];
					$form_title = $data['form_title'];
					?>
					<option value="<?php echo $form['id'];?>" <?php if($form_id == $form['id']){ echo 'selected';}?>><?php echo $form_title;?></option>
					<?php
				}
			}
			?>
			</select>
		</p>
		<label><strong><?php _e( 'User', 'ninja-forms' ); ?> - <span>(<?php _e( 'Optional', 'ninja-forms' );?>)</span>:</strong></label>
		<p>
			<input type="text" id="" name="upload_user" class="code" value="<?php echo $upload_user; ?>">
			<br />
			<?php _e( 'login, email, user ID', 'ninja-forms-uploads' );?>
		</p>
		<label><strong><?php _e( 'File Name', 'ninja-forms' ); ?> - <span>(<?php _e( 'Optional', 'ninja-forms' );?>)</span>:</strong></label>
		<p>
			<input type="text" id="" name="upload_name" class="code" value="<?php echo $upload_name; ?>">
		</p>		
		<label><strong><?php _e( 'File Type', 'ninja-forms' ); ?> - <span>(<?php _e( 'Optional', 'ninja-forms' ); ?>)</span></strong></label>
		<p>
			<input type="text" id="" name="upload_types" class="code" value="<?php echo $upload_types; ?>">
			<br />
			.jpg,.pdf.docx
		</p>
		<h4><?php _e('Date Range', 'ninja-forms');?> - <span>(<?php _e( 'Optional', 'ninja-forms' ); ?>)</span></h4>
		<p>
			<?php _e('Begin Date', 'ninja-forms');?>: <input type="text" id="" name="begin_date" class="ninja-forms-admin-date" value="<?php echo $begin_date;?>">
			<br />
			mm/dd/yyyy
		</p>
		<p>
			<?php _e('End Date', 'ninja-forms');?>: <input type="text" id="" name="end_date" class="ninja-forms-admin-date" value="<?php echo $end_date;?>">
			<br />
			mm/dd/yyyy
		</p>
		<p class="description">
			<?php //_e('If both Begin Date and End Date are left blank, all file uploads will be displayed.', 'ninja-forms');?>
		</p>
		<p class="description description-wide">
			<input type="submit" name="submit" id="" class="button-primary" value="<?php _e('Filter File Uploads', 'ninja-forms');?>">
		</p>
	</form>
<?php

}

function ninja_forms_save_sidebar_select_uploads(){

}