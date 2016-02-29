<?php $this->load->view('template_header') ?>
<div class="container">
  <div ng-controller="karyaPenelitiController">
    <div class="row">
      <h1>KARYA PENELITI</h1>
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
              <p><span class="label label-warning"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Peneliti </span> 
                <button type="button" ng-click="selectWriter(r.peneliti)" class="btn btn-link">{{r.peneliti}}</button>
                <span class="label label-warning"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> Tahun :</span> {{r.year}}
                <span class="label label-primary"><span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span> File</span><a href="<?php echo base_url(); ?>uploads/{{r.pdf}}"> Unduh (Download)  </a>
              </p>
              
              <p>
                <a href="../post"><button type="button" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span>Tambah</button></a> 
                <a href="../post#{{r.id}}"><button type="button" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span>Edit</button></a> 
                <button ng-click="delete(r.id, r.pdf)" confirm="Are you sure, {{r.title}}?" type="button" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span>Remove</button>
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

<script src="<?php echo base_url(); ?>assets/angular-javantech/karyapeneliti.js" type="text/javascript"></script>
