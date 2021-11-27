<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>view</title>
</head>
<body>

    <h1> AAA Lab </h1>

    <h2>Achievement</h2>
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
            #print "connect <br>";
        }
        catch(PDOException $Exception)
        {
            die("error : ".$Exception -> getMessage());
        }

        if(isset($_POST["delete"]))
        {
            try
            {
                $pdo -> beginTransaction();
                $sql_delete = "DELETE FROM paper WHERE id =".$_POST["delete_ID"]; 
                $stmh_delete = $pdo -> prepare($sql_delete);
                $stmh_delete -> execute();
                $pdo -> commit();
            }
            catch(PDOException $Exception)
            {
                die("error : ".$Exception -> getMessage());
            }
        }
         

        #show data
        try
        {
            $pdo ->beginTransaction();
            $sql_show = "SELECT*FROM paper ORDER BY year ASC";
            $stmh_show = $pdo -> prepare($sql_show);
            $stmh_show -> execute();
            $pdo -> commit();
        }
        catch(PDOException $Exception)
        {
            die("error : ".$Exception -> getMessage());
        }

    ?>

    <table width="70%" border="3" cellspacing="2" cellpadding = "8">
        <tbody>
            <tr> <th>No. </th> <th>name</th> <th>title</th> <th>year</th> <th> </th> <th> </th> </tr>

            <?php
                $num = 1;  
                while ($row = $stmh_show -> fetch(PDO::FETCH_ASSOC))
                {
            ?>
                    <tr>
                        <td width="50"> <?= htmlspecialchars($num)?> </td>
                        <td width="100"> <?= htmlspecialchars($row["name"])?> </td>
                        <td> <?= htmlspecialchars($row["title"])?> </td>
                        <td width="50"> <?= htmlspecialchars($row["year"])?> </td>
                        <form name = "delete_form" method = "post" action="view.php">
                            <input type="hidden" name = "delete_ID" value = <?=$row["id"]?>>
                            <td width="50"> <input type = "submit" name = "delete" value = "delete"> </td>
                        </form>
                        <form name = "delete_form" method = "post" action="edit_form.php">
                            <input type="hidden" name = "edit_ID" value = <?=$row["id"]?>>
                            <td width="30"> <input type = "submit" name = "edit" value = "edit"> </td>
                        </form>
                    </tr>
            <?php
                    $num += 1;
                }
            ?>
        </tbody>
    </table>

    </br>
    <h2>Form</h2>
    <a href = "input_form.php">here </a></br>
</body>
</html>