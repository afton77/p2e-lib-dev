<?php $this->load->view('template_header') ?><?php echo form_open(current_url()); ?>
<?php echo $custom_error; ?>
<?php echo form_hidden('id', $result->id) ?>

<p><label for="nama">Nama<span class="required">*</span></label>                                
    <input id="nama" type="text" name="nama" value="<?php echo $result->nama ?>"  />
    <?php echo form_error('nama', '<div>', '</div>'); ?>
</p>

<p>
    <?php echo form_submit('submit', 'Submit'); ?>
</p>

<?php echo form_close(); ?>
<?php
$this->load->view('template_menu');
$this->load->view('template_footer');
