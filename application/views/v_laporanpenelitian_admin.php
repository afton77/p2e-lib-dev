<?php $this->load->view('template_header') ?>
<div class="container">

  <div class="row">
    <h1>LAPORAN PENELITIAN</h1>
  </div>
  <div class="row">
    <div ng-view></div>
  </div>
  <div ng-controller="mainController">
    <div class="row">
      <div class="form-group">
        <div class="input-group">
          <div class="input-group-addon">Pencarian</div>
          <input type="text" class="form-control" ng-model="txtSearch" ng-keyup="add($event)" id="exampleInputAmount" placeholder="Search">
        </div>
      </div>
    </div>
    <!--    
        <script type="text/ng-template" id="templateId">
          <div class="row">
          <div class="panel panel-primary">
          <div class="panel-heading">Edit/Input Data</div>
          <div class="panel-body">
    
          <form enctype="multipart/form-data" name="myForm">
          <div class="form-group">
          <label for="Judul">Judul</label>
          <span style="color:red" ng-show="myForm.txtJudul.$dirty && myForm.txtJudul.$invalid">
          <span ng-show="myForm.txtJudul.$error.required">Judul harus diisi</span>
          </span>
          <input type="text" name="txtJudul" class="form-control" id="Judul" ng-model="txtJudul" placeholder="Judul" required>
          <input type="hidden" class="form-control" id="ID" ng-model="txtID">
          </div>
          <div class="form-group">
          <label for="Tahun">Tahun</label>
          <span style="color:red" ng-show="myForm.txtTahun.$dirty && myForm.txtTahun.$invalid">
          <span ng-show="myForm.txtTahun.$error.required">Tahun harus diisi</span>
          <span class="error" ng-show="myForm.txtTahun.$error.number"> Not valid number!</span>
          </span>
          <input type="number" min="1900" max="2100" class="form-control" name="txtTahun" id="Tahun" ng-model="txtTahun" placeholder="YYYY" required>
          </div>
          <div class="form-group">
          <label for="Penulis">Penulis</label>
          <span style="color:red" ng-show="myForm.txtPenulis.$dirty && myForm.txtPenulis.$invalid">
          <span ng-show="myForm.txtPenulis.$error.required">Penulis harus diisi</span>
          </span>
          <input type="text" class="form-control" id="Penulis" name="txtPenulis" ng-model="txtPenulis" placeholder="Penulis" required>
          </div>
          <div class="form-group">
          <label for="Kategori">Kategori</label>
          <span style="color:red" ng-show="myForm.cmbKategory.$dirty && myForm.cmbKategory.$invalid">
          <span ng-show="myForm.cmbKategory.$error.required">Kategori harus dipilih</span>
          </span>
          <select class="form-control" ng-model="cmbKategory"" name="cmbKategory" required>
          <option value="">--Pilih Kategori--</option>
          <option ng-repeat="cmbCat in optCategories" value="{{cmbCat.id}}">{{cmbCat.nama}}</option>
          </select>
          </div>
          <div class="form-group">
          watching model:
          <input class="button" ngf-reset-on-click="true" type="file" ngf-select ng-model="file">Upload File</input>
    
    
    
          Sample 
                        <label for="File">File(unggah file)</label>
          <input type="file" id="exampleInputFile" name="file">
          <p class="help-block">Hanya file pdf(*.pdf) yang diperbolehkan.</p>
          </div>
          <button type="reset" class="btn btn-warning">Reset</button> 
          <button type="button" ng-disabled="myForm.$invalid" multiple="true" ng-model="formSubmit" ng-click="doSubmit()" class="btn btn-primary">Submit</button>
          </form>
          </div>
          </div>
          </div>
        </script>
    -->
    <div class="row">
      <pagination items-per-page="30" total-items="totalItems" ng-model="currentPage" ng-change="pageChanged()"></pagination>
      <br />
      <br />
    </div>

    <div class="row">
      <table class="table table-striped">
        <tbody>
          <tr ng-repeat="x in names">
            <td>
              <h3>{{x.judul}}</h3>
              <p><span class="label label-info"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Penulis</span>
                <a ng-click="selectWriter(x.penulis)" href >{{x.penulis}}</a>
                <span class="label label-info"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> Tahun</span> {{x.tahun}}
                <span class="label label-info"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Kategori</span> {{x.Program_Penelitian}}
                <span class="label label-info"><span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span> File</span>
                <a href="<?php echo base_url(); ?>uploads/{{x.pdf}}">Unduh (Download)</a>
              </p>
              
              <p>
                <a href="../post"><button type="button" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span>Tambah</button></a> 
                <a href="../post#{{x.id}}"><button type="button" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span>Edit</button></a> 
                <button ng-click="delete(x.id, x.pdf)" confirm="Are you sure, {{x.judul}}?" type="button" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span>Remove</button>
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

<script src="<?php echo base_url(); ?>assets/angular-javantech/myLaporanPenelitian.js" type="text/javascript"></script>

<script type="text/javascript">
        function deletechecked(link) {
          var answer = confirm('Delete item?')
          if (answer) {
            window.location = link;
          }
          return false;
        }
</script>