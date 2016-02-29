<?php $this->load->view('template_header') ?>
<div class="container">

  <div class="row">
    <h1>LOGIN</h1>
  </div>
  <div ng-controller="loginController">
    <div class="row">
      <div class="panel panel-primary">
        <div class="panel-heading">Login
          
        </div>
        <div class="panel-body">
          <form enctype="multipart/form-data" name="myForm">
            <div class="form-group">
              <label for="Email">Email <span class="aler alert-danger" role="alert"> {{rLogin}}</span></label>
              <span style="color:red" ng-show="myForm.txtEmail.$dirty && myForm.txtEmail.$invalid">
                <span ng-show="myForm.txtEmail.$error.required">Email harus diisi</span>
                <span ng-show="myForm.txtEmail.$error.email">Format Email Salah</span>
              </span>
              <input type="email" name="txtEmail" class="form-control" ng-keyup="eLogin($event)" id="Email" ng-model="txtEmail" placeholder="Email" required>
            </div>
            <div class="form-group">
              <label for="Tahun">Password</label>
              <span style="color:red" ng-show="myForm.txtPassword.$dirty && myForm.txtPassword.$invalid">
                <span ng-show="myForm.txtPassword.$error.required">Password harus diisi</span>
              </span>
              <input type="password" class="form-control" ng-keyup="eLogin($event)" name="txtPassword" id="Password" ng-model="txtPassword" placeholder="****" required>
            </div>
            <button type="reset" ng-click="reset()" class="btn btn-warning">Reset</button> 
            <button type="button" ng-disabled="myForm.$invalid" multiple="true" ng-model="formSubmit" ng-click="login()" class="btn btn-primary">Submit</button>
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
<script src="<?php echo base_url(); ?>assets/angular-javantech/login.js" type="text/javascript"></script>