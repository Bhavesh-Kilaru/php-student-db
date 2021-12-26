<!DOCTYPE html>
<html lang="en" dir="ltr">\
<div style = "text-align:  center">
  <head>
    <meta charset="utf-8">
    <title></title>
    <h2>What you want to do instructor</h2>
  </head>
  <body>
    <form action="Instructor_Action.php"  method = "get">
      <br><label for = "Actions_To_Be_Done">What you want to do?</label>
      <select name = "Actions_To_Be_Done">
        <option value = "">Select</option>
        <?php
        $serverName = "localhost";
        $userName = "root";
        $password = "Chintu@0204";
        $dbName = "mydemo";
        $conn = new mysqli($serverName, $userName, $password, $dbName);
        $result = $conn->query("Select * From User_Action where user_type = 'Instructor'");
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        foreach($rows as $row)
        {
          echo "<option value = ".$row["user_action"]. " > " .$row["user_action"]. "</option>";
        }
         ?>
      </select></br>
      <br><input type = "submit">
      <input type = "submit" value = "Go Back!" onclick=history.go(-1)"> </br>
    </form>

    <?php
    $action = $_GET["Actions_To_Be_Done"]??"";
    echo $action;
    if($action == "Add")
    {
      echo "<script  type='text/javascript'> window.location.href = 'http://localhost:4000/www/New_Student.php';</script>";
      exit();
    }
    elseif($action == "Delete")
    {
      echo "<script  type='text/javascript'> window.location.href = 'http://localhost:4000/www/Delete_Student.php';</script>";
      exit();
    }
    ?>
  </div>
  </body>
</html>
