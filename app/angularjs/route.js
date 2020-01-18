var routeApp = angular.module("routeApp", ['ui.router']);

routeApp.config(function($stateProvider, $urlRouterProvider) {
     $urlRouterProvider.otherwise("/Profile");

     $stateProvider
     .state("QuesList", {
          url: "/Timeline",
          templateUrl: "http://localhost/stackoverflowlite/app/views/queslist.html",
          controller: "quesCtrl"
     })
     .state("QuesView", {
          url: "/QuestionView",
          templateUrl: "http://localhost/stackoverflowlite/app/views/quesview.html",
          //controller: "quesviewCtrl"
     })
     .state("QuesAsk", {
          url: "/AskQuestion",
          templateUrl: "http://localhost/stackoverflowlite/app/views/postques.html",
          controller: "postquesCtrl"
     })
     .state("Profile", {
          url: "/Profile",
          templateUrl: "http://localhost/stackoverflowlite/app/views/profile.html",
          controller: "profileCtrl"
     })
});