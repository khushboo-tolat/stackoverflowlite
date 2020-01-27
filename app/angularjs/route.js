var routeApp = angular.module("routeApp", ['ui.router']);

/*routeApp.run(function($rootScope){
     $rootScope.islogin = false;
    $rootScope.success =false;

})*/
routeApp.config(['$qProvider', function ($qProvider) {
$qProvider.errorOnUnhandledRejections(false);
}]);

 // routeApp.config(['$qProvider', function ($qProvider) {
 // $qProvider.errorOnUnhandledRejections(false);
 // }]);

routeApp.config(function($stateProvider, $urlRouterProvider) {
     $urlRouterProvider.otherwise("QuesList");

     $stateProvider
     .state("QuesList", {
          url: "/QuesList",
          templateUrl: "http://localhost/stackoverflowlite/app/views/qview.html",
          controller: "quesCtrl"
     })
     .state("QuesView", {
          url: "/QuesView/:qid",
          templateUrl: "http://localhost/stackoverflowlite/app/views/questionView.html",
          //controller: "quesviewCtrl"
     })
     .state("postQ", {
          url: "/postQ",
          templateUrl: "http://localhost/stackoverflowlite/app/views/postquestion.html",
          controller: "postquesCtrl"
     })
     .state("Profile", {
          url: "/Profile/:uId",
          templateUrl: "http://localhost/stackoverflowlite/app/views/profile.html",
          controller: "profileCtrl"


     })
     // .state("qlist"{
     //    url:"/qlist",
     //    templateUrl:"http://localhost/stackoverflowlite/app/views/qview.html"
     // })
   .state("tag",{
     url:'/tag/:tname',
     views: {

           templateUrl : 'http://localhost/stackoverflowlite/app/views/samp.html'
           //controller:'samp'

     }
   })
   .state("votes",{
     url:'/votes',
     views: {

           templateUrl : 'http://localhost/stackoverflowlite/app/views/samp.html'
           //controller:'samp'

     }
 })
   .state("views",{
     url:'/views',
     views: {

           templateUrl : 'http://localhost/stackoverflowlite/app/views/samp.html'
           //controller:'samp'

     }
   })
   .state("alltags",{
     url:"/alltags",
     views: {

           templateUrl : 'http://localhost/stackoverflowlite/app/views/tpage.html',
           controller:'tagCtrl'

     }
   });
});


routeApp.directive('sidebar',function(){
     return {
          templateUrl:'http://localhost/stackoverflowlite/app/views/sidebar.html',
          controller:'sbCtrl'
     };
});

