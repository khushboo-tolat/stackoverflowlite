<?php
	defined('BASEPATH') or exit('Error');

	class Profile_m extends CI_Controller {
          function __construct() {
               parent::__construct();     
          }

          function get_user_details() {
               return $this->db->select('*')
                              ->where('userId',1)
                              ->get('tbluser')
                              ->result();
          }

          function update_user_details($user) {
              $this->db->where('userId',1)
                         ->update('tbluser',$user); 
          }

          function get_ques_details() {
               return $this->db->where('userId',1)
                         ->get('tblquestion')
                         ->result();
          }

          function get_ans_details() {
               return $this->db->where('userId',1)
                         ->get('tblanswer');     
          }

          function get_vote_details() {
               return $this->db->where('userId',1)
                         ->get('tblvote');     
          }

          function get_comment_details() {
               return $this->db->where('userId',1)
                         ->get('tblquestion');     
          }
     }
?>