<?php $this->load->view('template_header') ?>
<?php echo form_open(current_url()); ?>
<?php echo $custom_error; ?>

<p><label for="nama">Nama<span class="required">*</span></label>                                
    <input id="nama" type="text" name="nama" value="<?php echo set_value('nama'); ?>"  />
    <?php echo form_error('nama', '<div>', '</div>'); ?>
</p>

<p><label for="email">Email<span class="required">*</span></label>                                
    <input id="email" type="text" name="email" value="<?php echo set_value('email'); ?>"  />
    <?php echo form_error('email', '<div>', '</div>'); ?>
</p>

<p><label for="instansi">Instansi<span class="required">*</span></label>                                
    <input id="instansi" type="text" name="instansi" value="<?php echo set_value('instansi'); ?>"  />
    <?php echo form_error('instansi', '<div>', '</div>'); ?>
</p>

<input id="module_id" type="hidden" name="module_id" value="<?php echo $this->uri->segment(4); ?>"  />
<input id="module" type="hidden" name="module" value="<?php echo $this->uri->segment(3); ?>"  />


<p><label for="keterangan">Keterangan<span class="required">*</span></label>                                
    <textarea id="keterangan" type="text" name="keterangan" value="<?php echo set_value('keterangan'); ?>" ></textarea>
    <?php echo form_error('keterangan', '<div>', '</div>'); ?>
</p>

<p>
    <?php echo form_submit('submit', 'Submit'); ?>
</p>

<?php echo form_close(); ?>

<?php $this->load->view('template_menu'); ?>
<?php $this->load->view('template_footer') ?>
