<?php $this->load->view('template_header') ?>
<div class="container">

  <div class="row">
    <h1>DAFTAR/REGISTER</h1>
  </div>
  <div ng-controller="registerController">
    <div class="row">
      <div class="panel panel-primary">
        <div class="panel-heading">Login

        </div>
        <div class="panel-body">
          <form enctype="multipart/form-data" name="myForm">

            <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-group">
                  <label for="Name">Nama Awal <i>(first name) </i></label> <span style="color: red" ng-show="myForm.txtName.$dirty && myForm.txtName.$invalid"> <span
                      ng-show="myForm.txtName.$error.required">Nama awal harus diisi</span>
                  </span> <input type="text" name="txtName" class="form-control" id="Name" ng-model="txtName" placeholder="Nama Awal" required> <input type="hidden" class="form-control" id="ID" ng-model="txtID">
                </div>
              </div>

              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-group">
                  <label for="Name">Nama Akhir <i>(last name) </i></label> <span style="color: red" ng-show="myForm.txtLastName.$dirty && myForm.txtLastName.$invalid"> <span
                      ng-show="myForm.txtLastName.$error.required">Nama akhir harus diisi</span>
                  </span> 
                  <input type="text" name="txtLastName" class="form-control" id="Name" ng-model="txtLastName" placeholder="Nama Akhir" required> 
                  <input type="hidden" class="form-control" id="ID" ng-model="txtID">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-group">
                  <label for="Email">Surel <i>(Email)</i> <span class="aler alert-danger" role="alert"> {{rLogin}}</span></label>
                  <span style="color:red" ng-show="myForm.txtEmail.$dirty && myForm.txtEmail.$invalid">
                    <span ng-show="myForm.txtEmail.$error.required">Email harus diisi</span>
                    <span ng-show="myForm.txtEmail.$error.email">Format Email Salah</span>
        
                  </span>
                  <span style="color:red">{{validateEmail}}</span>
                  <input type="email" name="txtEmail" class="form-control" ng-blur="checkEmail($event)" id="Email" ng-model="txtEmail" placeholder="Email" required>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-group">
                  <label for="Email2">Ketik ulang surel <i>(Repeat email)</i> <span class="aler alert-danger" role="alert"> {{rLogin}}</span></label>
                  <span style="color:red" ng-show="myForm.txtEmail2.$dirty && myForm.txtEmail2.$invalid">
                    <span ng-show="myForm.txtEmail2.$error.required">Email harus diisi</span>
                    <span ng-show="myForm.txtEmail2.$error.email">Format Email Salah</span>
                  </span>
                  <span style="color:red">{{validateMatchEMail}}</span>
                  <input type="email" name="txtEmail2" class="form-control" ng-blur="matchEmail($event)" id="Email" ng-model="txtEmail2" placeholder="Email" required>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="Password">Password</label>
              <span style="color:red" ng-show="myForm.txtPassword.$dirty && myForm.txtPassword.$invalid">
                <span ng-show="myForm.txtPassword.$error.required">Password harus diisi</span>
              </span>
              <input type="password" class="form-control" name="txtPassword" id="Password" ng-model="txtPassword" placeholder="****" required>
            </div>
            
            <div class="form-group">
              <label for="Instansi">Instansi</label>
              <span style="color:red" ng-show="myForm.txtInstansi.$dirty && myForm.txtInstansi.$invalid">
                <span ng-show="myForm.txtInstansi.$error.required">Instansi harus diisi</span>
              </span>
              <input type="text" class="form-control"  name="txtInstansi" id="txtInstansi" ng-model="txtInstansi" placeholder="Pemerintah/Swasta/Univ ..." required>
            </div>

            <div class="form-group">
              <label for="Address">Alamat Lengkap <i>(Full Address)</i></label>
              <span style="color:red" ng-show="myForm.txtAddress.$dirty && myForm.txtAddress.$invalid">
                <span ng-show="myForm.txtPassword.$error.required">Alamat lengkap harus Anda isi</span>
              </span>
              <textarea type="Address" class="form-control" name="txtAddress" id="Address" ng-model="txtAddress" placeholder="" required></textarea>
            </div>

            <button type="reset" ng-click="reset()" class="btn btn-warning">Reset</button> 
            <button type="button" ng-disabled="myForm.$invalid" multiple="true" ng-model="formSubmit" ng-click="register()" class="btn btn-primary">Submit</button>
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
<script src="<?php echo base_url(); ?>assets/angular-javantech/register.js" type="text/javascript"></script>