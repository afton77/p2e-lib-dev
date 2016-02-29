<?php     
/**
 *  al-Faqr RM Allah ;
 *  .... ooooo  ooooooooooo oooooooooooooooooo    ooooooo
 *  ... /  _  \ \_   _____/\__    ___/\_____  \   \      \
 *  .. /  /_\  \ |    __)    |    |    (       )  /   |   \
 *  . /    |    \|     \     |    |   /   ( )   \/    |    \
 *  ..\____|__  /\___  /     |__  |   \_______  /\____|__  /
 *  ..........\/.....\/.........\/............\/.........\/
 * 
 */
// echo form_open(current_url()); ?>

<?php echo form_open(base_url().'/datapenelitian/',array('id'=>'editForm','name'=>'editForm')); ?>
<?php echo $custom_error; ?>

<div class="row">
	<div class="three column">
		<h3>Insert ...</h3>
	</div>
	<div class="three column">
		<?php
		echo anchor(base_url().'datapenelitian/datapenelitian/','Daftar ...',array('class' => 'small button'));
		?>
	</div>
</div>

<?php echo $custom_error; ?>
<?php echo form_hidden('id',$result->id) ?>

	<div class="six column"><label for="judul">Judul<span class="required">*</span></label>                                
		<input id="judul" type="text" name="judul" value="<?php echo $result->judul ?>"  />
		<?php echo form_error('judul','<div>','</div>'); ?>
	</div>


	<div class="six column"><label for="tahun">Tahun<span class="required">*</span></label>                                
		<input id="tahun" type="text" name="tahun" value="<?php echo $result->tahun ?>"  />
		<?php echo form_error('tahun','<div>','</div>'); ?>
	</div>


	<div class="six column"><label for="sumber">Sumber<span class="required">*</span></label>                                
		<input id="sumber" type="text" name="sumber" value="<?php echo $result->sumber ?>"  />
		<?php echo form_error('sumber','<div>','</div>'); ?>
	</div>


	<div class="six column"><label for="kategori">Kategori<span class="required">*</span></label>                                
		<input id="kategori" type="text" name="kategori" value="<?php echo $result->kategori ?>"  />
		<?php echo form_error('kategori','<div>','</div>'); ?>
	</div>


	<div class="six column"><label for="file">File<span class="required">*</span></label>                                
		<input id="file" type="text" name="file" value="<?php echo $result->file ?>"  />
		<?php echo form_error('file','<div>','</div>'); ?>
	</div>


	<div class="six column"><label for="email">Email<span class="required">*</span></label>                                
		<input id="email" type="text" name="email" value="<?php echo $result->email ?>"  />
		<?php echo form_error('email','<div>','</div>'); ?>
	</div>


	<div class="six column"><label for="bagian">Bagian<span class="required">*</span></label>                                
		<input id="bagian" type="text" name="bagian" value="<?php echo $result->bagian ?>"  />
		<?php echo form_error('bagian','<div>','</div>'); ?>
	</div>

<div class="row">
	<div class="six column">
		<?php echo anchor(base_url().'datapenelitian/datapenelitian/','Title...',array('class' => 'small button')); ?>
	</div>
	<div class="two column">
		<?php echo form_submit( 'submit', 'Submit'); ?>
	</div>
</div>

<?php echo form_close(); ?>

<script > 
	// wait for the DOM to be loaded 
	$(document).ready(function() {
		$('#editForm').ajaxForm({
			url: '<?php echo base_url()?>/datapenelitian/datapenelitian/update',			
			type: 'post',
			beforeSubmit: validateForm,
			success: showResponse,
			//target: '#output1',   // target element(s) to be updated with server response 
	        //type: type,			// 'get' or 'post', override for form's 'method' attribute 
	        //dataType: null,		// 'xml', 'script', or 'json' (expected server response type) 
	        //clearForm: true,		// clear all form fields after successful submit 
	        resetForm: true,		// reset the form after successful submit 
	        //timeout: 3000 
		});	
	});
	// pre-submit callback 
	function validateForm(formData, jqForm, options) { 
		if($("#judul").val() == "" || !($("#judul").val())){
                                ($("#judul").addClass("error"));
                                alert("Silahkan isi Judul");
                                return false;
                            }
	if($("#tahun").val() == "" || !($("#tahun").val())){
                                ($("#tahun").addClass("error"));
                                alert("Silahkan isi Tahun");
                                return false;
                            }
	if($("#sumber").val() == "" || !($("#sumber").val())){
                                ($("#sumber").addClass("error"));
                                alert("Silahkan isi Sumber");
                                return false;
                            }
	if($("#kategori").val() == "" || !($("#kategori").val())){
                                ($("#kategori").addClass("error"));
                                alert("Silahkan isi Kategori");
                                return false;
                            }
	if($("#file").val() == "" || !($("#file").val())){
                                ($("#file").addClass("error"));
                                alert("Silahkan isi File");
                                return false;
                            }
	if($("#email").val() == "" || !($("#email").val())){
                                ($("#email").addClass("error"));
                                alert("Silahkan isi Email");
                                return false;
                            }
	if($("#bagian").val() == "" || !($("#bagian").val())){
                                ($("#bagian").addClass("error"));
                                alert("Silahkan isi Bagian");
                                return false;
                            }
	    return true; 
	} 
	 
	// post-submit callback 
	function showResponse(responseText, statusText, xhr, $form)  { 
	    alert(responseText);
	    if(statusText == 'success'){
	    	window.location.href = "<?php echo base_url();?>"+"datapenelitian/datapenelitian/";
	    }else{
		    return false;
	    }
	} 
</script> 