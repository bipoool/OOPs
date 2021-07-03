<?php

    include("CRUD.php");

    $query = new query();

    $query->getData("Users", "*");
    //$query->deleteData("Users", array("Name" => "VIPUL"));
    //$query->addData("Users", array("Name"=>"VIPUL", "Email"=>"vipul@gmail.com", "Password" => "vipul","Age"=>20));
    //$query->updateData("Users", array("Name"=>"Raman Bansal"), array("Name"=>"Raman Bansal", "Age" => 9));

?>