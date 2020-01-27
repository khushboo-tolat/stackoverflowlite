<?php
 defined('BASEPATH') or exit("Path not set");

 class indexController extends CI_Controller{
     
    public function  __construct(){
        parent::__construct();
        $this->load->model('regModel');
        $this->load->model('logModel');
        $this->load->model('Profile_m');
        //$this->load->model('PostQue_m');
    }

    public function login(){
        //$this->session->sess_destroy();
        $data=json_decode(file_get_contents("php://input"),true);
        $response=$this->logModel->getPassword($data);
        if(!empty($response)){
            $passwd=$response[0]["password"];     
            
            if($this->encrypt->sha1($data["password"]) == $passwd)
            {
                $this->session->set_userdata('userid',$response[0]["userId"]);
                echo $this->session->userdata('userid');
            }
            else {
                echo "fail";
            }
        }
    }

    function checkSession() {
        //$this->session->set_userdata('userid', 1);
        if($this->session->userdata('userid')) {
            echo "true";
        }
        else{
            echo "false";
        }
    }
    
    public function test()
    {
        // $this->session->sess_destroy();
        $data=json_decode(file_get_contents("php://input"),true);
        // $this->session->set_userdata('test','test1');
        var_dump($this->session->all_userdata());
    }

    public function forgotPassword(){
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

     public function insert(){
        
        $request=json_decode(file_get_contents('php://input'),true);
          $title = $request["Title"];
          $body = $request["Body"];
          $tags = $request["Tags"];
         /* if(empty($title) || empty($body))
          {
               echo json_encode(array('success'=>'0'));
               exit();
          }*/
        $data=[
                "title"=>$title,
                "body"=>$body,
                "tag"=>$tags
        ];
        var_dump($data);
        if(!empty($data))
            $this->PostQue_m->insert_data($data);
    }
}
?>