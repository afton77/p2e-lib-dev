'use strict';
var myJavanTech = angular.module('myJavanTech', [ 'ui.bootstrap',
		'ngFileUpload', 'ngDialog', 'ngRoute' ]);

/**
 * 
 * @param int
 *            ID
 * @param object
 *            form
 */
myJavanTech.factory("servicesJT", [ '$http', function($http) {
	var serviceBase = 'http://localhost:7777/p2e-lib-dev/';
	var obj = {};

	obj.submitData = function(data) {
		Upload.upload({
			url : serviceBase + 'kajianstrategis/saveData',
			method : 'POST',
			file : file,
			sendFieldsAs : 'form',
			fields : data
		});
	};

	obj.getCategories = function() {
		return $http.get(serviceBase + 'category/get_cmb_category_ss');
	};

	obj.getData = function(ID) {
		return $http.get(serviceBase + 'bankdata/getData/' + ID + '/ss');
	};

	return obj;
} ]);

/**
 * 
 * @param int
 *            ID
 * @param object
 *            form
 */
myJavanTech
		.controller(
				'postController',
				[
						'$scope',
						'$http',
						'$log',
						'servicesJT',
						'Upload',
						'ngDialog',
						'$timeout',
						'$location',
						function($scope, $http, $log, servicesJT, Upload,
								ngDialog, $timeout, $location) {

							var id = "";
							/**
							 * Load Combo Category
							 */
							servicesJT.getCategories().success(function(r, id) {
								$scope.optCategories = r.json
							});

							if ($location.path().replace().replace('/', '')) {
								id = $location.path().replace()
										.replace('/', '');
								$timeout(
										function() {
											servicesJT
													.getData(id)
													.success(
															function(r) {
																$scope.txtJudul = r.json[0].judul;
																$scope.txtTahun = parseInt(r.json[0].tahun);
																$scope.cmbKategory = r.json[0].bagian;
																$scope.txtEmail = r.json[0].email;
															});
										}, 1000);
							}

							/**
							 * Save Data
							 * 
							 * @returns String
							 */

							$scope.doSubmit = function() {
								var serviceBase = 'http://localhost:7777/p2e-lib-dev/';
								var id = $location.path().replace().replace(
										'/', '') ? $location.path().replace()
										.replace('/', '') : "";
								var data = {
									id : id,
									title : $scope.txtJudul,
									year : $scope.txtTahun,
									email : $scope.txtEmail,
									category : $scope.cmbKategory
								}
								// console.log(data);
								Upload
										.upload(
												{
													url : serviceBase
															+ 'kajianstrategis/save_data',
													method : 'POST',
													file : $scope.file,
													fields : data,
													data : data
												})
										.success(
												function(data, status, headers,
														config) {
													// console.log(data);

													alert("data Anda telah berhasil disimpan");
													// $location.replace(serviceBase
													// +
													// 'kajianstrategis/manage/');
													window.location.href = serviceBase
															+ 'kajianstrategis/manage/';

												});
							};
						} ]);

myJavanTech.config(function($routeProvider, $locationProvider) {
	$routeProvider.when("/post/:id", {
		title : 'Edit Data',
		templateUrl : 'post/management',
		controller : 'postController',
		resolve : {
			customer : function(services, $route) {
				//        var customerID = $route.current.params.customerID;
				// console.log(services);
				// alert("test");
			}
		}
	});
});