<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <div style = "text-align : center ">
      <style>
      table {
        margin: 0 auto;
        font-size: large;
        border: 1px solid black;
      }

      h1 {
        text-align: center;
        color: #006600;
        font-size: xx-large;
        font-family: 'Gill Sans', 'Gill Sans MT',
        ' Calibri', 'Trebuchet MS', 'sans-serif';
      }

      td {
        background-color: #E4F5D4;
        border: 1px solid black;
      }

      th,
      td {
        font-weight: bold;
        border: 1px solid black;
        padding: 10px;
        text-align: center;
      }

      td {
        font-weight: lighter;
      }
      </style>
    <div>
  </head>
  <body>
    <!--Code to display all instructors-->
    <section>
      <table>
        <h3>Course Data</h3>
        <tr>
          <th>Course Name</th>
          <th>Instructor Name</th>
        </tr>
        <?php
        $serverName = "localhost";
        $userName = "root";
        $password = "Chintu@0204";
        $dbName = "mydemo";
        $conn = new mysqli($serverName, $userName, $password, $dbName);
        $Table_Display = $conn->query("Select Course_Name, Instructor_Name From Course_Details");
        $rows=$Table_Display->fetch_all(MYSQLI_ASSOC);
        foreach($rows as $row)
        {
          ?>
          <tr>
            <td><?php echo $row['Course_Name'];?></td>
            <td><?php echo $row['Instructor_Name'];?></td>
          </tr>
          <?php
        }
        ?>
      </table>
    </section>

    <!--Code to alter the instructor-->
    <form action="Course.php" method="get">
      <div style = "text-align: center">
        <h3>Enter the Course Details:</h3>
        <label for = "Action">Action to be done</label>
       <select name = "Action">
        <option = "">Select</option>
        <?php
        $result = $conn->query("Select user_action from User_Action where user_access = 'Course'");
        $rows = $result ->fetch_all(MYSQLI_ASSOC);
        foreach($rows as $row)
        {
          echo "<option value = ".$row["user_action"] .">".$row["user_action"] ."</option>";
        }
        ?>
      </select>
        <br></br>
        <br>Name Of the Course:<input type = "text" Name = "Course_Name"></br>
        <br>Name of the Instructor:<input type = "text" Name = "Instructor_Name"></br>
        <br><input type = "submit">
        <input type="button" value="Go back!" onclick="history.back()"></br>
      </div>
    </form>
    <?php
    $Act = $_GET["Action"]??"";
    $Course = $_GET["Course_Name"]??"";
    $Instructor = $_GET["Instructor_Name"]??"";
     $Num_Instructor = $conn->query("Select * From Instructor_Details where Name = '$Instructor'");
     $cnt = $Num_Instructor->num_rows;
     if($cnt == 0)
     {
       echo "Instructor '$Instructor' not found";
       exit();
     }
     $Course_Num = $conn->query("select * from course_details where Course_name = '$Course' and Instructor_Name = '$Instructor'");
     $Cnt_Course= $Course_Num->num_rows;
     if($Act == "Add")
     {
       if($Cnt_Course != 0)
       {
         echo "already $Course registered for $Instructor";
         exit();
       }
       $Query = "INSERT INTO COURSE_DETAILS (Course_Name, Instructor_Name) values ('$Course', '$Instructor')";
       if (mysqli_query($conn, $Query))
       {
         echo "<div style = 'text-align:Center'>Course '$Course' with Instructor '$Instructor' inserted successfully</div>";
         exit();
        }
        else
        {
            echo "Error: " . $Query . "<br>" . mysqli_error($conn);
        }
     }
     elseif($Act == "Delete")
     {
       if($Cnt_Course == 0)
       {
         echo " $Course not found for $Instructor";
         exit();
       }
       $Query = "Delete From Course_Details where Course_Name = '$Course' and Instructor_Name = '$Instructor'";
       if (mysqli_query($conn, $Query))
       {
         echo "<div style = 'text-align:Center'>Course '$Course' with Instructor '$Instructor' deleted successfully</div>";
         exit();
        }
        else
        {
            echo "Error: " . $Query . "<br>" . mysqli_error($conn);
        }
     }
    $conn->close();
    ?>
  </body>
</html>
