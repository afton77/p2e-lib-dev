<?php $this->load->view('template_header') ?>
<div class="container">
  <div ng-controller="transcriptController">
    <div class="row">
      <h1>TRANSKRIP</h1>
    </div>

    <div class="row">
      <div class="form-group">
        <div class="input-group">
          <div class="input-group-addon">Pencarian</div>
          <input type="text" class="form-control" ng-model="txtSearch" ng-keyup="add($event)" id="exampleInputAmount" placeholder="Search">
        </div>
      </div>
    </div>
    <div class="row">
      <pagination items-per-page="30" total-items="totalItems" ng-model="currentPage" ng-change="pageChanged()"></pagination>
    </div>

    <div class="row">
      <table class="table table-striped">
        <tbody>
          <tr ng-repeat="r in names">
            <td>
              <h3>{{r.title}}</h3>
              <h4>{{r.interview}}</h4>
              <p><span class="label label-warning"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>Narasumber</span> 
                <button type="button" ng-click="selectWriter(r.narasumber)" class="btn btn-link">{{r.narasumber}}</button>
                <span class="label label-warning"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> Tahun</span> {{r.year}}
                <span class="label label-warning"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Kategori</span> {{r.category}}
                <span class="label label-primary"><span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span> File</span><a href="<?php echo base_url(); ?>uploads/{{r.file}}"> Unduh (Download)  </a>
              </p>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="row">
      <pagination items-per-page="30" total-items="totalItems" ng-model="currentPage" ng-change="pageChanged()"></pagination>
    </div>
  </div>
</div>

<?php
$this->load->view('template_menu');
$this->load->view('template_footer');
?>


<script src="<?php echo base_url(); ?>assets/angular-javantech/transcript.js" type="text/javascript"></script>

<script type="text/javascript">
        function deletechecked(link) {
          var answer = confirm('Delete item?')
          if (answer) {
            window.location = link;
          }
          return false;
        }
</script>