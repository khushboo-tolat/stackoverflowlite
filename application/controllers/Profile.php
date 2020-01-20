<?php
	defined('BASEPATH') or exit('Error');

	class Profile extends CI_Controller {
          function __construct() {
               parent::__construct();     
               $this->load->model("Profile_m");
          }

          function get_user() {
               $user = $this->Profile_m->get_user_details();
               echo json_encode($user);
          }

          function update_user() {
               $request = json_decode(file_get_contents('php://input'), TRUE);

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
               // echo "<pre>";
               // print_r($ques);
               echo json_encode($ques);
          }

          function get_ans() {
               $ans = $this->Profile_m->get_ans_details();
               echo json_encode($ans);
          }

          function get_vote() {
               $vote = $this->Profile_m->get_vote_details();
               echo json_encode($vote);     
          }

          function get_comment() {
               $comment = $this->Profile_m->get_comment_details();
               echo json_encode($comment);     
          }
     }
?>