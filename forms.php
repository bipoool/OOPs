<?php

/**
 * Make class is used to make script for fields and lable
 * 
 * make->makeLabel($label, $labelAttr = array())
 * make->makeField($type, $fieldAttr = array())
 *
 * @author Vipul Gupta
 */

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

/**
 * Below class is used to initialize the TextFields
 * textField->validate() (to check the validation of the input)
 * textField->getFieldName() (to get the field name)
 */

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

/**
 * Below class is used to initialize the passwordField
 * passwordField->validate() (to check the validation of the input)
 * passwordField->getFieldName() (to get the field name)
 */

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

/**
 * Below class is used to initialize the emailField
 * emailField->validate() (to check the validation of the input)
 * emailField->getFieldName() (to get the field name)
 */

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
    $pattern = "/^[a-zA-Z0-9@\.]*$/";
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

/**
 * Below class is used to initialize the dateField
 * dateField->validate() (to check the validation of the input)
 * dateField->getFieldName() (to get the field name)
 */

class dateField extends make{

public $script;
protected $fieldName;

function __construct($fieldAttr = array(), $label = "", $labelAttr = array()){
    
    $labelScript = $this->makeLabel($label, $labelAttr);
    $fieldScript = $this->makeField("date", $fieldAttr);
    $this->fieldName = $fieldAttr["name"]; 
    $this->script = array("labelScript"=>$labelScript, "fieldScript"=>$fieldScript);
        
}
//No need to validate
public function validated(){

    return true;
    
}

public function getFieldName(){
    return $this->fieldName;
}


}

/**
 * Below class is used to initialize the timeField
 * timeField->validate() (to check the validation of the input)
 * timeField->getFieldName() (to get the field name)
 */

class timeField extends make{

public $script;
protected $fieldName;

function __construct($fieldAttr = array(), $label = "", $labelAttr = array()){
    
    $labelScript = $this->makeLabel($label, $labelAttr);
    $fieldScript = $this->makeField("time", $fieldAttr);
    $this->fieldName = $fieldAttr["name"]; 
    $this->script = array("labelScript"=>$labelScript, "fieldScript"=>$fieldScript);
        
}
//No need to validate
public function validated(){

    return true;
    
}

public function getFieldName(){
    return $this->fieldName;
}


}

/**
 * Below class is used to initialize the checkboxField
 * checkboxField->validate() (to check the validation of the input)
 * checkboxField->getFieldName() (to get the field name)
 */

class checkboxField extends make{

public $script;
protected $fieldName;

function __construct($fieldAttr = array(), $label = "", $labelAttr = array()){
    
    $labelScript = $this->makeLabel($label, $labelAttr);
    $fieldScript = $this->makeField("checkbox", $fieldAttr);
    $this->fieldName = $fieldAttr["name"]; 
    $this->script = array("labelScript"=>$labelScript, "fieldScript"=>$fieldScript);
        
}
//No need to validate
public function validated(){

    return true;
    
}

public function getFieldName(){
    return $this->fieldName;
}

}

/**
 * Below class is used to initialize the radioField
 * radioField->validate() (to check the validation of the input)
 * radioField->getFieldName() (to get the field name)
 */

class radioField extends make{

public $script;
protected $fieldName;

function __construct($fieldAttr = array(), $label = "", $labelAttr = array()){
    
    $labelScript = $this->makeLabel($label, $labelAttr);
    $fieldScript = $this->makeField("radio", $fieldAttr);
    $this->fieldName = $fieldAttr["id"]; 
    $this->script = array("labelScript"=>$labelScript, "fieldScript"=>$fieldScript);
        
}

//No need to validate
public function validated(){

    return true;
    
}

public function getFieldName(){
    return $this->fieldName;
}

}

/**
 * Below class is used to initialize the textArea
 * textArea->validate() (to check the validation of the input)
 * textArea->getFieldName() (to get the field name)
 */

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

/**
 * Below class is used to initialize the textArea
 * textArea->validate() (to check the validation of the input)
 * textArea->getFieldName() (to get the field name)
 */

class submitButtonField extends make{

public $script;
function __construct($fieldAttr = array(), $label = "", $labelAttr = array()){
    
    $labelScript = $this->makeLabel($label, $labelAttr);
    $fieldScript = $this->makeField("submit", $fieldAttr);
    $this->script = array("labelScript"=>$labelScript, "fieldScript"=>$fieldScript);
        
}        

}

/**
 * form makes/validates forms
 *
 * This generates HTML5 forms & validates them.
 *
 * form->updatingGlobals($fieldAttr, $labelScript, $fieldScript)
 * form->addTextField($fieldAttr = array(), $label = "", $labelAttr = array())
 * form->addPasswordField($fieldAttr = array(), $label = "", $labelAttr = array())
 * form->addEmailField($fieldAttr = array(), $label = "", $labelAttr = array())
 * form->addDateField($fieldAttr = array(), $label = "", $labelAttr = array())
 * form->addTimeField($fieldAttr = array(), $label = "", $labelAttr = array())
 * form->addCheckBoxField($fieldAttr = array(), $label = "", $labelAttr = array())
 * form->addRadioField($fieldAttr = array(), $label = "", $labelAttr = array())
 * form->addTextAreaField($fieldAttr = array(), $label = "", $labelAttr = array())
 * form->addTextAreaField($fieldAttr = array(), $label = "", $labelAttr = array())
 * form->addSubmitButton($fieldAttr = array(), $label = "", $labelAttr = array())
 * form->validate()
 * form->getField($name_or_id_if_radioButton)
 * form->getLabel($name_or_id_if_radioButton){
 * form->render_as_p()
 * form->render()
 *
 */

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
    $this->fieldsError[$fieldAttr["id"]] = "";
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

            if(!$_POST[$field->getFieldName()]){
                $fieldName = $field->getFieldName();
                $this->fieldsError[$fieldName] = "Field Is Empty";
            }
            elseif($field->validated()){
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