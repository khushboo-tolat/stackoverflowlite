<?php
	defined('BASEPATH') or exit('Error');

	class Profile extends CI_Controller {
          function __construct() {
               parent::__construct();     
               $this->load->model("Profile_m");
               $this->load->library('form_validation');
          }

          function get_user() {
               $user = $this->Profile_m->get_user_details();
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

          function checkReportedUser() {
               $request = json_decode(file_get_contents('php://input'), TRUE);
               
               $report = [
                    'userId' => $request['userId'],
                    'reportedId' => $request['reportedId']
               ];

               $response = $this->Profile_m->check_report_details($report);
               echo $response;
          }

          function insert_report_user() {
               $request = json_decode(file_get_contents('php://input'), TRUE);
               
               $report=[
                    "userId" => $request["userId"],
                    "reportedId" => $request["reportedId"],
               ];

               $this->Profile_m->insert_report_details($report);
          }

          function delete_report_user() {
               $request = json_decode(file_get_contents('php://input'), TRUE);
               
               $report=[
                    "userId" => $request["userId"],
                    "reportedId" => $request["reportedId"],
               ];

               $this->Profile_m->delete_report_details($report);
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
     }
?>