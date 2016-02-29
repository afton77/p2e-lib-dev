<?php
/**
 * al-Faqr RM Allah ;
 * .... ooooo  ooooooooooo oooooooooooooooooo    ooooooo
 * ... /  _  \ \_   _____/\__    ___/\_____  \   \      \
 * .. /  /_\  \ |    __)    |    |    (       )  /   |   \
 * . /    |    \|     \     |    |   /   ( )   \/    |    \
 * ..\____|__  /\___  /     |__  |   \_______  /\____|__  /
 * ..........\/.....\/.........\/............\/.........\/
 * Desc : List
 * 
 */
echo "<div class='row'>";
echo "<div class='six column'>";
echo anchor(base_url() . 'datapenelitian/datapenelitian/add/', 'Add', array('class' => 'small button'));
echo "</div></div>";
if (!$results) {
    echo '<div class="row"><h1>No Data</h1></div>';
    exit;
}
echo '<br />';

$header = array_keys($results[0]);

for ($i = 0; $i < count($results); $i++) {
    $id = array_values($results[$i]);
    $results[$i]['Edit'] = anchor(base_url() . 'datapenelitian/datapenelitian/edit/' . $id[0], 'Edit');
    $results[$i]['Delete'] = anchor(base_url() . 'datapenelitian/datapenelitian/delete/' . $id[0], 'Delete', array('onClick' => 'return deletechecked(\' ' . base_url() . 'datapenelitian/datapenelitian/delete/' . $id[0] . ' \')'));
    array_shift($results[$i]);
}

$clean_header = clean_header($header);
array_shift($clean_header);
$this->table->set_heading($clean_header);

// view
// view
$tmpl = array(
    'table_open' => '<table width="100%" cellpadding="0" cellspacing="0">',
);
$this->table->set_template($tmpl);
$tmpl = array ( 'table_open'  => '<table  class="table table-striped">' );$this->table->set_template($tmpl);echo $this->table->generate($results);
echo $this->pagination->create_links(); $this->load->view('template_menu'); $this->load->view('template_footer')
?>
<script type="text/javascript">
    function deletechecked(link) {
        var answer = confirm('Delete item?')
        if (answer) {
            window.location = link;
        }
        return false;
    }
</script>