<?php
	defined('BASEPATH') or exit('Error');

	class Report_m extends CI_Model {
          function __construct() {
               parent::__construct();     
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
     }
?>