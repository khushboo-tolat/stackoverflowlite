<?php
	defined('BASEPATH') or exit('Error');

	class Profile_m extends CI_Model {
          function __construct() {
               parent::__construct();     
          }


          function get_user_details($id) {
               return $this->db->select('*')
                              ->where('userId',$id)
/*=======
          function get_user_details() {
               return $this->db->select('userId,userName,fullName,email,company,designation')
                              ->where('userId',26)
>>>>>>> 310064dcd47d10d20d9a39af706158ee0b57543b*/
                              ->get('tbluser')
                              ->result_array();

          }

          function get_profile(){
               var_dump($this->db->select('photo')->where('userId',29)->get('tbluser')->result_array());
          }
          
          function update_user_details($user) {
              $this->db->where('userId',26)
                         ->update('tbluser',$user); 
          }

          function check_report_details($report) {
               $this->db->where($report);
		     $user=$this->db->get('tblreport');
		
		     return $user->num_rows();
          }

          function insert_report_details($report) {
               $this->db->insert('tblreport', $report);
          }

          function delete_report_details($report) {
               $this->db->where($report)
                         ->delete('tblreport');
          }

          function get_ques_details() {
               return $this->db->where('userId',26)
                         ->get('tblquestion')
                         ->result_array();
          }

          function get_ans_cnt($qId) {
               $data = $this->db->select('*')
                              ->where('quesId',$qId)
                              ->get('tblanswer');

               return $data->num_rows();
          }

          function get_vote_cnt($Id, $temp){
               $where = [];
               if($temp){
                    $where =[
                         'quesId' => $Id
                    ];
               }
               else{
                    $where =[
                         'ansId' => $Id
                    ]; 
               }

               $vote = $this->db->select('vote')
                         ->where($where)
                         ->get('tblvoting')
                         ->result_array();     

               $up = 0;
               $down = 0;

               for($i = 0; $i < count($vote); $i++){
                    if($vote[$i]['vote'] == 1){
                         $data = $this->db->select('*')
                                   ->where($where)
                                   ->where('vote',26)
                                   ->get('tblvoting');
                         $up = $data->num_rows();
                    }
                    else{
                         $data = $this->db->select('*')
                                   ->where($where)
                                   ->where('vote',0)
                                   ->get('tblvoting');

                         $down = $data->num_rows();
                    }
               }
               return $up - $down;
          }

          function get_tags($qId) {
               return $this->db->from('tbltag t')
                              ->select('*')
                              ->join('tblquestag qt','t.tagId = qt.tagId')
                              ->where('qt.quesId',$qId)
                              ->get()
                              ->result_array();
          }

          function get_ans_details() {
               return $this->db->where('userId',26)
                         ->get('tblanswer')
                         ->result_array();     
          }

          function get_ans_ques($aId) {
               return $this->db->from('tblquestion q')
                              ->select('q.title')
                              ->join('tblanswer a','q.quesId = a.quesId')
                              ->where('a.ansId',$aId)
                              ->get()
                              ->result_array();
          }

          function get_comment_details() {
               $temp = $this->db->where('userId',26)
                         ->get('tblcomment')
                         ->result_array(); 

               for($i = 0; $i < count($temp); $i++){
                    if($temp[$i]['ansId'] == NULL){
                         $commentQ = $this->db->from('tblquestion q')
                                        ->select('c.description, c.updatedTime, c.quesId, c.ansId, q.title')
                                        ->join('tblcomment c','q.quesId = c.quesId')
                                        ->where('c.userId',26)
                                        ->get()
                                        ->result_array(); 
                    }
                    elseif($temp[$i]['quesId'] == NULL){
                         $commentA = $this->db->from('tblanswer a')
                                        ->select('c.description, c.updatedTime, c.quesId, c.ansId, a.answer')
                                        ->join('tblcomment c','a.ansId = c.ansId')
                                        ->where('c.userId',26)
                                        ->get()
                                        ->result_array(); 
                    }
               }
               $comment = array_merge($commentQ, $commentA);

               return $comment;
          }

          
          function uploadProfile($data){

                    $this->db->where('userId',26);
               $this->db->update('tbluser', array('photo' =>file_get_contents($data)));

          }
     }
?>