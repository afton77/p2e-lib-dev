<?php $this->load->view('template_header') ?><?php echo form_open_multipart(current_url()); ?>
<?php echo $custom_error; ?>
<?php echo form_hidden('id', $result->id) ?>

<p><label for="judul">Judul<span class="required">*</span></label>                                
    <input id="judul" type="text" name="judul" value="<?php echo $result->judul ?>"  />
<?php echo form_error('judul', '<div>', '</div>'); ?>
</p>


<p><label for="tanggal">Tanggal<span class="required">*</span></label>                                
    <input id="tanggal" type="text" name="tanggal" value="<?php echo $result->tanggal ?>"  />
<?php echo form_error('tanggal', '<div>', '</div>'); ?>
</p>


<p><label for="bulan">Bulan<span class="required">*</span></label>                                
    <input id="bulan" type="text" name="bulan" value="<?php echo $result->bulan ?>"  />
<?php echo form_error('bulan', '<div>', '</div>'); ?>
</p>


<p><label for="tahun">Tahun<span class="required">*</span></label>                                
    <input id="tahun" type="text" name="tahun" value="<?php echo $result->tahun ?>"  />
<?php echo form_error('tahun', '<div>', '</div>'); ?>
</p>


<p><label for="sumber">Sumber<span class="required">*</span></label>                                
    <input id="sumber" type="text" name="sumber" value="<?php echo $result->sumber ?>"  />
<?php echo form_error('sumber', '<div>', '</div>'); ?>
</p>


<p><label for="kategori">Kategori<span class="required">*</span></label>                                
    <input id="kategori" type="text" name="kategori" value="<?php echo $result->kategori ?>"  />
<?php echo form_error('kategori', '<div>', '</div>'); ?>
</p>


<p><label for="file">File</label>                                
    <input id="file" type="file" name="file" value="<?php echo $result->file ?>"  />
<?php echo form_error('file', '<div>', '</div>'); ?>
</p>


<p><label for="email">Email<span class="required">*</span></label>                                
    <input id="email" type="text" name="email" value="<?php echo $result->email ?>"  />
<?php echo form_error('email', '<div>', '</div>'); ?>
</p>


<p><label for="bagian">Bagian<span class="required">*</span></label>                                
    <input id="bagian" type="text" name="bagian" value="<?php echo $result->bagian ?>"  />
<?php echo form_error('bagian', '<div>', '</div>'); ?>
</p>

<p>
<?php echo form_submit('submit', 'Submit'); ?>
</p>

<?php echo form_close(); ?>
