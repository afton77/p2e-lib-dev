'use strict';
// var myJavanTech = angular.module('myJavanTech', []);
var myJavanTech = angular.module('myJavanTech', ['ui.bootstrap', 'ngFileUpload', 'ngDialog', 'ngRoute']);


myJavanTech.factory("servicesJT", ['$http', function ($http) {
    var serviceBase = 'http://localhost:7777/p2e-lib-dev/';
    var obj = {};
    return obj;
  }]);

myJavanTech.controller('mainController', ['$scope', '$http', '$log', 'servicesJT', 'Upload', 'ngDialog', '$location', '$window', function ($scope, $http, $log, servicesJT, Upload, ngDialog, $location, $window, $route, $routeParams, $timeout) {

    /**
	 * INITIALITATION
	 */

    var search = $scope.txtSearch || "";
    var currentPage = $scope.currentPage || 1;
    var data = {
        search: search,
        writer: "",
        year: $scope.sltYear || "",
        currentPage: 1
    };

    var pagination = function (totalItem, currentPage) {
        $scope.totalItems = totalItem;
        $scope.currentPage = currentPage;

        $scope.setPage = function (pageNo) {
            $scope.currentPage = pageNo;
        };
    };

    var loadData = function (data) {
        $http.post(base_url + "laporanpenelitian/loadJSONData", data).success(function (r) {
            $scope.names = r.json;
            pagination(r.totalrow, data.currentPage);
            // console.log(r);
        });
    };

    /**
	 * LOAD DATA 1st
	 */
    loadData(data);

    /**
	 * Load Combo Category
	 */
    // servicesJT.getCategories().success(function (r) {
    // $scope.optCategories = r.json
    // console.log(r);
    // });
    
    /**
	 * DIALOG MODAL
	 */
    
    $scope.showModal = false;
    $scope.toggleModal = function(e){
    	$scope.reqData = {FileName : e};
    	$scope.showModal = !$scope.showModal;
//    	$scope.showModal = false;
    };
    
    


    /**
	 * CLICK BY WRITER
	 * 
	 * @param {[[Type]]}
	 *            author [[Description]]
	 */
    $scope.selectWriter = function (writer) {
        // alert(txtData);
        // console.log(writer);
        data = {
            search: $scope.txtSearch || "",
            writer: writer,
            year: $scope.sltYear || "",
            currentPage: $scope.currentPage || 1
        };
        loadData(data);
    };


    /**
	 * PAGINATION
	 */
    $scope.pageChanged = function () {
        data = {
            search: $scope.txtSearch || "",
            writer: "",
            year: $scope.sltYear || "",
            currentPage: $scope.currentPage || 1
        };

        loadData(data);
    };

    $scope.delete = function (ID, title) {
        var conf = confirm('Apakah Anda yakin akan menghapus data ini ?');
        if (conf) {
            // console.log(conf);
            data = {
                id: ID,
                title: title
            };
            // console.log(data);
            $http.post(base_url + "laporanpenelitian/delete", data).success(function (r) {
                // console.log(r);
                data = {
                    search: $scope.txtSearch || "",
                    writer: "",
                    year: $scope.sltYear || "",
                    currentPage: $scope.currentPage || 1
                };

                loadData(data);
            });
        } else {
            // console.log('FALSE');
        }
    };

    $scope.edit = function (ID) {

        $location.path('/post/').search({
            id: ID
        });
        $location.replace();

    };
    
  $scope.requestFile = function(data){
	  // console.log(data);
	  $http.post(base_url + "Filerequest", data).success(function (r) {
		  // console.log(r)
          // $scope.names = r.json;
          // pagination(r.totalrow, data.currentPage);
          // console.log(r);
		  $scope.showModal = false;
      });
  };

    $scope.doSubmit = function () {
        var serviceBase = 'http://localhost:7777/p2e-lib-dev/';
        data = {
            id: $scope.txtID,
            title: $scope.txtJudul,
            author: $scope.txtPenulis,
            year: $scope.txtTahun,
            category: $scope.cmbKategory
        }

        Upload.upload({
            url: serviceBase + 'laporanpenelitian/save_data',
            method: 'POST',
            file: $scope.file,
            fields: data,
            // sendFieldsAs : 'form',

            data: data
        }).success(function (data, status, headers, config) {
            // console.log(data);
        });
        // servicesJT.submitData(data).success(function (r) { });
    };

    /**
	 * SEARCH FILTER
	 * 
	 * @param {Object}
	 *            event [[Description]]
	 */
    $scope.add = function (event) {
        if (event.keyCode === 13) {
            data = {
                search: $scope.txtSearch || "",
                writer: "",
                year: $scope.sltYear || "",
                currentPage: $scope.currentPage || 1
            };
            // console.log(data);
            loadData(data);
        }
    };
    
//    $scope.yearSelected = function (event) {
//    	
//        data = {
//            search: $scope.txtSearch || "",
//            writer: "",
//            year: $scope.sltYear || "",
//            currentPage: $scope.currentPage || 1
//        };
//        // console.log(data);
//        loadData(data);
//    };

  }]);

/**
 * Directive
 */

myJavanTech.directive('modal', function () {
    return {
      template: '<div class="modal fade">' + 
          '<div class="modal-dialog">' + 
            '<div class="modal-content">' + 
              '<div class="modal-header">' + 
                '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>' + 
                '<h4 class="modal-title">{{ title }}</h4>' + 
              '</div>' + 
              '<div class="modal-body" ng-transclude></div>' + 
            '</div>' + 
          '</div>' + 
        '</div>',
      restrict: 'E',
      transclude: true,
      replace:true,
      scope:true,
      link: function postLink(scope, element, attrs) {
        scope.title = attrs.title;

        scope.$watch(attrs.visible, function(value){
          if(value == true)
            $(element).modal('show');
          else
            $(element).modal('hide');
        });

        $(element).on('shown.bs.modal', function(){
          scope.$apply(function(){
            scope.$parent[attrs.visible] = true;
          });
        });

        $(element).on('hidden.bs.modal', function(){
          scope.$apply(function(){
            scope.$parent[attrs.visible] = false;
          });
        });
      }
    };
  });


// myJavanTech.config(function ($routeProvider, $locationProvider) {
// // $locationProvider.html5Mode(true).hashPrefix('!');
// console.log($routeProvider);
// console.log($locationProvider);
// $routeProvider
// .when("/edit/:ID", {
// title: 'Edit Data',
// templateUrl: 'edit',
// controller: 'editCtrl',
// resolve: {
// customer: function (services, $route) {
// // var customerID = $route.current.params.customerID;
// // return services.getCustomer(customerID);
// }
// }
// });
// });
