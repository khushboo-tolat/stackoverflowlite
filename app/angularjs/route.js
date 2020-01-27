var routeApp = angular.module("routeApp", ['ui.router']);

/*routeApp.run(function($rootScope){
     $rootScope.islogin = false;
    $rootScope.success =false;

})*/
routeApp.config(['$qProvider', function ($qProvider) {
$qProvider.errorOnUnhandledRejections(false);
}]);



routeApp.config(function($stateProvider, $urlRouterProvider) {
     $urlRouterProvider.otherwise("Profile");

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
     // .state("qlist",{
     //   url:'/qlist',
     //   views: {
     //                  templateUrl : 'http://localhost/stackoverflowliteproject/app/qview.html'
     //         //controller : 'quesCtrl'
     //
     //   }
     // })
     .state("tag",{
       url:'/tag/:tname',
       views: {

             templateUrl : 'http://localhost/stackoverflowliteproject/app/samp.html'
             //controller:'samp'

       }
     })
     .state("votes",{
       url:'/votes',
       views: {

             templateUrl : 'http://localhost/stackoverflowliteproject/app/samp.html'
             //controller:'samp'

       }
   })
     .state("views",{
       url:'/views',
       views: {

             templateUrl : 'http://localhost/stackoverflowliteproject/app/samp.html'
             //controller:'samp'

       }
     })
     .state("alltags",{
       url:"/alltags",
       views: {

             templateUrl : 'http://localhost/stackoverflowliteproject/app/tpage.html'
             //controller:'tagCtrl'

       }
     });
     // .state("quesdetail",{
     //   url:"/quesdetail/:qid",
     //   views:{
     //
     //       templateUrl : 'http://localhost/stackoverflowliteproject/app/quesdetail.html'
     //       //controller: 'quesdetailCtrl'
     //
     //   }
     // });
});

// routeApp.directive('sidebar',function(){
//      return {
//           templateUrl:'http://localhost/stackoverflowlite/app/views/sidebar.html'
//      };
// });
