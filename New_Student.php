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
  </div>
</head>
<body>
  <!--Code to display all Students-->
  <section>
    <table>
      <div style = "text-align : center ">
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
      </div>
    </table>
  </section>

  <!--Code to add the student-->
  <div style = "text-align: center">
    <form action="New_Student.php" method="get">
      <br></br>
      <h3>Enter the Student Details:</h3>
      <br>Name Of the Student:<input type = "text" Name = "Student_Name"></br>
      <br>Student Phone Number:<input type = "text" Name = "Phone_number"></br>
      <br>Enter the student Instructor Details:<input type = "text" Name = "Instructor_Name"></br>
      <br>Enter the student Course Details:<input type = "text" Name = "Course_Name"></br>
      <br><input type = "submit">
      <input type="button" value="Go back!" onclick="history.go(-1)"></br>
    </form>
    <?php
    $name = $_GET["Student_Name"]??"";
    $phone_nm = $_GET["Phone_number"]??"";
    $Instructor = $_GET["Instructor_Name"]??"";
    $Course = $_GET["Course_Name"]??"";
    $Num_Instructor = $conn->query("Select * From Instructor_Details where Name = '$Instructor'");
    $cnt = $Num_Instructor->num_rows;
    if($cnt == 0)
    {
      echo "Instructor '$Instructor' not found";
      exit();
    }
    $Num_Course = $conn->query("Select * From Course_Details where Course_Name = '$Course'");
    $cnt_Course = $Num_Course->num_rows;
    if($cnt_Course == 0)
    {
      echo "Course '$Course' not found";
      exit();
    }
    $Num_Course_Inst = $conn->query("Select * From Course_Details where Course_Name = '$Course' and Instructor_Name = '$Instructor'");
    $cnt_Course_Inst= $Num_Course_Inst->num_rows;
    if($cnt_Course_Inst == 0)
    {
      echo "Insertion failed as Instructor '$Instructor' does not teaches Course '$Course'";
      exit();
    }
    $Num_Student = $conn->query("Select * From Student_Details where Name = '$name' and Course_Name = '$Course' and Instructor_Name = '$Instructor'");
    $cnt_Student= $Num_Course_Inst->num_rows;
    if($cnt_Student != 0)
    {
      echo "Insertion failed as student '$name'  already registered for Course '$Course' taught by Instructor '$Instructor'";
      exit();
    }
    $Query = "Insert into Student_Details(Name, Phone_number, Instructor_Name, Course_Name) values('$name', '$phone_nm', '$Instructor', '$Course')";
    if (mysqli_query($conn, $Query))
    {
      echo "$name registered for $Course under $Instructor!!";
      exit();
    }
    else
    {
      echo "Error: " . $Query . "<br>" . mysqli_error($conn);
    }
    $conn->close();
    ?>

  </div>
</body>
</html>
