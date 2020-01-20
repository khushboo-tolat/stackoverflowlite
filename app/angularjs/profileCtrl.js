var profile = angular.module('routeApp');

profile.controller('profileCtrl', ['$scope', '$http', function ($scope, $http) { 
     $scope.getUsers = function(){
      $http({
       method: 'get',
       url: 'http://localhost/stackoverflowlite/index.php/Profile/get_user'
      }).then(function successCallback(response) {
        $scope.user = response.data[0];
      }); 
     }
     $scope.getUsers();

     $scope.isvalid=false;
     $scope.checkUsername=function(){		
		$http({
			method:"POST",
			url: 'http://localhost/stackoverflowlite/index.php/IndexController/checkUsername',
			data:{username: $scope.user.userName},
		}).then(function successCallBack(response){		
			
               if(response.data > 0 ){
                    $scope.isvalid=true;
                    document.getElementById("update").disabled = true;
               }
               else{
                    $scope.isvalid=false;
                    document.getElementById("update").disabled = false;
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

     $scope.getUserQues = function(){
          $http({
               method: 'get',
               url: 'http://localhost/stackoverflowlite/index.php/Profile/get_ques'
          }).then(function successCallback(response) {
               $scope.ques = response.data;
          }); 
     }
     $scope.getUserQues();

     // $scope.getUserAns = function(){
     //      $http({
     //           method: 'get',
     //           url: 'http://localhost/stackoverflowlite/index.php/Profile/get_ans'
     //      }).then(function successCallback(response) {
     //           $scope.ans = response.data;
     //      }); 
     // }
     // $scope.getUserAns();

     // $scope.getUserVote = function(){
     //      $http({
     //           method: 'get',
     //           url: 'http://localhost/stackoverflowlite/index.php/Profile/get_vote'
     //      }).then(function successCallback(response) {
     //           $scope.vote = response.data;
     //      }); 
     // }
     // $scope.getUserVote();

     // $scope.getUserComment = function(){
     //      $http({
     //           method: 'get',
     //           url: 'http://localhost/stackoverflowlite/index.php/Profile/get_comment'
     //      }).then(function successCallback(response) {
     //           $scope.comment = response.data;
     //      }); 
     // }
     // $scope.getUserComment();
     
}]);



