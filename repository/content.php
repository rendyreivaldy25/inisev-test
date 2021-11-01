<?php

class ContentRepository {
    
    public $dbInstance;
    
    public function __construct($dbInstance)
    {
        $this->dbInstance = $dbInstance;
    }
    
    public function getContent(){
        $prepStmtQuery = "SELECT content FROM stories order by id DESC limit 1";
        $formatData = "";
        $returnResultFlag = true;
        $data = [];
        return $this->dbInstance->executeQuery(
            $prepStmtQuery, 
            $formatData, 
            $returnResultFlag, 
            ...$data
        );
    }
    
    public function saveContent($content){
        $prepStmtQuery = "INSERT INTO stories (content) VALUES (?)";
        $formatData = "s";
        $returnResultFlag = false;
        $data = [$content];
        return $this->dbInstance->executeQuery(
            $prepStmtQuery, 
            $formatData, 
            $returnResultFlag, 
            ...$data
        );
    }

}