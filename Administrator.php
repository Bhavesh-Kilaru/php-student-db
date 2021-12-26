<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title></title>
  <div style = "text-align:center "><h2>What you want to do as a Administrator?</h2></br>
</head>
<body>
  <form action = "Administrator.php" method = "GET">
    <div style= 'text-align: center'>
      <br><label for = 'Actions_To_Be_Done'>What needs to be done:</label>
      <select name = 'Actions_To_Be_Done'>
        <option = ''>Select</option>
        <?php
        $serverName = "localhost";
        $userName = "root";
        $password = "Chintu@0204";
        $dbName = "mydemo";
        $conn = new mysqli($serverName, $userName, $password, $dbName);
        $Result3 = $conn->query("Select user_action, User_Type From User_Action  group by user_Action having user_type = 'Administrator'");
        $Result4 = $conn->query("Select user_access, user_type  from User_Action  group by user_access having user_type = 'Administrator'");
        $Actions = $Result3->fetch_all(MYSQLI_ASSOC);
        $Parties = $Result4->fetch_All(MYSQLI_ASSOC);
        foreach($Actions as $Action)
        {
          echo "<option value = " .$Action["user_action"]. "> ". $Action["user_action"] . "</option>";
        }
        ?>
      </select></br>

      <br><label for = 'Effected_party' >whom should we acted?</label>
      <select name = 'Effected_party' id = 'Effected_party'>
        <option = ''>Select</option>
        <?php
        foreach($Parties as $Party)
        {
          echo "<option value = " .$Party["user_access"]. "> ". $Party["user_access"] . "</option>";
        }
        ?>
      </select>
      <br><br>
      <input type = "submit">
      <input type="button" value="Go back!" onclick="history.back()"></br></br>
      </form>

      <?php

      $Act = $_GET["Actions_To_Be_Done"]??NULL;
      $Pty = $_GET["Effected_party"]??NULL;
      echo ".Actions: ".$Act . $Pty;
      if($Act == "Add" and $Pty == "Instructor"){
        echo "<script type='text/javascript'> window.location.href = 'http://localhost:4000/www/New_Instructor.php';</script>";
        exit();
      }
      elseif($Act == "Delete" and $Pty == "Instructor"){
        echo "<script type='text/javascript'> window.location.href = 'http://localhost:4000/www/Delete_Instructor.php';</script>";
        exit();
      }
      elseif($Act == "Add" and $Pty == "Student"){
        echo "<script type='text/javascript'> window.location.href = 'http://localhost:4000/www/New_Student.php';</script>";
        exit();
      }
      elseif($Act == "Delete" and $Pty == "Student"){
        echo "<script type='text/javascript'> window.location.href = 'http://localhost:4000/www/Delete_Student.php';</script>";
        exit();
      }
      elseif($Pty == "Course")
      {
        echo "<script type='text/javascript'> window.location.href = 'http://localhost:4000/www/Course.php';</script>";
        exit();
      }
      ?>
      </body>
      </html>
