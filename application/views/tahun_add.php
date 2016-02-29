<?php $this->load->view('template_header') ?><?php echo form_open(current_url()); ?>
<?php echo $custom_error; ?>

<p><label for="tahun">Tahun<span class="required">*</span></label>                                
    <input id="tahun" type="text" name="tahun" value="<?php echo set_value('tahun'); ?>"  />
<?php echo form_error('tahun', '<div>', '</div>'); ?>
</p>

<p>
<?php echo form_submit('submit', 'Submit'); ?>
</p>

<?php echo form_close(); ?>
