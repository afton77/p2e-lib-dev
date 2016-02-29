<?php $this->load->view('template_header') ?>
<div class="container">
  <div ng-controller="fgdController">
    <div class="row">
      <h1>FGD</h1>
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
              <p><span class="label label-warning"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> Tahun</span> {{r.year}}
                <span class="label label-primary"><span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span> File</span><a href="<?php echo base_url(); ?>uploads/{{r.file}}"> Unduh (Download)  </a>
              </p>
              
              <p>
                <a href="../post"><button type="button" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span>Tambah</button></a> 
                <a href="../post#{{r.id}}"><button type="button" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span>Edit</button></a> 
                <button ng-click="delete(r.id, r.file)" confirm="Are you sure, {{r.title}}?" type="button" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span>Remove</button>
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


<script src="<?php echo base_url(); ?>assets/angular-javantech/fgd.js" type="text/javascript"></script>

<script type="text/javascript">
        function deletechecked(link) {
          var answer = confirm('Delete item?')
          if (answer) {
            window.location = link;
          }
          return false;
        }
</script>