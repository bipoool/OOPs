<?php

    require_once("forms.php");
    require_once("CRUD.php");

    class DB_Forms{

        protected $conn;
        protected $fieldsInfo;
        public $form;
        protected $tableName;
        protected $name;

        function __construct($tableName){

            $this->fieldsInfo = array();
            $this->conn = new query();
            $this->fieldsInfo = $this->conn->descTable($tableName);
            $this->form = new form();
            $this->tableName = $tableName;

            if(isset($_GET["Name"])){

                $this->name = $_GET["Name"];

                $result = $this->conn->getData($tableName, "*", array("Name"=>$this->name))[0];

                foreach($this->fieldsInfo as $field){
                    $this->form->addTextField(array("name"=>$field[0], "placeholder" => $field[0],"class"=>"form-control", "value"=>$result[$field[0]]), $field[0],array("class"=>"label-lg"));
                }
                $this->form->addSubmitButton(array("name"=>"submit", "class"=>"btn btn-success"), "", array("class"=>"label-lg"));

            }
            else{
                foreach($this->fieldsInfo as $field){

                    $this->form->addTextField(array("name"=>$field[0], "placeholder" => $field[0],"class"=>"form-control"), $field[0],array("class"=>"label-lg"));
    
                }
                $this->form->addSubmitButton(array("name"=>"submit", "class"=>"btn btn-success"), "", array("class"=>"label-lg"));
            }
        }

        public function validateAndAdd(){

            $result = $this->form->validate();
            if(isset($_POST[$this->form->getSubmitButtonName()]) and $result){
        
                $this->conn->addData($this->tableName, $result);
                
            }
            return $result;
        
        }

        public function validateAndUpdate(){

            $result = $this->form->validate();
            if(isset($_POST[$this->form->getSubmitButtonName()]) and $result){
        
                $this->conn->updateData($this->tableName, $result, array("Name"=>$this->name));
                
            }
            return $result;
        
        }

    }

?>














