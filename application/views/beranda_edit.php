<?php $this->load->view('template_header') ?><?php echo form_open(current_url()); ?>
<?php echo $custom_error; ?>
<?php echo form_hidden('id', $result->id) ?>

<p><label for="halaman">Halaman<span class="required">*</span></label>                                
    <input id="halaman" type="text" name="halaman" value="<?php echo $result->halaman ?>"  />
    <?php echo form_error('halaman', '<div>', '</div>'); ?>
</p>


<p><label for="content">Content<span class="required">*</span></label>                                
    <textarea id="content" name="content"><?php echo $result->content ?></textarea>
    <?php echo form_error('content', '<div>', '</div>'); ?>
</p>

<p>
    <?php echo form_submit('submit', 'Submit'); ?>
</p>

<?php echo form_close(); ?>
<?php
$this->load->view('template_menu');
$this->load->view('template_footer');

