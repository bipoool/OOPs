<?php

    include("CRUD.php");

    $query = new query();

    //$query->getData("Users", "*");
    //$query->deleteData("Users", array("Name" => "VIPUL"));
    //$query->addData("Users", array("Name"=>"VIPUL", "Email"=>"vipul@gmail.com", "Password" => "vipul","Age"=>20));
    //$query->updateData("Users", array("Name"=>"Raman Bansal"), array("Name"=>"Raman Bansal", "Age" => 9));

    $form = new form();
    $form->addTextField(array("name"=>"userName", "placeholder" => "username", "value"=>"vip3022", "class"=>"form-control"), "UserName",array("class"=>"label-lg"));
    // $form->addPasswordField(array("name"=>"password", "placeholder" => "Password", "class"=>"form-control"), "Password", array("class"=>"label-lg"));
    $form->addSubmitButton(array("name"=>"submit", "class"=>"btn btn-success"), "", array("class"=>"label-lg"));
    print_r($form->validate());

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

</head>
<body>
    
    <h1>Form Class Test</h1>
    <form action="" method="post" class = "container col-sm-6">
    
        <?php
           $form->render_as_p();
        ?>
        
    </form>


    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


</body>
</html>





