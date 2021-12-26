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
  </div>
</head>
<body>

  <!--Code to display all Students-->
  <div style = "text-align : center ">
  <section>
    <table>
      <h3>Instructor Data</h3>
      <tr>
        <th>Name</th>
        <th>Phone Number</th>
        <th>Instructor Name</th>
        <th>Course Name</th>
      </tr>
      <?php
      $serverName = "localhost";
      $userName = "root";
      $password = "Chintu@0204";
      $dbName = "mydemo";
      $conn = new mysqli($serverName, $userName, $password, $dbName);
      $Table_Display = $conn->query("Select Name, phone_number, Instructor_Name, Course_Name From Student_Details");
      $rows=$Table_Display->fetch_all(MYSQLI_ASSOC);
      foreach($rows as $row)
      {
        ?>
        <tr>
          <td><?php echo $row['Name'];?></td>
          <td><?php echo $row['phone_number'];?></td>
          <td><?php echo $row['Instructor_Name'];?></td>
          <td><?php echo $row['Course_Name'];?></td>
        </tr>
        <?php
      }
      ?>
    </table>
  </section>
</div>

  <!--Code to delete the student-->

  <div style = "text-align : center ">
  <h3>Deleting the Student:</h3>
  <form action="Delete_Student.php" method="get">
    <br>Name Of the Student to be deleted:<input type = "text" Name = "Student_Name"></br>
    <br>Name Of the Instructor for the Student to be deleted:<input type = "text" Name = "Instructor_Name"></br>
    <br>Enter the student Course Details:<input type = "text" Name = "Course_Name"></br>
    <br><input type = "submit"">
    <input type="button" value="Go back!" onclick="history.back()"></br>
  </div>
</form>
<?php
$name = $_GET["Student_Name"]??"";
$Instructor_Name = $_GET["Instructor_Name"]??"";
$Course = $_GET["Course_Name"]??"";
$result = $conn->query("select * from Student_Details where name = '$name' and Instructor_name = '$Instructor_Name' and Course_Name = '$Course'");
$row_cnt = $result->num_rows;
if($row_cnt == 0){
  echo "<div style = 'text-align:Center'> The instructor $Instructor_Name does not have student with name $name enrolled for course $Course </div>";
  exit();
}
$Query = "Delete From Student_Details where name = '$name' and Instructor_name = '$Instructor_Name'";
if (mysqli_query($conn, $Query))
{
  echo "<div style = 'text-align:Center'> Student '$name' with Instructor '$Instructor_Name' and for course ''$Course' deleted successfully</div>";
  exit();
}
else
{
  echo "Error: " . $Query . "<br>" . mysqli_error($conn);
}
$conn->close();
?>
</body>
