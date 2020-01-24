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

     $scope.updateUser = function() {         
          $http({
               method: "POST",
               url: "http://localhost/stackoverflowlite/index.php/Profile/update_user",
               dataType: 'json',
               data: {fullname: $scope.user.fullName, username: $scope.user.userName , company: $scope.user.company, desg: $scope.user.designation},
               headers: { "Content-Type": "application/json" }
          });
     }
}]);

