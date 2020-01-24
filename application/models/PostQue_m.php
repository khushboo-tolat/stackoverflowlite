<?php
defined('BASEPATH') or exit('Error');

class PostQue_m extends CI_Model {
  	function __construct(){
      parent::__construct();
    }
    
    public function insert_data($data){


          //get user id
         // $uid=getuserId();
          $uid=26;
          //insert question
          $query=[
               'title'=>$data['title'],
               'question'=>$data['body'],
               'userId'=>$uid
          ];
          var_dump($query);
          $this->db->insert("tblquestion",$query);
          $queId=$this->db->insert_id();
          
          //(insert tags) and (link que & tags) 
          $tags=$data['tag'];
          
          $arr = explode(',', $tags);
          for($i = 0; $i < count($arr); $i++)
          {
            $t = ['tagName'   => $arr[$i] ];
            
                       
            $this->db->where('tagName',$t['tagName']);
            $isAvailTag=$this->db->get('tbltag')->result_array();
            //var_dump($result[0]["tagId"]);
            if($isAvailTag){
               $qt=[
                    'quesId'=> $queId,
                    'tagId'  => $isAvailTag[0]['tagId']
               ];
                $this->db->insert("tblquestag",$qt);
            }
            else
            {
               $this->db->insert("tbltag",$t);
            
               $tagId=$this->db->insert_id();
                $qt=[
                    'quesId'=>$queId,
                    'tagId'  =>$tagId
               ];
                $this->db->insert("tblquestag",$qt);

             }  
          }



     }

    /* public function get_userId(){
          $id=$this->db->select('userId')->from('tbluser')->where('email',)->get();
          return $id->result(); 
     }*/
}


?>