'use strict';

/*================================================
Module - for the Controllers
================================================ */
angular.module('transferApp.controllers', [])

/**
 * Controller - MainCtrl
 */
.controller('MainCtrl', function($scope, $q, getTodosService) {

	$scope.formData = {};
	$scope.todos={};

	/*
	 * Get Courses
	 */
	getTodosService.getTodos()
		.then(function(answer) {
			$scope.todos = answer;
		},
		function(error) {
			console.log("OOPS!!!! " + JSON.stringify(error));
		}
  	);

})   //END MAIN

	.controller('adminCoursesCtrl', function($scope, $q, getTodosService,
									 createTodoService, updateTodoService, deleteTodoService) {

		$scope.formData = {};
		$scope.todos={};

		/*
		 * Get Todos
		 */
		getTodosService.getTodos()
			.then(function(answer) {
				$scope.todos = answer;
			},
			function(error) {
				console.log("OOPS!!!! " + JSON.stringify(error));
			}
		);


		/*
		 * Create a New Course
		 */
		$scope.createTodo = function() {
			createTodoService.createTodo($scope.formData)
				.then(function(answer) {
					$scope.todos = answer;
				},
				function(error) {
					console.log("OOPS Error Creating Todo!!!! " + JSON.stringify(error));
				}
			);
		};


		/*
		 * Update a Course
		 */
		$scope.editTodo = function(id, txt, isDone) {

			var updateData = {"text":txt, "done": isDone};

			updateTodoService.updateTodo(id, updateData)
				.then(function(answer) {
					$scope.todos = answer;
				},
				function(error) {
					console.log("OOPS Error Updating!!!! " + JSON.stringify(error));
				}
			);
		};


		/*
		 * Delete a Course
		 */
		$scope.deleteTodo = function(id)   //Delete
		{
			deleteTodoService.deleteTodo(id)
				.then(function(answer) {
					$scope.todos = answer;
				},
				function(error) {
					console.log("OOPS Error Deleting!!!! " + JSON.stringify(error));
				}
			);

		};
	})   //end main


/**
 * Controller - viewCoursesCtrl
 */
	.controller('viewCoursesCtrl', function($scope, $q, getTodosService) {

		$scope.formData = {};
		$scope.todos={};

		/*
		 * Get Todos
		 */
		getTodosService.getTodos()
			.then(function(answer) {
				$scope.todos = answer;
			},
			function(error) {
				console.log("OOPS!!!! " + JSON.stringify(error));
			}
		);

	})   //end view courses

/**
 * Controller - enterCoursesCtrl
 */
	//attempting to inject http
	.controller('enterCoursesCtrl', function($scope, $q, getTodosService) {

		$scope.formData = {};
		$scope.todos={};
		$scope.rows=[];

		$scope.addRow = function() {
			$scope.rows.push({

			});

		};

		/*
		 * Get Courses
		 */
		getTodosService.getTodos()
			.then(function(answer) {
				$scope.todos = answer;
			},
			function(error) {
				console.log("OOPS!!!! " + JSON.stringify(error));
			}
		);

	});//end controllers.