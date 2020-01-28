angular.module('sessionModule').factory('sessionService', function($http) {
     return $http.get('http://localhost/stackoverflowlite/index.php/IndexController/checkSession').then(function(response) {     
          return response.data; 
      });
});