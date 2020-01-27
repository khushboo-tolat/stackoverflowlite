<?php
	defined('BASEPATH') or exit('Error');

	class Report extends CI_Controller {
          function __construct() {
               parent::__construct();     
               $this->load->model("Report_m");
          }

          function checkReportedUser() {
               $request = json_decode(file_get_contents('php://input'), TRUE);
               
               $report = [
                    'userId' => $request['userId'],
                    'reportedId' => 2
               ];

               $response = $this->Report_m->check_report_details($report);
               echo $response;
          }

          function insert_report_user() {
               $request = json_decode(file_get_contents('php://input'), TRUE);
               
               $report=[
                    "userId" => $request["userId"],
                    "reportedId" => 2
               ];

               $this->Report_m->insert_report_details($report);
          }

          function delete_report_user() {
               $request = json_decode(file_get_contents('php://input'), TRUE);
               
               $report=[
                    "userId" => $request["userId"],
                    "reportedId" => 2
               ];

               $this->Report_m->delete_report_details($report);
          }
     }
?>