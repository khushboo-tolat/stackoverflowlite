var myApp = angular.module('mainApp',["ui.router"]);
myApp.controller('regController', function($scope, $http,$window){    
	
	$scope.isvalid=false;
	$scope.emailvalid=false;
	$scope.checkUsername=function(){
		
		$http({
			method:"POST",
			url: 'http://localhost/stackoverflowlite/index.php/indexController/checkUsername',
			data:{username:$scope.userName},
		}).then(function successCallBack(response){		
			
			if(response.data > 0)
				$scope.isvalid=true;
			else
				$scope.isvalid=false;
		});
	};

	$scope.checkEmail=function(){

		$http({
			method:"POST",
			url:'http://localhost/stackoverflowlite/index.php/indexController/checkEmail',
			data:{email:$scope.email},
		}).then(function successCallBack(response){
			if(response.data>0)
				$scope.emailvalid=true;
			else
				$scope.emailvalid=false;
		});
	};

    $scope.formSubmit = function() {
		  if($scope.emailvalid==true || $scope.isvalid==true)
		  		alert("Please Fill Valid Data First");
     	  else if($scope.password === $scope.confirmPassword){
	           $http({
	               method: "POST",
	               url: 'http://localhost/stackoverflowlite/index.php/indexController/register',
	               data: { username: $scope.userName , email : $scope.email , password : $scope.password , fullname : $scope.fullName},
	           });
	           	$window.location.href="http://localhost/stackoverflowlite/app/views/index.html";  
			}
          else{
          		alert("Confirm Password and Password Must Same");
      	  }	
     };
});


myApp.controller('loginController',function($scope,$http,$window,$state){

	$scope.login=function(){
		
		$http({
			method:"POST",
			url:'http://localhost/stackoverflowlite/index.php/indexController/login',
			data:{ username: $scope.userName, password: $scope.password},
		});

	};
});

myApp.config(function($stateProvider,$urlRouterProvider){

$urlRouterProvider.otherwise("/login");

	$stateProvider
	.state("login",{
		url : '/login',
		templateUrl : "http://localhost/stackoverflowlite/app/views/Authorization/login.html",
		controller  : "loginController"
	})
	.state("register",{
		url: '/register',		
		templateUrl : "http://localhost/stackoverflowlite/app/views/Authorization/register.html",
		controller 	: "regController"
	})
});




