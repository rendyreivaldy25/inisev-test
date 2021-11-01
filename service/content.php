<?php

class ContentService {
    
    public $repoInstance;
    public $taskInstance;
    
    public function __construct($repoInstance)
    {
        $this->repoInstance = $repoInstance;
    }
    
    public function getContent(){
        return $this->repoInstance->getContent();
    }
    
    public function saveContent($content){
        $contentData = $content['story'];
        return $this->repoInstance->saveContent($contentData);
    }
}
