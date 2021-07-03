<?php 

    //Class to create connections to databases
    class database{

        //initializing the database credentials
        private $host;
        private $dbUserName;
        private $dbPassword;
        private $dbName;

        //protected connect function to connect to the databse
        protected function connect(){
            $this->host = "localhost";
            $this->dbUserName = "root";
            $this->dbPassword = "";
            $this->dbName = "AstromancyVedic";

            try{
                $conn = new PDO("mysql:host=$this->host;dbname=$this->dbName", $this->dbUserName, 
                $this->dbPassword);
            }catch(PDOException $e){

                die($e->getMessage());
        
            }
            return $conn;
        }

    }

    //CRUD contains all functions to create/Read/update/delete
    class query extends database{

        //initializing the connection
        protected $conn;

        function __construct(){
            $this->conn = $this->connect();
        }

        //function to prepare and run the QUERY
        public function prep_and_run($query){
            $query = $this->conn->prepare($query);
            try{
                $query->execute();
                $result = $query->fetchAll();
            }
            catch(PDOException $e){
                die($e->getMessage());
            }
            return $result;

        }

        //Function to get data(all parametrized)
        //SELECT $field FROM $table where $condition $order_by_field $order_by_type $limit 
        public function getData($table, $field = "*", $condition = array(), $order_by_field = "", $order_by_type = "DESC", $limit = ""){

            $query = "SELECT $field FROM $table";

            if($condition != []){

                $query .= " WHERE ";
                $count = count($condition);
                $i = 0;
                foreach($condition as $k=>$v){

                    if($count-1 != $i){
                        $query .= "$k='$v' and ";
                    }
                    else{
                        $query .= "$k='$v' ";
                    }
                    $i++;    
                }  
            }

            if($order_by_field != ""){
                $query .= "ORDER BY " . $order_by_field . " " . $order_by_type;
            }
            
            if($limit != ""){
                $query .= " LIMIT " . $limit;
            }
            $result = $this->prep_and_run($query);
            print_r($result);
        }

        //function to delete data
        //DELETE FROM $table WHERE $condition
        public function deleteData($table, $condition = array()){

            $query = "DELETE FROM $table";
            
            if($condition != []){

                $query .= " WHERE ";
                $count = count($condition);
                $i = 0;
                foreach($condition as $k=>$v){

                    if($count-1 != $i){
                        $query .= "$k='$v' and ";
                    }
                    else{
                        $query .= "$k='$v' ";
                    }
                    $i++;    
                }  
            }

            $result = $this->prep_and_run($query);
            print_r($result);
        }

        public function addData($table, $values){

            $valArr = array();
            $feildArr = array();
            
            foreach($values as $k=>$v){
                $valArr[] = $v;
                $feildArr[] = $k;
            }
            $value = implode("','", $valArr);
            $value = "'" . $value . "'";
            $fields = implode(",", $feildArr);
            $query = "INSERT INTO $table ($fields) VALUES ($value)";

            $result = $this->prep_and_run($query);
            print_r($result);;
        }

    }






?>