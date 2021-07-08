<?php

    include("CRUD.php");

    $conn = new query();
    $result = $conn->getData("Users", "Name, Email, Age");

    $str = "<tr><th>Name</th><th>Email</th><th>Age</th><th>Edit</th></tr>";
    foreach($result as $row){
        $str.= "<tr><td>" . $row["Name"] . "</td><td>" . $row["Email"] . "</td><td>" . $row["Age"] . "</td><td><a href"  . "</tr>";
    }

            
    print_r($str);

?>