routeApp.controller("quesdetailCtrl",['$scope','$http','$stateParams',function($scope,$http,$stateParams){
   window.datascope = $scope;
   $http({
     method:'post',
     url:'/stackoverflowlite/index.php/Quesdetail',
     data: {qid: $stateParams.qid}
   }).then(function(response){
     console.log("js");
     $scope.content=response.data;
     console.log(response.data);
     $scope.checkreportedQues($stateParams.qid,'2');
     var_dump(response.data[1]);
     // angular.forEach( response.data[1], function(v,k){
     //   var_dump(v);
     //    $scope.checkreportedAns(v['ansId'],'2');
     // });

   });


   $scope.checkreportedQues=function(param,reporterId){
     $http({
          method: "POST",
          url: "http://localhost/stackoverflowlite/index.php/Report/checkreportedQues",
          dataType: 'json',
          data: {quesId: param, reportedId: reporterId},
          headers: { "Content-Type": "application/json" }
     }).then(function successCallBack(response){
       $scope.reportedques=response.data;
       if ($scope.reportedques!=0) {
         $scope.report = {
              "color": "red",
         };
       } else {
         $scope.report = {
              "color": "grey",
         };
       }
     });
   };
   $scope.reportQues=function(param,reporterId){
     if($scope.reportedques!=0){
       $http({
            method: "POST",
            url: "http://localhost/stackoverflowlite/index.php/Report/delete_report_ques",
            dataType: 'json',
            data: {quesId: param, reportedId: reporterId},
            headers: { "Content-Type": "application/json" }
       }).then(function successCallBack(response){
         console.log("Report Deleted");
         $scope.checkreportedQues($stateParams.qid,reporterId);
       });
     }
     else {
       $http({
            method: "POST",
            url: "http://localhost/stackoverflowlite/index.php/Report/insert_report_ques",
            dataType: 'json',
            data: {quesId: param, reportedId: reporterId},
            headers: { "Content-Type": "application/json" }
       }).then(function successCallBack(response){
         $scope.checkreportedQues($stateParams.qid,reporterId);
       });
     }
   };

   $scope.checkreportedAns=function(param,reporterId){
     $http({
          method: "POST",
          url: "http://localhost/stackoverflowlite/index.php/Report/checkreportedAns",
          dataType: 'json',
          data: {ansId: param, reportedId: reporterId},
          headers: { "Content-Type": "application/json" }
     }).then(function successCallBack(response){
       console.log("Checked Ans");
       console.log(response.data);
       $scope.reportedans=response.data;
     });
   };
   $scope.reportAns=function(param,reporterId){
     $scope.checkreportedAns(param,reporterId);
     console.log(param);
     console.log(reporterId);
     //$scope.report
     console.log($scope.reportedans);
     //id='reportans-'+param;
     if($scope.reportedans!=0){
       // $scope.id.reportAnsstyle = {
       //      "color": "grey",
       // };
       angular.element('#reportans-'+param).css('color', 'grey');
       $http({
            method: "POST",
            url: "http://localhost/stackoverflowlite/index.php/Report/delete_report_ans",
            dataType: 'json',
            data: {ansId: param, reportedId: reporterId},
            headers: { "Content-Type": "application/json" }
       }).then(function successCallBack(response){
         console.log("Report Deleted");
         //$scope.reportedans=0;
            //$scope.checkReportUser();
       });
     }
     else {
       angular.element(document.querySelector('#reportans-'+param)).css('color', 'red');
       // $scope.id.reportAnsstyle = {
       //      "color": "red",
       // };
       //console.log("CSS");


       $http({
            method: "POST",
            url: "http://localhost/stackoverflowlite/index.php/Report/insert_report_ans",
            dataType: 'json',
            data: {ansId: param, reportedId: reporterId},
            headers: { "Content-Type": "application/json" }
       }).then(function successCallBack(response){
         console.log("Reported");
         //$scope.reportedans=0;
            //$scope.checkReportUser();
       });
     }
   };
 }]);

 routeApp.controller('tagCtrl',['$scope','$http',function($scope,$http){
   $http({
    method: 'get',
    url: '/stackoverflowlite/index.php/Tagpage/returnalltags'
   }).then(function successCallback(response) {
     // Assign response to users object
     console.log("Tag page");
     $scope.content = response.data;
   });
 }]);

 routeApp.controller('samp',['$scope','$http','$stateParams','$state',function($scope,$http,$stateParams,$state){
   console.log("Ctrl_samp");
   console.log($stateParams);
   console.log($state);
   if($state.current.name=="views"){
     $http({
       method: 'post',
       url: '/stackoverflowlite/index.php/Quesview/returnquesbyviews',
     }).then( function(response){
       console.log(response);
         $scope.content = response.data;
     });
   }
   else if($state.current.name=="votes"){
     $http({
       method: 'post',
       url: '/stackoverflowlite/index.php/Quesview/returnquesbyvote',
     }).then( function(response){
         $scope.content = response.data;
     });
   }
   else{
     $scope.tname=$stateParams.tname;
    $http({
      method: 'post',
      url: '/stackoverflowlite/index.php/Quesview/returnquesbytag',
      data: {p: $stateParams.tname}
    }).then( function(response){
      console.log(response);
        $scope.content = response.data;
    });
   }
}]);
routeApp.controller('sbCtrl',['$scope','$http','$stateParams','$state', function($scope,$http,$stateParams,$state){
  $http({
   method: 'get',
   url: '/stackoverflowlite/index.php/Sidebar/dataresp'
  }).then(function successCallback(response) {
    $scope.content1 = response.data;
  });
  $scope.sortfunction=function(param){
    console.log(param);
    if (param=='views') {
      $state.go('views');
    } else if(param=='votes'){
      $state.go('votes');
    }else{
      $state.go('qlist');
    }
  };
}]);

routeApp.controller('quesCtrl',['$scope','$http','$stateParams', function($scope,$http,$stateParams){
  $http({
   method: 'get',
   url: '/stackoverflowlite/index.php/Quesview/returnallques'
  }).then(function successCallback(response) {
    $scope.content = response.data;
    $scope.incviews=function(par){
    $http({
      method: 'post',
      url: '/stackoverflowlite/index.php/Quesview/updateview',
      data: JSON.stringify({p: par})
    }).then( function(response){
        console.log(data);
    });
  };

});
}]);
