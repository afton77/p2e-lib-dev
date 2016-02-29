<?php $this->load->view('template_header') ?><?php echo form_open(current_url()); ?>
<div class="container">
  <div class="row">
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


    <p><label for="password">Password<span class="required">*</span></label>                                
      <input id="password" type="password" name="password" value="<?php echo $result->password ?>"  />
      <?php echo form_error('password', '<div>', '</div>'); ?>
    </p>


    <p><label for="level">Level<span class="required">*</span></label>                                
      <select id="level" name="level">
        <option value="">-Pilih-</option>
        <?php
        foreach ($combolevel as $value) {
          if ($value['id'] == $result->level) {
            echo "<option selected value='" . $value['id'] . "'>" . $value['nama'] . "</option>";
          } else {
            echo "<option value='" . $value['id'] . "'>" . $value['nama'] . "</option>";
          }
        }
        ?>
      </select>
      <?php echo form_error('level', '<div>', '</div>'); ?>
    </p>

    <p>
      <?php echo form_submit('submit', 'Submit'); ?>
    </p>

    <?php echo form_close(); ?>

  </div>
</div>