<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit</title>
</head>
<body>
    <h1>Edit</h1>
    <form name = "edit_form" method = "post" action="edit.php">
        name : <br>
        <input type = "text" name = "edit_name"> <br>
        title : <br>
        <input type = "text" name = "edit_title"> <br>
        year : <br>
        <input type = "text" name = "edit_year"> <br>
        <input type="hidden" name = "edit_ID" value = <?=$_POST["edit_ID"]?>>
        <input type = "submit" value = "send" > <br>

    </form>
</body>
</html>