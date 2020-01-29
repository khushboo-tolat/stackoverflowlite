angular.module('sessionModule').factory('sessionService', function($http) {
     return {
          kaibirandom : kaibirandom
     }
     
     function kaibirandom (callback) {
          $http.get('http://localhost/stackoverflowlite/index.php/IndexController/checkSession').then(function(response) {    
          if(callback){
               callback(response.data);
          }
          return response.data; 
      });
     }
});