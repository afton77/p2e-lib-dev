'use strict';
//var myJavanTech = angular.module('myJavanTech', []);
//var myJavanTech = angular.module('myJavanTech', ['ui.bootstrap', 'dialogs', 'ngFileUpload', 'ngDialog']);
var myJavanTech = angular.module('myJavanTech', ['ui.bootstrap', 'ngFileUpload', 'ngDialog', 'ngRoute']);

/**
 * 
 * @param int ID
 * @param object form
 */
myJavanTech.factory("servicesJT", ['$http', function ($http) {
    var serviceBase = 'http://localhost:7777/p2e-lib-dev/';
    var obj = {};

    obj.submitData = function (data) {
      Upload.upload({
        url: serviceBase + 'transkrip/saveData',
        method: 'POST',
        file: file,
        sendFieldsAs: 'form',
        fields: data
      });
    };

    obj.getCategories = function () {
      return $http.get(serviceBase + 'category/get_cmb_category_transcript');
    };

    obj.getData = function (ID) {
//      return $http.get(serviceBase + 'transkrip/getData/' + ID);
      return $http.get(serviceBase + 'bankdata/getData/' + ID + '/ts');
    };

    return obj;
  }]);

/**
 * 
 * @param int ID
 * @param object form
 */
myJavanTech.controller('postController', ['$scope', '$http', '$log', 'servicesJT', 'Upload', 'ngDialog', '$timeout', '$location', function ($scope, $http, $log, servicesJT, Upload, ngDialog, $timeout, $location) {

    var id = "";
    /**
     * Load Combo Category
     */
    servicesJT.getCategories().success(function (r, id) {
      $scope.optCategories = r.json
    });

    if ($location.path().replace().replace('/', '')) {
      id = $location.path().replace().replace('/', '');
      $timeout(function () {
        servicesJT.getData(id).success(function (r) {
          var dt = new Date(r.json[0].tanggal)
          $scope.txtID = r.json[0].id;
          $scope.txtJudul = r.json[0].judulpenelitian;
          $scope.txtInterview = r.json[0].judulwawancara;
          $scope.txtTahun = dt;
          $scope.cmbKategory = r.json[0].bagian;
          $scope.txtNarasumber = r.json[0].narasumber;
        });
      }, 1000);
    }
    
    /**
     * Save Data
     * @returns String
     */
    
    $scope.doSubmit = function () {
      var serviceBase = 'http://localhost:7777/p2e-lib-dev/';
      var id = $location.path().replace().replace('/', '') ? $location.path().replace().replace('/', '') : "";
      var data = {
        id: id,
        title: $scope.txtJudul,
        interview_title: $scope.txtInterview,
        year: $scope.txtTahun,
        narasumber: $scope.txtNarasumber,
        category: $scope.cmbKategory
      };
//      console.log(data);
      Upload.upload({
        url: serviceBase + 'transkrip/save_data',
        method: 'POST',
        file: $scope.file,
        fields: data,
        data: data
      }).success(function (data, status, headers, config) {
//        console.log(data);

        alert("data Anda telah berhasil disimpan");
//        $location.replace(serviceBase + 'transkrip/manage/');
        window.location.href = serviceBase + 'transkrip/manage/';
        
      });
    };
  }]);

myJavanTech.config(function ($routeProvider, $locationProvider) {
  $routeProvider.when("/post/:id", {
    title: 'Edit Data',
    templateUrl: 'post/management',
    controller: 'postController',
    resolve: {
      customer: function (services, $route) {
//        var customerID = $route.current.params.customerID;
        // console.log(services);
        // alert("test");
      }
    }
  });
});