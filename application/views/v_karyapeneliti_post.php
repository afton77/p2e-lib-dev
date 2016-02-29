<?php $this->load->view('template_header')?>
<div class="container">
	<div class="row">
		<h1>KARYA PENELITIAN</h1>
	</div>
	<div ng-controller="postController">
		<div class="row">
			<div class="panel panel-primary">
				<div class="panel-heading">Edit/Input Data</div>
				<div class="panel-body">
					<form enctype="multipart/form-data" name="myForm">
						<div class="form-group">
							<label for="Judul">Judul</label> <span style="color: red"
								ng-show="myForm.txtJudul.$dirty && myForm.txtJudul.$invalid"> <span
								ng-show="myForm.txtJudul.$error.required">Judul harus diisi</span>
							</span> <input type="text" name="txtJudul" class="form-control"
								id="Judul" ng-model="txtJudul" placeholder="Judul" required> <input
								type="hidden" class="form-control" id="ID" ng-model="txtID">
						</div>
						<div class="form-group">
							<label for="Tahun">Tahun</label> <span style="color: red"
								ng-show="myForm.txtTahun.$dirty && myForm.txtTahun.$invalid"> <span
								ng-show="myForm.txtTahun.$error.required">Tahun harus diisi</span>
								<span class="error" ng-show="myForm.txtTahun.$error.number"> Not
									valid number!</span>
							</span> <input type="number" min="1900" max="2100"
								class="form-control" name="txtTahun" id="Tahun"
								ng-model="txtTahun" placeholder="YYYY" required>
						</div>
						<div class="form-group">
							<label for="Penulis">Penulis</label> <span style="color: red"
								ng-show="myForm.txtPenulis.$dirty && myForm.txtPenulis.$invalid">
								<span ng-show="myForm.txtPenulis.$error.required">Penulis harus
									diisi</span>
							</span> <input type="text" class="form-control" id="Penulis"
								name="txtPenulis" ng-model="txtPenulis" placeholder="Penulis"
								required>
						</div>
						<div class="form-group">
							<label for="Email">Surel(Email)</label> <span style="color: red"
								ng-show="myForm.txtEmail.$dirty && myForm.txtEmail.$invalid"> <span
								class="error" ng-show="myForm.txtEmail.$error.email">Format
									Surel(Email) Anda Salah!</span> <span
								ng-show="myForm.txtEmail.$error.required">Surel(Email) harus
									diisi</span>
							</span> <input type="email" class="form-control" id="Email"
								name="txtEmail" ng-model="txtEmail" placeholder="Email" required>
						</div>
						<div class="form-group">
							<label for="Kategori">Kategori</label> <span style="color: red"
								ng-show="myForm.cmbKategory.$dirty && myForm.cmbKategory.$invalid">
								<span ng-show="myForm.cmbKategory.$error.required">Kategori
									harus dipilih</span>
							</span> <select class="form-control" ng-model="cmbKategory"
								" name="cmbKategory" required>
								<option value="">--Pilih Kategori--</option>
								<option ng-repeat="cmbCat in optCategories"
									value="{{cmbCat.id}}">{{cmbCat.nama}}</option>
							</select>
						</div>
						<div>
							<div class="form-group">
								<label for="keterangan">Daftar Isi (Keterangan) Editor2</label>
								<div text-angular="text-angular" name="htmlcontent"
									ng-model="htmlcontent" ta-disabled='disabled'></div>
								<textarea hidden="" ng-model="htmlcontent" style="width: 100%"></textarea>
							</div>

						</div>
						<div class="form-group">
							watching model: <input class="button" ngf-reset-on-click="true"
								type="file" ngf-select ng-model="file">Upload File</input>
						</div>
						<a href="./manage/"><button type="button" class="btn btn-info"><<
								Back</button></a>
						<button type="reset" class="btn btn-warning">Reset</button>
						<button type="button" ng-disabled="myForm.$invalid"
							multiple="true" ng-model="formSubmit" ng-click="doSubmit()"
							class="btn btn-primary">Submit</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
$this->load->view ( 'template_menu' );
$this->load->view ( 'template_footer' );
?>
<link rel='stylesheet'
	href='<?php echo base_url(); ?>assets/font-awesome-4.4.0/css/font-awesome.css'>
<style>
.ta-editor {
	min-height: 200px;
	height: auto;
	overflow: auto;
	font-family: inherit;
	font-size: 100%;
}
</style>

<script
	src='<?php echo base_url(); ?>assets/textAngular-1.4.6/dist/textAngular-rangy.min.js'></script>
<script
	src='<?php echo base_url(); ?>assets/textAngular-1.4.6/dist/textAngular-sanitize.min.js'></script>
<script
	src='<?php echo base_url(); ?>assets/textAngular-1.4.6/dist/textAngular.min.js'></script>

<script
	src="<?php echo base_url(); ?>assets/angular-javantech/karyapenelitiPost.js"
	type="text/javascript"></script>
