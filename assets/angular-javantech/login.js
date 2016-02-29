'use strict';
//var myJavanTech = angular.module('myJavanTech', []);
//var myJavanTech = angular.module('myJavanTech', ['ui.bootstrap', 'dialogs', 'ngFileUpload', 'ngDialog']);
var myJavanTech = angular.module('myJavanTech', ['ui.bootstrap', 'ngFileUpload', 'ngDialog', 'ngRoute']);

/**
 * 
 * @param int ID
 * @param object form
 */
myJavanTech.factory("loginServicesJT", ['$http', function ($http) {
    var serviceBase = 'http://localhost:7777/p2e-lib-dev/';
    var obj = {};

    /**
     * Submit Login
     * @param JSON data
     * @returns JSON
     */
    obj.submitLogin = function (data) {
      return $http.post(serviceBase + 'login/login', data);
    };
    return obj;
  }]);

/**
 * 
 * @param int ID
 * @param object form
 */
myJavanTech.controller('loginController', ['$scope', '$http', '$log', 'ngDialog', '$location', 'loginServicesJT', '$window', function ($scope, $http, $log, ngDialog, $location, loginServicesJT, $window) {
    $scope.login = function (event) {
      $scope.rLogin = "";
      var data = {
        email: $scope.txtEmail || "",
        password: $scope.txtPassword || ""
      };
      // console.log(data);
      loginServicesJT.submitLogin(data).then(function (r) {
//        console.log(r);
        if (r.data.r) {
          $window.location = "http://localhost:7777/p2e-lib-dev/admins";
        } else {
          $scope.rLogin = "Maaf, email atau password Anda salah !";
//          console.log("Gagal")
        }
      });
    };

    $scope.eLogin = function (event) {
      if (event.keyCode === 13) {
        $scope.rLogin = "";
        var data = {
          email: $scope.txtEmail || "",
          password: $scope.txtPassword || ""
        };
        loginServicesJT.submitLogin(data).then(function (r) {
          if (r.data.r) {
            $window.location = "http://localhost:7777/p2e-lib-dev/admins";
          } else {
            $scope.rLogin = "Maaf, email atau password Anda salah !";
          }
        });
      }
    };

    $scope.reset = function (event) {
      $scope.rLogin = "";
    };
  }]);

//myJavanTech.config(function ($routeProvider, $locationProvider) {
//      $locationProvider.html5Mode(true).hashPrefix('!');
//  console.log($routeProvider);
//  console.log($locationProvider);
//  $routeProvider.when("/post/:id", {
//    title: 'Edit Data',
//    templateUrl: 'post',
//    controller: 'editCtrl',
//    resolve: {
//      customer: function (services, $route) {
//        var customerID = $route.current.params.customerID;
//        console.log(customerID);
//        // return services.getCustomer(customerID);
//      }
//    }
//  });
//});