<?php
 defined('BASEPATH') or exit("Path not set");

 class IndexController extends CI_Controller{
     
    public function  __construct(){
        parent::__construct();
        $this->load->model('regModel');
        //$this->load->model('logModel');
        
    }

    public function Login(){
        $data=json_decode(file_get_contents("php://input"),true);

        $response=$this->logModel->getPassword($data);

        if(!empty($response)){
            $passwd=$response[0]["password"];     
            
            if($this->encrypt->sha1($data["password"]) == $passwd)
            {
                echo "success";
                $this->session->set_userdata('userid',$response[0]["userId"]);
                echo $this->session->userdata('userid');
                // $this->load->helper('url');
                // redirect(base_url('index.php/IndexController/profile'));
            }
        }
    }

    public function forgotpassword(){
        echo "reached at forgot password page";
    }


    public function checkUsername(){
        $data = json_decode(file_get_contents("php://input"),true);
        
        $username = $data["username"];

        $response = $this->regModel->checkUsername($username);

        echo $response;
    }

    public function checkEmail(){
        $data = json_decode(file_get_contents("php://input"),true);

        $email=$data["email"];

        $response=$this->regModel->checkEmail($email);

        echo $response;
    }
    
    public function register(){
        
            $request = json_decode(file_get_contents("php://input"),TRUE);

            $user=[
                "userName" => $request["username"],
                "fullName" => $request["fullname"],
                "email" => $request["email"],
                "password" => $this->encrypt->sha1($request["password"])
            ];
       
            $this->regModel->reg_form($user);
    }
 }
?>