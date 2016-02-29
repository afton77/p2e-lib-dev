<?php $this->load->view('template_header') ?>

<div class="container">
  <div class="row">
    <div ng-controller="berandaController">
      <div ng-repeat="r in datas">
        <div class="col-lg-12">
          <h1>{{r.title}}</h1>
        </div>
        <div class="col-lg-12">
          Tangal : {{r.date}}
        </div>
        <div class="col-lg-12">
          <div ng-bind-html="r.content"></div>
        </div>
        
      </div>
    </div>
  </div>
</div>
<?php // echo $results[0]['content']; ?>
<?php

$this->load->view('template_menu');
$this->load->view('template_footer'); 
?>
<script src="<?php echo base_url(); ?>assets/angular-javantech/beranda.js" type="text/javascript"></script>

