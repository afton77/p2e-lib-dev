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


<p><label for="sumber">Sumber<span class="required">*</span></label>                                
  <input id="sumber" type="text" name="sumber" value="<?php echo set_value('sumber'); ?>"  />
  <?php echo form_error('sumber', '<div>', '</div>'); ?>
</p>


<p><label for="kategori">Kategori<span class="required">*</span></label>                                
  <!--<input id="kategori" type="text" name="kategori" value="<?php echo set_value('kategori'); ?>"  />-->
  <select id="kategori" type="dropdown" name="kategori" value="<?php echo set_value('kategori'); ?>"  >
    <option value="">-Pilih-</option>
    <?php
    foreach ($combolevel as $value) {
      echo "<option value='" . $value['id'] . "'>" . $value['nama'] . "</option>";
    }
    ?>
  </select>
  <?php echo form_error('kategori', '<div>', '</div>'); ?>
</p>

<p><label for="email">Email<span class="required">*</span></label>                                
  <input id="email" type="text" name="email" value="<?php echo set_value('email'); ?>"  />
  <?php echo form_error('email', '<div>', '</div>'); ?>
</p>

<p><label for="file">Upload File</label>                                
  <input id="file" type="file" name="file" value="<?php echo set_value('file'); ?>"  />
  <?php echo form_error('file', '<div>', '</div>'); ?>
</p>




<p>
  <?php echo form_submit('submit', 'Submit'); ?>
</p>

<?php echo form_close(); ?>
