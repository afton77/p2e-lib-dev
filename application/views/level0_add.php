<?php $this->load->view('template_header') ?><?php echo form_open(current_url()); ?>
<?php echo $custom_error; ?>

<p><label for="nama">Nama<span class="required">*</span></label>                                
    <input id="nama" type="text" name="nama" value="<?php echo set_value('nama'); ?>"  />
<?php echo form_error('nama', '<div>', '</div>'); ?>
</p>


<p>
<?php echo form_submit('submit', 'Submit'); ?>
</p>

<?php echo form_close(); ?>
