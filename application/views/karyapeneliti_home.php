<?php $this->load->view('template_header') ?>
<h3>Karya Penelitian</h3>
<?php
// echo anchor(base_url() . 'karyapeneliti/add/', 'Add');
if (!$results) {
    echo '<h3>No Data</h3>';
    exit;
}
$header = array_keys($results[0]);

for ($i = 0; $i < count($results); $i++) {
    $id = array_values($results[$i]);
    // echo $i.' - '.$id[6] = "link";
    // var_dump(array_values($results[$i]));
    // $results[$i]['Edit'] = anchor(base_url() . 'karyapeneliti/edit/' . $id[0], 'Edit');
    // $results[$i]['Delete'] = anchor(base_url() . 'karyapeneliti/delete/' . $id[0], 'Delete', array('onClick' => 'return deletechecked(\' ' . base_url() . 'karyapeneliti/delete/' . $id[0] . ' \')'));
    $results[$i]['pdf'] = anchor(base_url() . 'formrequest/request/karyapeneliti/' . $results[$i]['id'], 'request'); // 'asset/images/download_icon.png';
    array_shift($results[$i]);
}

$clean_header = clean_header($header);
array_shift($clean_header);
$this->table->set_heading($clean_header);

// view
$tmpl = array('table_open' => '<table  class="table table-striped">');
$this->table->set_template($tmpl);
echo $this->table->generate($results);
echo $this->pagination->create_links();
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

<?php $this->load->view('template_menu'); ?>
<?php $this->load->view('template_footer') ?>