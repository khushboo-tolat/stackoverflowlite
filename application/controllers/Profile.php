<?php
	defined('BASEPATH') or exit('Error');

	class Profile extends CI_Controller {
          function __construct() {
               parent::__construct();     
               $this->load->model("Profile_m");
               $this->load->library('form_validation');
          }

          function get_user() {
               $id = json_decode(file_get_contents('php://input'), TRUE);

               if($id['userId']==''){
                    $user = $this->Profile_m->get_user_details(29);
               }
               else{
               $user = $this->Profile_m->get_user_details($id['userId']);
               }
               echo json_encode($user);
          }

          function update_user() {
               $request = json_decode(file_get_contents('php://input'), TRUE);

               // $this->form_validation->set_rules($request["fullname"],'Full Name','trim|required|max_length[25]|min_length[5]|alpha_numeric_spaces');
               // $this->form_validation->set_rules($request["username"],'User Name','trim|required|max_length[25]|min_length[5]|alpha_numeric_spaces|is_unique[tbluser.userName]');
               // $this->form_validation->set_rules($request["company"],'Company','trim|min_length[5]');
               // $this->form_validation->set_rules($request["desg"],'Designation','trim|min_length[5]');

               $user=[
                    "fullName" => $request["fullname"],
                    "userName" => $request["username"],
                    "company" => $request["company"],
                    "designation" => $request["desg"]
               ];
               $this->Profile_m->update_user_details($user);
          }

          function get_ques() {
               $ques = $this->Profile_m->get_ques_details();

               for($i = 0; $i < count($ques); $i++){ 
                    $ques[$i]['ans_cnt'] = $this->Profile_m->get_ans_cnt($ques[$i]['quesId']);
                    $ques[$i]['vote_cnt'] = $this->Profile_m->get_vote_cnt($ques[$i]['quesId'], 1);
                    $ques[$i]['tags'] = $this->Profile_m->get_tags($ques[$i]['quesId']);
               }

               echo json_encode($ques);
          }

          function get_ans() {
               $ans = $this->Profile_m->get_ans_details();

               for($i = 0; $i < count($ans); $i++){
                    $ans[$i]['vote_cnt'] = $this->Profile_m->get_vote_cnt($ans[$i]['ansId'], 0);
                    $ans[$i]['title'] = $this->Profile_m->get_ans_ques($ans[$i]['ansId']);
                    $ans[$i]['ques'] = $ans[$i]['title'][0]['title'];
               }

               echo json_encode($ans);
          }

          function get_comment() {
               $comment = $this->Profile_m->get_comment_details();

               for($i = 0; $i < count($comment); $i++){
                    if($comment[$i]['ansId'] == NULL){
                         $comment[$i]["type"] = "Question";
                    }
                    elseif($comment[$i]['quesId'] == NULL){
                         $comment[$i]["title"] = $comment[$i]["answer"];
                         $comment[$i]["type"] = "Answer";
                    }
               }

               echo json_encode($comment);     
          }
          function profileUpload(){
               $data=json_decode(file_get_contents("php://input"),true);
               
               if(!empty($_FILES)){
                    if($_FILES["file"]["type"] == "image/png" || $_FILES["file"]["type"] == "image/jpg" || $_FILES["file"]["type"] == "image/gif" || $_FILES["file"]["type"] == "image/jpeg"){
                         if(!$_FILES["file"]["error"] > 0){              
                              // sprintf('<img src="data:image/png;base64,%s" />', base64_encode($_FILES["file"]["tmp_name"]));     
                              echo $_FILES["file"]["tmp_name"];   die();
                              $this->Profile_m->uploadProfile($_FILES["file"]["tmp_name"]);
                         }
                    }
               }
          }

          function getProfile(){
               $this->Profile_m->get_profile();
          }
     }
?>