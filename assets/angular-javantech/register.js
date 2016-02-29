'use strict';
var myJavanTech = angular.module('myJavanTech', ['ui.bootstrap', 'ngFileUpload', 'ngDialog', 'ngRoute']);

/**
 * 
 * @param int ID
 * @param object form
 */
myJavanTech.factory("registerServicesJT", ['$http', function ($http) {
    var serviceBase = 'http://localhost:7777/p2e-lib-dev/';
    var obj = {};

    /**
     * Submit Register
     * @param JSON data
     * @returns JSON
     */
    obj.submitRegister = function (data) {
      return $http.post(serviceBase + 'register/register', data);
    };
    
    obj.checkEmail = function (data) {
    	return $http.post(serviceBase + 'register/check_email', data);
    };
    return obj;
  }]);

/**
 * 
 * @param int ID
 * @param object form
 */
myJavanTech.controller('registerController', ['$scope', '$http', '$log', 'ngDialog', '$location', 'registerServicesJT', '$window', function ($scope, $http, $log, ngDialog, $location, registerServicesJT, $window) {
    $scope.register = function (event) {
      $scope.rRegister = "";
      var data = {
        fName: $scope.txtName || "",
        lName: $scope.txtLastName || "",
        email: $scope.txtEmail || "",
        email2: $scope.txtEmail2 || "",
        password: $scope.txtPassword || "",
        instansi: $scope.txtInstansi || "",
        address: $scope.txtAddress || ""
      };
      registerServicesJT.submitRegister(data).then(function (r) {
    	  console.log(r);
//        if (r.data.r) {
//          $window.location = "http://localhost:7777/p2e-lib-dev/admins";
//        } else {
//          $scope.rRegister = "Maaf, email atau password Anda salah !";
//        }
      });
    };
    
    $scope.checkEmail = function (r) {
        var data = {
          email: $scope.txtEmail || ""
        };
//        console.log(data);
        registerServicesJT.checkEmail(data).then(function (r) {
          console.log(r.data.result);
          if (r.data.result == false) {
        	  $scope.validateEmail  = "Surel/email Anda sudah terdaftar di sistem.";
          } else {
        	  $scope.validateEmail = "";
          }
        });
    };
    
    $scope.matchEmail = function (r){
    	if ($scope.txtEmail != $scope.txtEmail2){
    		$scope.validateMatchEMail = "Surel/email Anda tidak sama.";
    	} else {
    		$scope.validateMatchEMail = "";
    	}
    }

    $scope.eRegister = function (event) {
      if (event.keyCode === 13) {
        $scope.rRegister = "";
        var data = {
          email: $scope.txtEmail || "",
          password: $scope.txtPassword || ""
        };
        registerServicesJT.submitRegister(data).then(function (r) {
          if (r.data.r) {
            $window.location = "http://localhost:7777/p2e-lib-dev/admins";
          } else {
            $scope.rRegister = "Maaf, email atau password Anda salah !";
          }
        });
      }
    };

    $scope.reset = function (event) {
      $scope.rRegister = "";
    };
  }]);
