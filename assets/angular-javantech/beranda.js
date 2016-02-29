'use strict';
//var myJavanTech = angular.module('myJavanTech', []);
var myJavanTech = angular.module('myJavanTech', ['ui.bootstrap', 'ngFileUpload', 'ngDialog', 'ngRoute', 'ngSanitize']);


myJavanTech.factory("berandaServicesJT", ['$http', function ($http) {
    var serviceBase = 'http://localhost:7777/p2e-lib-dev/';
    var obj = {};

    //    obj.updateHasilPenelitian = function (id) {
    //        return $http.post(serviceBase + 'laporanpenelitian/update/' + id).then(function (result) {
    //            return result;
    //        });
    //    };

    obj.getData = function (id) {
      return $http.get(serviceBase + 'beranda/getData', {
        id: id
      }).success(function (r) {
        //console.log(r);
        return r;
      });
    };
    
//    obj.getDatas = function (data) {
//      return $http.get(serviceBase + 'beranda/getData', {
//        id: id
//      }).success(function (r) {
//        //console.log(r);
//        return r;
//      });
//    };
    
    obj.getDatas = function (data) {
      $http.post(base_url + "beranda/getDatas", data);
    };

    //    obj.submitData = function (data) {
    //        //        return $http.post(serviceBase + 'laporanpenelitian/saveData', data).success(function (r) {
    //        //            //console.log(r);
    //        //            return r;
    //        //        });
    //        Upload.upload({
    //            url: serviceBase + 'laporanpenelitian/saveData',
    //            method: 'POST',
    //            file: file,
    //            sendFieldsAs: 'form',
    //            fields: data
    //        });
    //    };

    //    obj.getCategories = function () {
    //        return $http.get(serviceBase + 'category/get_cmb_category');
    //
    //    };



    //    obj.getCustomer = function (customerID) {
    //        return $http.get(serviceBase + 'customer?id=' + customerID);
    //    }
    //    obj.insertCustomer = function (customer) {
    //        return $http.post(serviceBase + 'insertCustomer', customer).then(function (results) {
    //            return results;
    //        });
    //    };
    //
    //    obj.updateCustomer = function (id, customer) {
    //        return $http.post(serviceBase + 'updateCustomer', {
    //            id: id,
    //            customer: customer
    //        }).then(function (status) {
    //            return status.data;
    //        });
    //    };
    //
    //    obj.deleteCustomer = function (id) {
    //        return $http.delete(serviceBase + 'deleteCustomer?id=' + id).then(function (status) {
    //            return status.data;
    //        });
    //    };

    return obj;
  }]);

//myJavanTech.controller('mainController', ['$scope', '$http', '$log', '$dialogs', 'servicesJT', 'Upload', function ($scope, $http, $log, $dialogs, servicesJT, Upload) {
myJavanTech.controller('berandaController', ['$scope', '$http', '$log', 'berandaServicesJT', 'Upload', 'ngDialog', '$location', '$window', function ($scope, $http, $log, berandaServicesJT, Upload, ngDialog, $location, $window, $route, $routeParams, $timeout) {

    /**
     * INITIALITATION
     */

    var search = $scope.txtSearch || "";
    var currentPage = $scope.currentPage || 1;
    var data = {
      search: "",
      writer: "",
      currentPage: 1
    };

    var pagination = function (totalItem, currentPage) {
      $scope.totalItems = totalItem;
      $scope.currentPage = currentPage;

      $scope.setPage = function (pageNo) {
        $scope.currentPage = pageNo;
      };
    };

    var getData = function (data) {
      $http.post(base_url + "beranda/getData", data).success(function (r) {
        $scope.datas = r.json;
//        pagination(r.totalrow, data.currentPage);
        console.log(r);
      });
    };
    
    getData(data);
    

    /**
     * LOAD DATA 1st
     */
//    loadData(data);

    /**
     * Load Combo Category
     */
    //    servicesJT.getCategories().success(function (r) {
    //        $scope.optCategories = r.json
    //        console.log(r);
    //    });

    /**
     * CLICK BY WRITER
     * @param {[[Type]]} author [[Description]]
     */
    $scope.selectWriter = function (writer) {
      // alert(txtData);
      console.log(writer);
      data = {
        search: $scope.txtSearch || "",
        writer: writer,
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
        currentPage: $scope.currentPage || 1
      };

      loadData(data);
    };

    $scope.delete = function (ID, title) {
      var conf = confirm('Apakah Anda yakin akan menghapus data ini ?');
      if (conf) {
        //            console.log(conf);
        data = {
          id: ID,
          title: title
        };
        console.log(data);
        $http.post(base_url + "laporanpenelitian/delete", data).success(function (r) {
          console.log(r);
          data = {
            search: $scope.txtSearch || "",
            writer: "",
            currentPage: $scope.currentPage || 1
          };

          loadData(data);
        });
      } else {
        console.log('FALSE');
      }
    };

    $scope.edit = function (ID) {

      $location.path('/post/').search({
        id: ID
      });
      $location.replace();

      //        console.log($location.path('/'));
      //        console.log("test");

      //        $location.path( base_url + "laporanpenelitian/post/" + ID );
      //                    $location.absUrl()  == base_url + "laporanpenelitian/post/" + ID;
      //                $window.location.href = base_url + "laporanpenelitian/post/" + ID;
      //        $location.path("laporanpenelitian/post/" + ID);
      //        $location.path == "laporanpenelitian/post/" + ID;

      //        ngDialog.open({
      //            template: 'templateId',
      //            scope: servicesJT.getHasilPenelitian(ID).success(function (r) {
      //            // console.log(r.json[0].categoryID);
      //            // console.log(r.json);
      //            $scope.txtJudul = r.json[0].judul;
      //            $scope.txtTahun = parseInt(r.json[0].tahun);
      //            $scope.cmbKategory = r.json[0].categoryID;
      //            $scope.txtPenulis = r.json[0].penulis;
      //        })
      //        });

      //        servicesJT.getHasilPenelitian(ID).success(function (r) {
      //            // console.log(r.json[0].categoryID);
      //            // console.log(r.json);
      //            $scope.txtJudul = r.json[0].judul;
      //            $scope.txtTahun = parseInt(r.json[0].tahun);
      //            $scope.cmbKategory = r.json[0].categoryID;
      //            $scope.txtPenulis = r.json[0].penulis;
      //        });

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
        console.log(data);
      });
      //        servicesJT.submitData(data).success(function (r) { });
    };

    /**
     * SEARCH FILTER
     * @param {Object} event [[Description]]
     */
    $scope.add = function (event) {
      if (event.keyCode === 13) {
        data = {
          search: $scope.txtSearch || "",
          writer: "",
          currentPage: $scope.currentPage || 1
        };
        console.log(data);
        loadData(data);
      }
    };

  }]);

//myJavanTech.config(function ($routeProvider, $locationProvider) {
//    //    $locationProvider.html5Mode(true).hashPrefix('!');
//    console.log($routeProvider);
//    console.log($locationProvider);
//    $routeProvider
//        .when("/edit/:ID", {
//            title: 'Edit Data',
//            templateUrl: 'edit',
//            controller: 'editCtrl',
//            resolve: {
//                customer: function (services, $route) {
//                    //            var customerID = $route.current.params.customerID;
//                    //            return services.getCustomer(customerID);
//                }
//            }
//        });
//});