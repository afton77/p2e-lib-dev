<?php $this->load->view('template_header') ?><?php echo form_open(current_url()); ?>
<?php echo $custom_error; ?>

<p><label for="nama_level">Nama_level<span class="required">*</span></label>                                
    <input id="nama_level" type="text" name="nama_level" value="<?php echo set_value('nama_level'); ?>"  />
<?php echo form_error('nama_level', '<div>', '</div>'); ?>
</p>

<p>
<?php echo form_submit('submit', 'Submit'); ?>
</p>

<?php echo form_close(); ?>
