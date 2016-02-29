<?php $this->load->view('template_header') ?><?php echo form_open(current_url()); ?>
<?php echo $custom_error; ?>
<?php echo form_hidden('id', $result->id) ?>

<p><label for="nama">Nama<span class="required">*</span></label>                                
    <input id="nama" type="text" name="nama" value="<?php echo $result->nama ?>"  />
<?php echo form_error('nama', '<div>', '</div>'); ?>
</p>


<p><label for="parent">Parent<span class="required">*</span></label>                                
    <select id="parent" name="parent">
    <option value="">-Pilih-</option>
    <?php
    foreach ($combolevel as $value) {
      if ($value['id'] == $result->parent) {
        echo "<option selected value='" . $value['id'] . "'>" . $value['nama'] . "</option>";
      } else {
        echo "<option value='" . $value['id'] . "'>" . $value['nama'] . "</option>";
      }
    }
    ?>
  </select>
<?php echo form_error('parent', '<div>', '</div>'); ?>
</p>

<p>
<?php echo form_submit('submit', 'Submit'); ?>
</p>

<?php echo form_close(); ?>
