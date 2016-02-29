<?php $this->load->view('template_header') ?><?php echo form_open_multipart(current_url()); ?>
<h1>Karya Penelitian</h1>
<?php echo $custom_error; ?>
<?php echo form_hidden('id', $result->id) ?>

<p><label for="judul">Judul<span class="required">*</span></label>                                
  <input id="judul" type="text" name="judul" value="<?php echo $result->judul ?>"  />
  <?php echo form_error('judul', '<div>', '</div>'); ?>
</p>

<p><label for="sub">Bentuk Karya<span class="required">*</span></label>                                
  <select id="bentukkarya" name="bentukkarya">
    <option value="">-Pilih-</option>
    <?php
    foreach ($combolevel as $value) {
      if ($value['id'] == $result->bentukkarya) {
        echo "<option selected value='" . $value['id'] . "'>" . $value['nama'] . "</option>";
      } else {
        echo "<option value='" . $value['id'] . "'>" . $value['nama'] . "</option>";
      }
    }
    ?>
  </select>
  <?php echo form_error('sub', '<div>', '</div>'); ?>
</p>

<!--<p><label for="bentukkarya">Bentuk Karya<span class="required">*</span></label>                                
    <input id="bentukkarya" type="text" name="bentukkarya" value="<?php echo $result->bentukkarya ?>"  />
<?php echo form_error('bentukkarya', '<div>', '</div>'); ?>
</p>-->


<p><label for="peneliti">Peneliti<span class="required">*</span></label>                                
  <input id="peneliti" type="text" name="peneliti" value="<?php echo $result->peneliti ?>"  />
  <?php echo form_error('peneliti', '<div>', '</div>'); ?>
</p>


<p><label for="email">Email<span class="required">*</span></label>                                
  <input id="email" type="text" name="email" value="<?php echo $result->email ?>"  />
  <?php echo form_error('email', '<div>', '</div>'); ?>
</p>


<p><label for="tahun">Tahun<span class="required">*</span></label>                                
  <input id="tahun" type="text" name="tahun" value="<?php echo $result->tahun ?>"  />
  <?php echo form_error('tahun', '<div>', '</div>'); ?>
</p>

<p><label for="pdf">Upload Pdf</label>                                
  <input id="pdf" type="file" name="pdf" value="<?php echo $result->pdf ?>"  />
  <?php echo form_error('pdf', '<div>', '</div>'); ?>
</p>

<p><label for="daftarisi">Daftar Isi<span class="required">*</span></label>                                
  <textarea id="daftarisi" name="daftarisi"><?php echo $result->daftarisi ?></textarea>
  <?php echo form_error('daftarisi', '<div>', '</div>'); ?>
</p>





<!--<p><label for="bagian">Bagian<span class="required">*</span></label>                                
    <input id="bagian" type="text" name="bagian" value="<?php echo $result->bagian ?>"  />
<?php echo form_error('bagian', '<div>', '</div>'); ?>
</p>-->

<p>
  <?php echo form_submit('submit', 'Submit'); ?>
</p>

<?php echo form_close(); ?>
<script type="text/javascript">
  tinymce.init({
    selector: "textarea"
  });
</script>