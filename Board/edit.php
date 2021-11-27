<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>edit</title>
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
            $sql_edit = "UPDATE paper SET name= :name, title= :title, year= :year WHERE id=".$_POST["edit_ID"];
            $stmh_edit = $pdo -> prepare($sql_edit);
            $stmh_edit -> bindValue(":name", $_POST["edit_name"],  PDO::PARAM_STR);
            $stmh_edit -> bindValue(":title", $_POST["edit_title"],  PDO::PARAM_STR);
            $stmh_edit -> bindValue(":year", $_POST["edit_year"],  PDO::PARAM_STR);
            $stmh_edit -> execute();
            $pdo -> commit();
            echo $stmh_edit->rowCount()."data , edit <br>"; 
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