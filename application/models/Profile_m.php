<?php
	defined('BASEPATH') or exit('Error');

	class Profile_m extends CI_Controller {
          function __construct() {
               parent::__construct();     
          }

          function get_user_details() {
               return $this->db->select('*')
                              ->where('userId',2)
                              ->get('tbluser')
                              ->result();
          }

          function update_user_details($user) {
              $this->db->where('userId',2)
                         ->update('tbluser',$user); 
          }
     }
?>