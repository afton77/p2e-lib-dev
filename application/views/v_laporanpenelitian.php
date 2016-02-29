<?php $this->load->view('template_header') ?>
<div class="container">
  <div ng-controller="mainController">
    <div class="row">
      <h1>LAPORAN PENELITIAN</h1>
    </div>
	

  <!-- Modal -->
  <!-- Download file from model -->
  <modal title="Download File" visible="showModal">
    <form role="form">
      <div class="form-group">
        <label for="email">Surel / Email : </label> <span> <i>Masukkan email anda untuk mengunduh file</i></span>
        <input type="email" ng-model="reqData.Email" class="form-control" id="guestEmail" placeholder="MyEmail@domain.com" required />
        <input type="hidden" ng-model="reqData.FileName" class="form-control" id="fileName" />
      </div>
      <button type="button" class="btn btn-default" ng-click="requestFile(reqData)">Submit</button>
    </form>
  </modal>
  <!-- End of Modal -->
  
    <div class="row">
		<div class="row">
	    	<div class="form-group"> 		
		      	<div class="col-lg-3">
			        <div class="input-group">
			          <div class="input-group-addon">Tahun</div>
			          <select class="form-control" ng-model="sltYear" placeholder="Pilih Tahun">
			          	<option value="">Pilih Tahun</option>
			          	<?php 
			          	$i = 1945;
			          	for($i = 1945; $i <= date("Y"); $i++){
			          	?>
			          	<option value="<?php echo $i; ?>"><?php echo $i;?></option>
			          	<?php } ?>
			          </select>
			        </div>
		        	
		        </div>
		        <div class="col-lg-9">
			        <div class="input-group">
			          <div class="input-group-addon">Judul</div>
			          <input type="text" class="form-control" ng-model="txtSearch" ng-keyup="add($event)" id="exampleInputAmount" placeholder="Search">
			        </div>
		        </div>
			</div>
			<br />
		</div>
		<br />
    </div>
    
    <div class="row">
      <pagination items-per-page="30" total-items="totalItems" ng-model="currentPage" ng-change="pageChanged()"></pagination>
    </div>

    <div class="row">
      <table class="table table-striped">
        <tbody>
          <tr ng-repeat="x in names">
            <td>
              <h3>{{x.judul}}</h3>
              <p><span class="label label-warning"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Penulis</span> 
                <button type="button" ng-click="selectWriter(x.penulis)" class="btn btn-link">{{x.penulis}}</button>
                <span class="label label-warning"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> Tahun</span> {{x.tahun}}
                <span class="label label-warning"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Kategori</span> {{x.Program_Penelitian}}
                <!-- <span class="label label-primary"><span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span> File</span><a href="<?php echo base_url(); ?>uploads/{{x.pdf}}"> Unduh (Download)  </a> -->
              	<button ng-click="toggleModal(x.pdf)" class="btn btn-default">Download File</button>
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


<script type="text/ng-template" id="templateId">
    <h1>Template heading</h1>
    <p>Content goes here</p>
	<input>
</script>

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