<?php

class UserService {
    
    public $repoInstance;
    public $taskInstance;
    
    public function __construct($repoInstance)
    {
        $this->repoInstance = $repoInstance;
    }
    
    public function login($data){
        $username = $data['username'];
        $password = $data['password'];
        $loginCheck = $this->repoInstance->login($username, $password);
        if(count($loginCheck) > 0 ){
            $response = array(
                "status" => true
            );
        } else {
            $response = array(
                "status" => false,
                "message" => "Login Failed"
            );
        }
        return $response;
    }
}
