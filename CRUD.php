<?php 

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
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
        public function getData($table, $field = "*", $conditions = array(), $order_by_field = "", $order_by_type = "DESC", $limit = ""){

            $query = "SELECT $field FROM $table";

            if($conditions != []){

                $query .= " WHERE ";
                $count = count($conditions);
                $i = 0;
                foreach($conditions as $k=>$v){

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
            return $result;
        }

        //function to delete data
        //DELETE FROM $table WHERE $condition
        public function deleteData($table, $conditions = array()){

            $query = "DELETE FROM $table";
            
            if($conditions != []){

                $query .= " WHERE ";
                $count = count($conditions);
                $i = 0;
                foreach($conditions as $k=>$v){

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
            return $result;
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
            return $result;

        }

        //Function to Update Data
        //UPDATE $table SET $values[$K]=$values[$v] WHERE $conditions 
        function updateData($table, $values, $conditions){

            $query = "UPDATE $table SET ";
            $count = count($values);
            $i = 0;
            foreach($values as $k=>$v){

                if($count-1 != $i){
                    $query .= "$k='$v',";
                }
                else{
                    $query .= "$k='$v' ";
                }
                $i++;    
            }
            $query .= " WHERE ";
            $count = count($conditions);
            $i = 0;
            foreach($conditions as $k=>$v){

                if($count-1 != $i){
                    $query .= "$k='$v' and ";
                }
                else{
                    $query .= "$k='$v' ";
                }
                $i++;    
            } 
            $result = $this->prep_and_run($query);
            return $result;

        }

    }

    class make{

        protected function makeLabel($label, $labelAttr = array()){

            $labelScript = "";
            if($label){
                $labelScript .= "<label "; 
                foreach($labelAttr as $k=>$v){
                    $labelScript .= "$k = '$v' ";
                }
                $labelScript .= ">$label</label>\n";
            }
            
            return $labelScript;
            
            
        }

        protected function makeField($type, $fieldAttr = array()){

            $fieldScript = "<input type = '$type' ";
            foreach($fieldAttr as $k=>$v){
                $fieldScript .= "$k = '$v' ";
            }
            $fieldScript .= ">\n";
            return $fieldScript;

        }

    }

    class textField extends make{

        public $script;
        protected $fieldName;

        function __construct($fieldAttr = array(), $label = "", $labelAttr = array()){
            
            $labelScript = $this->makeLabel($label, $labelAttr);
            $fieldScript = $this->makeField("text", $fieldAttr);
            $this->fieldName = $fieldAttr["name"]; 
            $this->script = array("labelScript"=>$labelScript, "fieldScript"=>$fieldScript);
                
        }
        
        public function validated(){

            $data = $_POST[$this->fieldName];
            $pattern = "/^[a-zA-Z0-9]*$/";
            if(!preg_match($pattern, $data)){
                $_POST[$this->fieldName] = "data is Currupted...";
                return false;
            }
            return true;
            
        }

        public function getFieldName(){
            return $this->fieldName;
        }

    }

    class passwordField extends make{

        public $script;
        protected $fieldName;

        function __construct($fieldAttr = array(), $label = "", $labelAttr = array()){
            
            $labelScript = $this->makeLabel($label, $labelAttr);
            $fieldScript = $this->makeField("password", $fieldAttr);
            $this->fieldName = $fieldAttr["name"]; 
            $this->script = array("labelScript"=>$labelScript, "fieldScript"=>$fieldScript);
                
        }
        
        public function validated(){

            $data = $_POST[$this->fieldName];
            $pattern = "/^[a-zA-Z0-9]*$/";
            if(!preg_match($pattern, $data)){
                $_POST[$this->fieldName] = "data is Currupted...";
                return false;
            }
            return true;
            
        }

        public function getFieldName(){
            return $this->fieldName;
        }
  

    }

    class emailField extends make{

        public $script;
        protected $fieldName;

        function __construct($fieldAttr = array(), $label = "", $labelAttr = array()){
            
            $labelScript = $this->makeLabel($label, $labelAttr);
            $fieldScript = $this->makeField("email", $fieldAttr);
            $this->fieldName = $fieldAttr["name"]; 
            $this->script = array("labelScript"=>$labelScript, "fieldScript"=>$fieldScript);
                
        }
        
        public function validated(){

            $data = $_POST[$this->fieldName];
            $pattern = "/^[a-zA-Z0-9]*$/";
            if(!preg_match($pattern, $data)){
                $_POST[$this->fieldName] = "data is Currupted...";
                return false;
            }
            return true;
            
        }

        public function getFieldName(){
            return $this->fieldName;
        }
        

    }

    class dateField extends make{

        public $script;
        protected $fieldName;

        function __construct($fieldAttr = array(), $label = "", $labelAttr = array()){
            
            $labelScript = $this->makeLabel($label, $labelAttr);
            $fieldScript = $this->makeField("date", $fieldAttr);
            $this->fieldName = $fieldAttr["name"]; 
            $this->script = array("labelScript"=>$labelScript, "fieldScript"=>$fieldScript);
                
        }

        public function getFieldName(){
            return $this->fieldName;
        }
      

    }

    class timeField extends make{

        public $script;
        protected $fieldName;

        function __construct($fieldAttr = array(), $label = "", $labelAttr = array()){
            
            $labelScript = $this->makeLabel($label, $labelAttr);
            $fieldScript = $this->makeField("time", $fieldAttr);
            $this->fieldName = $fieldAttr["name"]; 
            $this->script = array("labelScript"=>$labelScript, "fieldScript"=>$fieldScript);
                
        }
        
        public function getFieldName(){
            return $this->fieldName;
        }
       

    }

    class checkboxField extends make{

        public $script;
        protected $fieldName;

        function __construct($fieldAttr = array(), $label = "", $labelAttr = array()){
            
            $labelScript = $this->makeLabel($label, $labelAttr);
            $fieldScript = $this->makeField("checkbox", $fieldAttr);
            $this->fieldName = $fieldAttr["name"]; 
            $this->script = array("labelScript"=>$labelScript, "fieldScript"=>$fieldScript);
                
        }

        public function getFieldName(){
            return $this->fieldName;
        }
       

    }

    class radioField extends make{

        public $script;
        protected $fieldName;

        function __construct($fieldAttr = array(), $label = "", $labelAttr = array()){
            
            $labelScript = $this->makeLabel($label, $labelAttr);
            $fieldScript = $this->makeField("text", $fieldAttr);
            $this->fieldName = $fieldAttr["name"]; 
            $this->script = array("labelScript"=>$labelScript, "fieldScript"=>$fieldScript);
                
        }

        public function getFieldName(){
            return $this->fieldName;
        }
     

    }

    class textArea{

        public $script;
        protected $fieldName;
        function __construct($fieldAttr = array(), $label = "", $labelAttr = array()){

            $labelScript = "";
            if($label){
                $labelScript .= "<label "; 
                foreach($labelAttr as $k=>$v){
                    $labelScript .= "$k = '$v' ";
                }
                $labelScript .= ">$label</label>\n";
            }

            $fieldScript = "<textarea ";
            foreach($fieldAttr as $k=>$v){
                $fieldScript .= "$k = '$v' ";
            }
            $fieldScript .= "></textarea>\n";
            $this->script = array("labelScript"=>$labelScript, "fieldScript"=>$fieldScript);
        }

        public function validated(){

            $data = $_POST[$this->fieldName];
            $pattern = "/^[a-zA-Z0-9]*$/";
            if(!preg_match($pattern, $data)){
                $_POST[$this->fieldName] = "data is Currupted...";
                return false;
            }
            return true;
            
        }

        public function getFieldName(){
            return $this->fieldName;
        }

    }
    
    class submitButtonField extends make{

        public $script;
        function __construct($fieldAttr = array(), $label = "", $labelAttr = array()){
            
            $labelScript = $this->makeLabel($label, $labelAttr);
            $fieldScript = $this->makeField("submit", $fieldAttr);
            $this->script = array("labelScript"=>$labelScript, "fieldScript"=>$fieldScript);
                
        }        

    }

    class form{

        //global variables
        protected $script;
        protected $fields;
        protected $labels;
        protected $validatedData;
        protected $fieldsArray;
        protected $submitButtonName;
        protected $fieldsError;

        public function __construct(){
            $this->script = "";
            $this->fields = array();
            $this->labels = array();
            $this->fieldsArray = array();
            $this->submitButtonName = array();
            $this->fieldsError = array();
        }

        public function updatingGlobals($fieldAttr, $labelScript, $fieldScript){
            if($fieldAttr["name"]){
                $this->labels[$fieldAttr["name"]] = $labelScript;
                $this->fields[$fieldAttr["name"]] = $fieldScript;
            }
            $this->fieldsError[$fieldAttr["name"]] = "";
            $this->script .= $labelScript . $fieldScript;
        }


        public function addTextField($fieldAttr = array(), $label = "", $labelAttr = array()){
            
            $field = new textField($fieldAttr, $label, $labelAttr);
            $this->updatingGlobals($fieldAttr ,$field->script["labelScript"], $field->script["fieldScript"]);
            $this->fieldsArray[$fieldAttr["name"]] = $field;
                
        }

        public function addPasswordField($fieldAttr = array(), $label = "", $labelAttr = array()){
            
            $field = new passwordField($fieldAttr, $label, $labelAttr);
            $this->updatingGlobals($fieldAttr ,$field->script["labelScript"], $field->script["fieldScript"]);
            $this->fieldsArray[$fieldAttr["name"]] = $field;
                
        }

        public function addEmailField($fieldAttr = array(), $label = "", $labelAttr = array()){
            
            $field = new emailField($fieldAttr, $label, $labelAttr);
            $this->updatingGlobals($fieldAttr ,$field->script["labelScript"], $field->script["fieldScript"]);
            $this->fieldsArray[$fieldAttr["name"]] = $field;
                
        }

        public function addDateField($fieldAttr = array(), $label = "", $labelAttr = array()){
            
            $field = new dateField($fieldAttr, $label, $labelAttr);
            $this->updatingGlobals($fieldAttr ,$field->script["labelScript"], $field->script["fieldScript"]);
            $this->fieldsArray[$fieldAttr["name"]] = $field;

        }

        public function addTimeField($fieldAttr = array(), $label = "", $labelAttr = array()){
            
            $field = new timeField($fieldAttr, $label, $labelAttr);
            $this->updatingGlobals($fieldAttr ,$field->script["labelScript"], $field->script["fieldScript"]);   
            $this->fieldsArray[$fieldAttr["name"]] = $field;           
        }

        public function addCheckBoxField($fieldAttr = array(), $label = "", $labelAttr = array()){

            $field = new checkboxField($fieldAttr, $label, $labelAttr);
            $this->updatingGlobals($fieldAttr ,$field->script["labelScript"], $field->script["fieldScript"]);
            $this->fieldsArray[$fieldAttr["name"]] = $field;
        }

        public function addRadioField($fieldAttr = array(), $label = "", $labelAttr = array()){

            $field = new radioField($fieldAttr, $label, $labelAttr);
            $fieldScript = $field->script["fieldScript"];
            $labelScript = $field->script["labelScript"];

            //names of all radioButton are same so we are saving it as id
            if($fieldAttr["id"]){
                $this->fields[$fieldAttr["id"]] = $fieldScript;
                $this->labels[$fieldAttr["id"]] = $labelScript;
            }
            $this->script .= $labelScript . $fieldScript;
            $this->fieldsArray[$fieldAttr["id"]] = $field;
        }

        public function addTextAreaField($fieldAttr = array(), $label = "", $labelAttr = array()){

            $field = new textArea($fieldAttr, $label, $labelAttr);
            $this->updatingGlobals($fieldAttr ,$field->script["labelScript"], $field->script["fieldScript"]);
            $this->fieldsArray[$fieldAttr["name"]] = $field;

        }

        public function addSubmitButton($fieldAttr = array(), $label = "", $labelAttr = array()){

            $field = new submitButtonField($fieldAttr, $label, $labelAttr);
            $this->updatingGlobals($fieldAttr ,$field->script["labelScript"], $field->script["fieldScript"]);
            $this->submitButtonName = $fieldAttr["name"];

        }

        public function validate(){

            $result = array();
            if(isset($_POST[$this->submitButtonName])){
                foreach($this->fieldsArray as $field){
                    $fieldName = $field->getFieldName();
                    if($_POST[$fieldName]==""){
                        $fieldName = $field->getFieldName();
                        $this->fieldsError[$fieldName] = "Field Is Empty";
                    }
                    if($field->validated()){
                        $fieldName = $field->getFieldName();
                        $result[$fieldName] = $_POST[$fieldName]; 
                    }
                    else{
                        $fieldName = $field->getFieldName();
                        $result[$fieldName] = "data is currupted";
                        $this->fieldsError[$fieldName] = "Data is not valid";
                    }
                }
                
            }
            return $result;

        }

        public function getField($name_or_id_if_radioButton){

            return $this->fields[$name_or_id_if_radioButton];

        }
        public function getLabel($name_or_id_if_radioButton){

            return $this->labels[$name_or_id_if_radioButton];

        }

        public function render_as_p(){

            foreach($this->fields as $k=>$v){

                if($this->fieldsError[$k]){
                    echo "<div class='alert alert-danger'>". $this->fieldsError[$k] . "</div>"; 
                }
                echo "<p>" . $this->labels[$k] . $v . "</p>";
            }
            
        }

        public function render(){
            echo $this->script;
        }


    }



?>