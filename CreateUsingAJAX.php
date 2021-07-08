<?php

    include("CRUD.php");
    $conn = new query();

    $data = json_decode(file_get_contents("php://input"), true);
    $conn->addData("Users", $data);

?>







