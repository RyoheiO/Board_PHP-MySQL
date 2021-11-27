<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>form</title>
</head>
<body>
    <?php
        #user name
        $db_user = "root";
        #password
        $db_pass = "hydrogen1"; 
        #host
        $db_host = "localhost";
        #database
        $db_name = "ACHIEVEMENT";
        #type
        $db_type = "mysql";

        $dsn = "$db_type:host = $db_host;dbname=$db_name;charset=utf8";

        #connect database
        try
        {
            $pdo = new PDO($dsn, $db_user, $db_pass);
            $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo -> setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            print "connect <br>";
        }
        catch(PDOException $Exception)
        {
            die("error : ".$Exception -> getMessage());
        }

        try
        {
            $pdo ->beginTransaction();
            $sql_form = "INSERT INTO paper (name, title, year) VALUES (:name, :title, :year)";
            $stmh_form = $pdo -> prepare($sql_form);
            $stmh_form -> bindValue(":name", $_POST["input_name"], PDO::PARAM_STR);
            $stmh_form -> bindValue(":title", $_POST["input_title"], PDO::PARAM_STR);
            $stmh_form -> bindValue(":year", $_POST["input_year"], PDO::PARAM_STR);
            $stmh_form -> execute();
            $pdo -> commit();
            echo $stmh_form->rowCount()."data , insert <br>"; 
        }
        catch(PDOException $Exception)
        {
            $pdo -> rollback();
            die("error : ".$Exception -> getMessage());
        }

    ?>
    </br>
    <a href = "view.php">HOME </a></br>

</body>
</html>