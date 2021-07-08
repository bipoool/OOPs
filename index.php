<?php

    include("CRUD.php");
    include("forms.php");
    $form = new form();

    $form->addTextField(array("name"=>"Name","id"=>"Name", "placeholder" => "Name","class"=>"form-control"), "",array("class"=>"label-lg"));
    $form->addEmailField(array("name"=>"Email", "id"=>"Email", "class"=>"form-control", "placeholder" => "Email"), "", array("class"=>"label-lg"));
    $form->addPasswordField(array("name"=>"Password", "id"=>"Password", "placeholder" => "Password", "class"=>"form-control"), "", array("class"=>"label-lg"));
    $form->addTextField(array("name"=>"Age", "id"=>"Age", "placeholder" => "Age", "class"=>"form-control"), "", array("class"=>"label-lg"));


    $conn = new query();
    $result = $conn->getData("Users", "Name, Email, Age");

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
    
    <h1 class="alert-dark">Form Class Test</h1>
    <div class="row jumbotron">
        <form action="" method="post" class = "container col-sm-5">
    
            <?php
                $form->render_as_p();
            ?>
            <button type="submit" class="btn btn-info btn-lg" name="submit" id="addButton">Add</button>
        
        </form>

        <div class="myData col-sm-7">
        
            <table class="table table-hover" id="table">

                

            </table>

        </div>

    </div>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="javascript.js"></script>

</body>
</html>
