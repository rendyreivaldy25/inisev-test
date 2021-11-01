<?php

    class Connection {

        public $conn;

        public function __construct($dbHost, $dbUsername, $dbPassword, $dbName)
        {
            $this->conn = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);
        }

        public function connectionCheck(){
            if (!$this->conn){
                $message = "Connection to MySQL Failed : ".mysqli_connect_error();
                return array(
                    "status" => false,
                    "message" => $message
                );
            } else {
                return array(
                    "status" => true
                );
            }
        }

        public function closeConnection(){
            mysqli_close($this->conn);
        }

        /*
            param :
            - $prepStmtQuery => string prepared statementnya
                i.e "SELECT * FROM users WHERE id=?"
            - $formatData => format prepared Statemnt Variablenya
                i.e "sss"
            - $returnResultFlag => true -> balikin data, false -> ga balikin data
            - $...data => data2 variable yang akan dipake di prepared statementnya (dalam bentuk array)
                i.e ...['test', 'test'] -> notice the 3 dots in the front
            
            notes :
            Format data -> The argument may be one of four types :
            i - integer
            d - double
            s - string
        */
        public function executeQuery($prepStmtQuery, $formatData, $returnResultFlag, ...$data){
            $stmt = $this->conn->prepare($prepStmtQuery);
            if(count($data) > 0){
                $stmt->bind_param($formatData, ...$data);
            }
            $stmt->execute();
            if($returnResultFlag){
                $result = $stmt->get_result();
                return $result->fetch_all(MYSQLI_ASSOC);
            }
        }

    }