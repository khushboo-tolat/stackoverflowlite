vangular.module('routeApp').factory('sessionService', function($http) {
     return {
          getSession: function(){
               $http({
               method: 'get',
               url: 'http://localhost/stackoverflowlite/index.php/indexController/checkSession'
               }).then(function successCallback(response) {
                    var session = response.data;

                    if(session == "true") {
                         return true;
                    }
                    else{
                         return false;
                    }
               }); 
          }
     }
});
