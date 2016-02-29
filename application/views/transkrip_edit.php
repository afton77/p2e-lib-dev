<?php $this->load->view('template_header') ?><?php echo form_open_multipart(current_url()); ?>
<?php echo $custom_error; ?>
<?php echo form_hidden('id', $result->id) ?>

<p><label for="judulpenelitian">Judul Penelitian<span class="required">*</span></label>                                
    <input id="judulpenelitian" type="text" name="judulpenelitian" value="<?php echo $result->judulpenelitian ?>"  />
<?php echo form_error('judulpenelitian', '<div>', '</div>'); ?>
</p>


<p><label for="judulwawancara">Judul Wawancara<span class="required">*</span></label>                                
    <input id="judulwawancara" type="text" name="judulwawancara" value="<?php echo $result->judulwawancara ?>"  />
<?php echo form_error('judulwawancara', '<div>', '</div>'); ?>
</p>


<p><label for="tanggal">Tanggal<span class="required">*</span></label>                                
    <input id="tanggal" type="text" name="tanggal" value="<?php echo $result->tanggal ?>"  />
<?php echo form_error('tanggal', '<div>', '</div>'); ?>
</p>


<p><label for="tahun">Tahun<span class="required">*</span></label>                                
    <input id="tahun" type="text" name="tahun" value="<?php echo $result->tahun ?>"  />
<?php echo form_error('tahun', '<div>', '</div>'); ?>
</p>


<p><label for="narasumber">Narasumber<span class="required">*</span></label>                                
    <input id="narasumber" type="text" name="narasumber" value="<?php echo $result->narasumber ?>"  />
<?php echo form_error('narasumber', '<div>', '</div>'); ?>
</p>


<p><label for="file">File</label>                                
    <input id="file" type="file" name="file" value="<?php echo $result->file ?>"  />
<?php echo form_error('file', '<div>', '</div>'); ?>
</p>


<p>
<?php echo form_submit('submit', 'Submit'); ?>
</p>

<?php echo form_close(); ?>
