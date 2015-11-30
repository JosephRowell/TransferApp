'use strict';

/*================================================
Module - Main App Module
================================================ */
angular.module('transferApp', ['ngRoute', 'transferApp.controllers', 'transferApp.services'])


.config(function ($routeProvider, $locationProvider) {

  /*================================================
  Define all the Routes
  Ref.
  https://docs.angularjs.org/api/ng/provider/$locationProvider
  ================================================ */
	$routeProvider

    .when('/', {
        templateUrl: 'views/main.tpl.html',
        controller: 'MainCtrl',
        reloadOnSearch: false
    })

    .when('/enterCourses', {
        templateUrl: 'views/enterCourses.tpl.html',
        controller: 'enterCoursesCtrl',
       reloadOnSearch: false
    })

    .when('/viewCourses', {
        templateUrl: 'views/viewCourses.tpl.html',
        controller: 'viewCoursesCtrl',
        reloadOnSearch: false
    })

    .when('/adminCourses', {
        templateUrl: 'views/adminCourses.tpl.html',
        controller: 'adminCoursesCtrl',
        reloadOnSearch: false
    })

    .when('/faqs', {
        templateUrl: 'views/faqs.tpl.html',
        reloadOnSearch: false
    })
    
    .otherwise({
        redirectTo: '/'
    });
      

    $locationProvider.html5Mode({
      enabled: true,
      requireBase: false
    });

  });