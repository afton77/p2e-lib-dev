<?php $this->load->view('template_header') ?><?php echo form_open_multipart(current_url()); ?>
<h1>Laporan Penelitian</h1>
<?php echo $custom_error; ?>
<?php echo form_hidden('id', $result->id) ?>

<p><label for="judul">Judul<span class="required">*</span></label>                                
  <input id="judul" name="judul" value="<?php echo $result->judul ?>" /> 
  <?php echo form_error('judul', '<div>', '</div>'); ?>
</p>

<p><label for="penulis">Penulis<span class="required">*</span></label>                                
  <input id="penulis" type="text" name="penulis" value="<?php echo $result->penulis ?>"  />
  <?php echo form_error('penulis', '<div>', '</div>'); ?>
</p>

<p><label for="email">Email<span class="required">*</span></label>                                
  <input id="email" type="text" name="email" value="<?php echo $result->email ?>"  />
  <?php echo form_error('email', '<div>', '</div>'); ?>
</p>


<p><label for="tahun">Tahun<span class="required">*</span></label>                                
  <input id="tahun" type="text" name="tahun" value="<?php echo $result->tahun ?>"  />
  <?php echo form_error('tahun', '<div>', '</div>'); ?>
</p>

<p><label for="sub">Katergori<span class="required">*</span></label>                                
  <select id="sub" name="sub">
    <option value="">-Pilih-</option>
    <?php
    foreach ($combolevel as $value) {
      if ($value['id'] == $result->sub) {
        echo "<option selected value='" . $value['id'] . "'>" . $value['nama'] . "</option>";
      } else {
        echo "<option value='" . $value['id'] . "'>" . $value['nama'] . "</option>";
      }
    }
    ?>
  </select>
  <?php echo form_error('sub', '<div>', '</div>'); ?>
</p>

<p><label for="pdf">File</label>                                
  <input id="pdf" type="file" name="pdf" value="<?php echo $result->pdf ?>"  />
  <?php echo form_error('pdf', '<div>', '</div>'); ?>
</p>

<p><label for="isi">Isi<span class="required">*</span></label>                                
  <textarea id="isi" name="isi"><?php echo $result->isi ?></textarea>
  <?php echo form_error('isi', '<div>', '</div>'); ?>
</p>

<p>
  <?php echo form_submit('submit', 'Submit'); ?>
</p>

<?php echo form_close(); ?>

<script type="text/javascript">
  tinymce.init({
    selector: "textarea"
  });
</script>
