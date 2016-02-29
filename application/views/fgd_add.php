<?php $this->load->view('template_header') ?><?php echo form_open_multipart(current_url()); ?>
<?php echo $custom_error; ?>

<p><label for="judul">Judul<span class="required">*</span></label>                                
    <input id="judul" type="text" name="judul" value="<?php echo set_value('judul'); ?>"  />
<?php echo form_error('judul', '<div>', '</div>'); ?>
</p>


<p><label for="tahun">Tahun<span class="required">*</span></label>                                
    <input id="tahun" type="text" name="tahun" value="<?php echo set_value('tahun'); ?>"  />
<?php echo form_error('tahun', '<div>', '</div>'); ?>
</p>


<p><label for="file">File</label>                                
    <input id="file" type="file" name="file" value="<?php echo set_value('file'); ?>"  />
<?php echo form_error('file', '<div>', '</div>'); ?>
</p>


<p>
<?php echo form_submit('submit', 'Submit'); ?>
</p>

<?php echo form_close(); ?>
