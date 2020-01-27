var profile = angular.module('routeApp');

profile.controller('profileCtrl', ['$scope', '$http', function ($scope, $http) {
     $scope.user = {};
     $scope.item = false;
     var username = "Hello";
     $scope.getUsers = function(){
      $http({
       method: 'get',
       url: 'http://localhost/stackoverflowlite/index.php/Profile/get_user'
      }).then(function successCallback(response) {
        $scope.user = response.data[0]; 
        $scope.check();   
        $scope.checkReportUser();  
        username = $scope.user.userName;
      }); 
     }
     $scope.getUsers();

     $scope.change = function() {
          if($scope.item){
               $scope.item = false;
          }
          else{
               $scope.item = true;  
          }
     }

     $scope.isvalid=false;
     $scope.checkUsername=function(){		
		$http({
			method:"POST",
			url: 'http://localhost/stackoverflowlite/index.php/IndexController/checkUsername',
			data:{username: $scope.user.userName},
		}).then(function successCallBack(response){
               var temp = document.getElementById("userName").value;
               if(temp !== username){		
                    if(response.data > 0 ){
                         $scope.isvalid=true;
                    }
                    else{
                         $scope.isvalid=false;
                    }
               }
               else{
                    $scope.isvalid=false;   
               }
		});
	};

     $scope.updateUser = function() {   
          if($scope.isvalid==true)
               alert("Please fill valid data first");
          else{                  
               $http({
                    method: "POST",
                    url: "http://localhost/stackoverflowlite/index.php/Profile/update_user",
                    dataType: 'json',
                    data: {fullname: $scope.user.fullName, username: $scope.user.userName , company: $scope.user.company, desg: $scope.user.designation},
                    headers: { "Content-Type": "application/json" }
               });
          }
     }

     $scope.validUser = false;
     $scope.check = function() {
          if (1 == $scope.user.userId) {
               $scope.validUser = true; 
          }
          else { 
               $scope.validUser= false; 
          }
     } 

     $scope.checkReportedUser = 0;

     $scope.checkReportUser = function() {
          $http({
			method:"POST",
			url: 'http://localhost/stackoverflowlite/index.php/Report/checkReportedUser',
			data:{userId: $scope.user.userId},
		}).then(function successCallBack(response){		
               $scope.checkReportedUser = response.data;
          
               if($scope.checkReportedUser > 0) {
                    $scope.reportObj = {
                         "color": "red",
                    }
               }    
               else{
                    $scope.reportObj = {
                         "color": "gray",
                    }
               } 
          });
     }

     $scope.reportUser = function(userId) {
          if($scope.checkReportedUser > 0) {
               $http({
                    method: "POST",
                    url: "http://localhost/stackoverflowlite/index.php/Report/delete_report_user",
                    dataType: 'json',
                    data: {userId: userId},
                    headers: { "Content-Type": "application/json" }
               }).then(function successCallBack(response){
                    $scope.checkReportUser();  
               });
          }
          else {
               $http({
                    method: "POST",
                    url: "http://localhost/stackoverflowlite/index.php/Report/insert_report_user",
                    dataType: 'json',
                    data: {userId: userId},
                    headers: { "Content-Type": "application/json" }
               }).then(function successCallBack(response){
                    $scope.checkReportUser();  
               });
          }
     }

     $scope.getUserQues = function(){
          $http({
               method: 'get',
               url: 'http://localhost/stackoverflowlite/index.php/Profile/get_ques'
          }).then(function successCallback(response) {
               $scope.ques = response.data;
               $scope.ques_length = $scope.ques.length;
          }); 
     }
     $scope.getUserQues();

     $scope.getUserAns = function(){
          $http({
               method: 'get',
               url: 'http://localhost/stackoverflowlite/index.php/Profile/get_ans'
          }).then(function successCallback(response) {
               $scope.ans = response.data;
               $scope.ans_length = $scope.ans.length;
          }); 
     }
     $scope.getUserAns();

     $scope.getUserComment = function(){
          $http({
               method: 'get',
               url: 'http://localhost/stackoverflowlite/index.php/Profile/get_comment'
          }).then(function successCallback(response) {
               $scope.comment = response.data;
               $scope.comment_length = $scope.comment.length;
          }); 
     }
     $scope.getUserComment();
     
}]);



