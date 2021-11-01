<?php


class UserRepository {
    
    public $dbInstance;
    
    public function __construct($dbInstance)
    {
        $this->dbInstance = $dbInstance;
    }
    
    public function login($username, $password){
        $prepStmtQuery = "SELECT id FROM users WHERE username = ? AND password = md5(?)";
        $formatData = "ss";
        $returnResultFlag = true;
        $data = [$username, $password];
        return $this->dbInstance->executeQuery(
            $prepStmtQuery, 
            $formatData, 
            $returnResultFlag, 
            ...$data
        );
    }

}