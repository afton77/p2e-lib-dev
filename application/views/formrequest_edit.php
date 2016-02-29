<?php $this->load->view('template_header') ?>
<?php echo form_open(current_url()); ?>
<?php echo $custom_error; ?>
<?php echo form_hidden('id', $result->id) ?>

<p><label for="nama">Nama<span class="required">*</span></label>                                
    <input id="nama" type="text" name="nama" value="<?php echo $result->nama ?>"  />
<?php echo form_error('nama', '<div>', '</div>'); ?>
</p>


<p><label for="email">Email<span class="required">*</span></label>                                
    <input id="email" type="text" name="email" value="<?php echo $result->email ?>"  />
<?php echo form_error('email', '<div>', '</div>'); ?>
</p>


<p><label for="instansi">Instansi<span class="required">*</span></label>                                
    <input id="instansi" type="text" name="instansi" value="<?php echo $result->instansi ?>"  />
<?php echo form_error('instansi', '<div>', '</div>'); ?>
</p>


<p><label for="keterangan">Keterangan<span class="required">*</span></label>                                
    <textarea id="keterangan" type="text" name="keterangan" value="<?php echo $result->keterangan ?>" > </textarea>
<?php echo form_error('keterangan', '<div>', '</div>'); ?>
</p>

<p>
<?php echo form_submit('submit', 'Submit'); ?>
</p>

<?php echo form_close(); ?>
