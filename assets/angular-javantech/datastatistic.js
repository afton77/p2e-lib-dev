'use strict';
var myJavanTech = angular.module('myJavanTech', ['ui.bootstrap', 'ngDialog', 'ngRoute']);

myJavanTech.controller('dataStatisticController', ['$scope', '$http', '$log', 'ngDialog', '$location', '$window', function ($scope, $http, $log, ngDialog, $location, $window, $route, $routeParams, $timeout) {

    /**
     * INITIALITATION
     */
    var search = $scope.txtSearch || "";
    var currentPage = $scope.currentPage || 1;
    var data = {
      search: search,
      writer: "",
      currentPage: 1,
      category: "statisticdata"
    };

    /**
     * PAGINATION
     * @param {int} totalItem
     * @param {int} currentPage
     * @returns {undefined}
     */
    var pagination = function (totalItem, currentPage) {
      $scope.totalItems = totalItem;
      $scope.currentPage = currentPage;

      $scope.setPage = function (pageNo) {
        $scope.currentPage = pageNo;
      };
    };

    /**
     * DATA LOADER
     * @param {obj} data
     * @returns {JSON}
     */
    var loadData = function (data) {
      $http.post(base_url + "bankdata/getDatas", data).success(function (r) {
        $scope.names = r.json;
        pagination(r.totalrow, data.currentPage);
//        console.log(r);
      });
    };

    /**
     * Run data loader
     */
    loadData(data);


    /**
     * CLICK BY WRITER
     * @param {[[Type]]} author [[Description]]
     */
    $scope.selectWriter = function (writer) {
      data = {
        search: $scope.txtSearch || "",
        writer: writer,
        currentPage: $scope.currentPage || 1,
        category : "statisticdata"
      };
      loadData(data);
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
          currentPage: $scope.currentPage || 1,
          category : "statisticdata"
        };
//        console.log(data);
        loadData(data);
      }
    };

    /**
     * PAGINATION
     */
    $scope.pageChanged = function () {
      data = {
        search: $scope.txtSearch || "",
        writer: "",
        currentPage: $scope.currentPage || 1,
        category : "statisticdata"
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
        $http.post(base_url + "datastatistik/delete", data).success(function (r) {
          console.log(r);
          data = {
            search: $scope.txtSearch || "",
            writer: "",
            currentPage: $scope.currentPage || 1,
            category : "statisticdata"
          };

          loadData(data);
        });
      } else {
        console.log('FALSE');
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