<?php $this->load->view('template_header') ?>
<div class="container">
  <div class="row">
    <h1>TRANSKRIP</h1>
  </div>
  <div ng-controller="postController">
    <div class="row">
      <div class="panel panel-primary">
        <div class="panel-heading">Edit/Input Data</div>
        <div class="panel-body">
          <form enctype="multipart/form-data" name="myForm">
            <div class="form-group">
              <label for="Judul">Judul Penelitian</label>
              <span style="color:red" ng-show="myForm.txtJudul.$dirty && myForm.txtJudul.$invalid">
                <span ng-show="myForm.txtJudul.$error.required">Judul Penelitian harus diisi</span>
              </span>
              <input type="text" name="txtJudul" class="form-control" id="Judul" ng-model="txtJudul" placeholder="Judul" required>
              <input type="hidden" class="form-control" id="ID" ng-model="txtID">
            </div>
            
            <div class="form-group">
              <label for="Interview">Judul Wawancara</label>
              <span style="color:red" ng-show="myForm.txtInterview.$dirty && myForm.txtInterview.$invalid">
                <span ng-show="myForm.txtInterview.$error.required">"Wawancara dengan" harus diisi</span>
              </span>
              <input type="text" name="txtInterview" class="form-control" id="Judul" ng-model="txtInterview" placeholder="Interview" required>
            </div>
            
            <div class="form-group">
              <label for="Tahun">Tanggal</label>
              <span style="color:red" ng-show="myForm.txtTahun.$dirty && myForm.txtTahun.$invalid">
                <span ng-show="myForm.txtTahun.$error.required">Tanggal harus diisi</span>
                <span class="error" ng-show="myForm.txtTahun.$error.date"> Not valid number!</span>
              </span>
              <input type="date" class="form-control" name="txtTahun" id="Tahun" ng-model="txtTahun" placeholder="YYYY-MM-DD" required>
            </div>
            
            <div class="form-group">
              <label for="Narasumber">Narasumber</label>
              <span style="color:red" ng-show="myForm.txtNarasumber.$dirty && myForm.txtNarasumber.$invalid">
                <span ng-show="myForm.txtNarasumber.$error.required">Penulis harus diisi</span>
              </span>
              <input type="text" class="form-control" id="Penulis" name="txtNarasumber" ng-model="txtNarasumber" placeholder="Narasumber" required>
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

<script src="<?php echo base_url(); ?>assets/angular-javantech/transcriptPost.js" type="text/javascript"></script>
