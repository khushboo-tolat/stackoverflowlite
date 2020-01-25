var routeApp = angular.module("routeApp", ['ui.router']);

/*routeApp.run(function($rootScope){
     $rootScope.islogin = false;
    $rootScope.success =false;

})*/



routeApp.config(function($stateProvider, $urlRouterProvider) {
     $urlRouterProvider.otherwise("/Profile");

     $stateProvider
     .state("QuesList", {
          url: "/QuesList",
          templateUrl: "http://localhost/stackoverflowlite/app/views/qview.html",
          controller: "quesCtrl"
     })
     .state("QuesView", {
          url: "/QuesView",
          templateUrl: "http://localhost/stackoverflowlite/app/views/questionView.html",
          //controller: "quesviewCtrl"
     })
     .state("postQ", {
          url: "/postQ",
          templateUrl: "http://localhost/stackoverflowlite/app/views/postquestion.html",
          controller: "postquesCtrl"
     })
     .state("Profile", {
          url: "/Profile",
          templateUrl: "http://localhost/stackoverflowlite/app/views/profile.html",
          controller: "profileCtrl"

     })
});

// routeApp.directive('sidebar',function(){
//      return {
//           templateUrl:'http://localhost/stackoverflowlite/app/views/sidebar.html'
//      };
// });
