<?php $this->load->view('template_header') ?>
<?php
echo anchor(base_url() . 'level1/add/', 'Add');
if (!$results) {
    echo '<h1>No Data</h1>';
    exit;
}
$header = array_keys($results[0]);

for ($i = 0; $i < count($results); $i++) {
    $id = array_values($results[$i]);
    $results[$i]['Edit'] = anchor(base_url() . 'level1/edit/' . $id[0], 'Edit');
    $results[$i]['Delete'] = anchor(base_url() . 'level1/delete/' . $id[0], 'Delete', array('onClick' => 'return deletechecked(\' ' . base_url() . 'level1/delete/' . $id[0] . ' \')'));
    array_shift($results[$i]);
}

$clean_header = clean_header($header);
array_shift($clean_header);
$this->table->set_heading($clean_header);

// view
$tmpl = array ( 'table_open'  => '<table  class="table table-striped">' );$this->table->set_template($tmpl);echo $this->table->generate($results);
echo $this->pagination->create_links(); $this->load->view('template_menu'); $this->load->view('template_footer')
?>
<script type="text/javascript">
    function deletechecked(link)
    {
        var answer = confirm('Delete item?')
        if (answer) {
            window.location = link;
        }

        return false;
    }

</script>