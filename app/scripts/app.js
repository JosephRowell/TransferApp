'use strict';

/**
 * @ngdoc overview
 * @name transferAppApp
 * @description
 * # transferAppApp
 *
 * Main module of the application.
 */
angular
  .module('transferAppApp', [
    'ngAnimate',
    'ngCookies',
    'ngResource',
    'ngRoute',
    'ngSanitize',
    'ngTouch'
  ])
  .config(function ($routeProvider) {
    $routeProvider
      .when('/', {
        templateUrl: 'views/main.html',
        controller: 'MainCtrl',
        controllerAs: 'main'
      })
      .when('/about', {
        templateUrl: 'views/about.html',
        controller: 'AboutCtrl',
        controllerAs: 'about'
      })
	  .when('/viewcourses', {
        templateUrl: 'views/viewcourses.html',
        controller: 'viewCoursesCtrl',
        controllerAs: 'viewcourses'
      })
	  .when('/entercourses', {
        templateUrl: 'views/entercourses.html',
        controller: 'enterCoursesCtrl',
        controllerAs: 'entercourses'
      })
	  .when('/studentview', {
        templateUrl: 'views/studentview.html',
        controller: 'studentViewCtrl',
        controllerAs: 'studentview'
      })
	  .when('/newstudent', {
        templateUrl: 'views/newstudent.html',
        controller: 'newStudentCtrl',
        controllerAs: 'newstudent'
      })
	  .when('/registerconfirm', {
        templateUrl: 'views/registerconfirm.html',
        controller: 'registerConfirmCtrl',
        controllerAs: 'registerconfirm'
      })
      .otherwise({
        redirectTo: '/'
      });
  });
