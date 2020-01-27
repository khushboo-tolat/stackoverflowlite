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
                    'reportedId' => 29
               ];

               $response = $this->Report_m->check_report_details($report);
               echo $response;
          }

          function insert_report_user() {
               $request = json_decode(file_get_contents('php://input'), TRUE);

               $report=[
                    "userId" => $request["userId"],
                    "reportedId" => 29
               ];

               $this->Report_m->insert_report_details($report);
          }

          function delete_report_user() {
               $request = json_decode(file_get_contents('php://input'), TRUE);

               $report=[
                    "userId" => $request["userId"],
                    "reportedId" => 29
               ];

               $this->Report_m->delete_report_details($report);
          }

          function insert_report_ques()
          {
               $r= json_decode(file_get_contents("php://input"),TRUE);
               $report=[
                    "reportedId" => $r["reportedId"],
                    "quesId"=> $r["quesId"]
               ];
               $this->Report_m->insert_report_details($report);
          }

          function delete_report_ques(){
               $r= json_decode(file_get_contents("php://input"),TRUE);

               $report=[
                    "reportedId" => $r["reportedId"],
                    "quesId"=> $r["quesId"]
               ];
               //var_dump($r);
               $this->Report_m->delete_report_details($report);
          }

          function checkreportedQues()
          {
               $r= json_decode(file_get_contents("php://input"),TRUE);
               //var_dump($r);
               $report=[
                    "reportedId" => $r["reportedId"],
                    "quesId"=> $r["quesId"]
               ];
               echo $this->Report_m->check_report_details($report);
          }

          function insert_report_ans()
          {
               $r= json_decode(file_get_contents("php://input"),TRUE);
               $report=[
                    "reportedId" => $r["reportedId"],
                    "ansId"=> $r["ansId"]
               ];
               $this->Report_m->insert_report_details($report);
          }
          function delete_report_ans(){
               $r= json_decode(file_get_contents("php://input"),TRUE);
               $report=[
                    "reportedId" => $r["reportedId"],
                    "ansId"=> $r["ansId"]
               ];
               $this->Report_m->delete_report_details($report);
          }
          function checkreportedAns()
          {
               $r= json_decode(file_get_contents("php://input"),TRUE);
               $report=[
                    "reportedId" => $r["reportedId"],
                    "ansId"=> $r["ansId"]
               ];
               echo $this->Report_m->check_report_details($report);
          }
     }
?>
