<?php $this->load->view('template_header') ?>
<div class="container">
  <div class="row">
    <h1>LAPORAN PENELITIAN</h1>
  </div>
  <div ng-controller="postController">
    <div class="row">
      <div class="panel panel-primary">
        <div class="panel-heading">Edit/Input Data</div>
        <div class="panel-body">
          <form enctype="multipart/form-data" name="requestFileForm">
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
            </div>
            <a href="./manage/"><button type="button" class="btn btn-info"><< Back</button></a> 
            <button type="reset" class="btn btn-warning">Reset</button> 
            <button type="button" ng-disabled="myForm.$invalid" multiple="true" ng-model="formSubmit" ng-click="doSubmit()" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
$this->load->view('template_menu');
$this->load->view('template_footer');
?>

<script src="<?php echo base_url(); ?>assets/angular-javantech/myLaporanPenelitianPost.js" type="text/javascript"></script>
