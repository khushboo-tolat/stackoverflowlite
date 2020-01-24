var profile = angular.module('routeApp');

profile.controller('headerCtrl',function($scope,$http){
     $scope.islogIn = true;
     /* $http({

          url:'http://localhost/stackoverflowlite/index.php/Timeline/get_session'
      }).then({
          
      });*/
      
    

});

profile.controller('profileCtrl', ['$scope', '$http', function ($scope, $http) {

     var profile= document.getElementById("profile");
       var upload=document.getElementById("imageupload") ;
       profile.onclick = function(){
            upload.click();
       };
       $scope.form=[];
       $scope.files=[];
     
      $scope.uploadedFile=function(element){
          $scope.currentFile = element.files[0];
          var rander=new FileReader();

          rander.onload=function(event){
            profile.src=URL.createObjectURL(element.files[0]);

            $scope.image_source=event.target.result
            $scope.$apply(function($scope){
              $scope.files=element.files;
            })
          }
          rander.readAsDataURL(element.files[0]);

          $scope.imageupload=element.files[0];
          console.log($scope.imageupload);
          var fd = new FormData();
           fd.append('file', element.files[0]);
           fd.append('name', $scope.imageupload.name);
           $http.post("http://localhost/stackoverflowlite/index.php/Profile/profileUpload", fd, {
               transformRequest: angular.identity,
               headers: {'Content-Type': undefined,'Process-Data': false}
           })
           .success(function(data){
              console.log("Success",data);
           })
           .error(function(data){
              console.log("error",data);
           });
          return;
          
        };


        $scope.getProfile=function(){
         $http({
            method:'GET',
            url : 'http://localhost/stackoverflowlite/index.php/Profile/getProfile',
            responseType : 'arraybuffer',
         }).then(function(response){
              console.log(response);
              // $scope.info={};
              str= _arrayBufferToBase64(response.data);
              console.log(str);
              // console.log("adbasbdkjsab");
            },function(response){
              console.error('error in getting static img.');
          });
      }

      function _arrayBufferToBase64(buffer){
        var binary='';
        var bytes=new Uint8Array(buffer);
        var len= bytes.byteLength;
        for(var i=0 ; i<len ; i++ ){
            binary +=String.fromCharCode(bytes[i]);
        }

        return window.btoa(binary)
      }
      $scope.getProfile();

     $scope.user = {};
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
			url: 'http://localhost/stackoverflowlite/index.php/Profile/checkReportedUser',
			data:{userId: $scope.user.userId, reportedId: 2},
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

     $scope.reportUser = function(userId, reporterId) {
          if($scope.checkReportedUser > 0) {
               $http({
                    method: "POST",
                    url: "http://localhost/stackoverflowlite/index.php/Profile/delete_report_user",
                    dataType: 'json',
                    data: {userId: userId, reportedId: reporterId},
                    headers: { "Content-Type": "application/json" }
               }).then(function successCallBack(response){
                    $scope.checkReportUser();  
               });
          }
          else {
               $http({
                    method: "POST",
                    url: "http://localhost/stackoverflowlite/index.php/Profile/insert_report_user",
                    dataType: 'json',
                    data: {userId: userId, reportedId: reporterId},
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

// Code for Question upload Page

profile.controller('postquesCtrl', ['$scope', '$http', function($scope,$http){
     //window.daatat =$scope;
// console.log("asbhdhsaaskbakjba,bjacsj,asjc");
  // $scope.title;
  // $scope.bodies;
  //$scope.error="";
  //function
  $scope.info = {val:true};
   $scope.post=function(){
  if(!$scope.bodies){
    $scope.error = "description is required";
  }
  else{
    $http({
      method:'post',
      url:'http://localhost/stackoverflowlite/index.php/indexController/insert',
      datatype:'json',
      data:{Title:$scope.title,Body:$scope.bodies,Tags:$scope.tag}
  
    }).then(function(res){
      console.log(res.data);
    });
  }
};

}]);

profile.directive('ckEditor', function() {
  return {
    require: '?ngModel',
    link: function(scope, elm, attr, ngModel) {
      var ck = CKEDITOR.replace(elm[0]);

      if (!ngModel) return;

      ck.on('pasteState', function() {
        scope.$apply(function() {
          ngModel.$setViewValue(ck.getData());
        });
      });

      ngModel.$render = function(value) {
        ck.setData(ngModel.$viewValue);
      };
    }
  };
});


// Question view page

profile.controller("comments",['$scope','$window','$http',function($scope,$window,$http){

  $scope.Qcmt=false;

  $scope.show=function(){
    if($scope.Qcmt)
      $scope.Qcmt=false;
    else
      $scope.Qcmt=true;
  }
}]);



