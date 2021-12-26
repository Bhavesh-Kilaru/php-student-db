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
  </head>
  <body>

    <!--Code to display all instructors-->
    <section>
      <table>
        <h3>Instructor Data</h3>
        <tr>
          <th>Name</th>
          <th>Phone Number</th>
          <th>Course Name</th>
        </tr>
        <?php
        $serverName = "localhost";
        $userName = "root";
        $password = "Chintu@0204";
        $dbName = "mydemo";
        $conn = new mysqli($serverName, $userName, $password, $dbName);
        $Table_Display = $conn->query("Select Name, phone_number, Course_Name From Instructor_Details I left join Course_Details C  ON C.Instructor_Name = I.name");
        $rows=$Table_Display->fetch_all(MYSQLI_ASSOC);
        foreach($rows as $row)
        {
          ?>
          <tr>
            <td><?php echo $row['Name'];?></td>
            <td><?php echo $row['phone_number'];?></td>
            <td><?php echo $row['Course_Name'];?></td>
          </tr>
          <?php
        }
        ?>
      </table>
    </section>

    <!--Code to enter the new insrtuctor-->
    <br>  <h3>Enter the Instructor Details:</h3></br>
    <form action="New_Instructor.php" method="get">
      <div style = "text-align: center">
        <br>Name Of the Instructor:<input type = "text" Name = "Instructor_Name"></br>
        <br>Instructor Phone Number:<input type = "text" Name = "Phone_number"></br>
        <br>Instructor Password:<input type = "text" Name = "Password"></br>
        <br><input type = "submit">
        <input type="button" value="Go back!" onclick="history.back()"></br>
      </div>
    </form>
    <?php
    $name = $_GET["Instructor_Name"]??" ";
    $phone_nm = $_GET["Phone_number"]??" ";
    $pwd = $_GET["Password"]??" ";
    $Num_Instructor = $conn->query("Select * From Instructor_Details where Name = '$name'");
    $cnt = $Num_Instructor->num_rows;

    if($cnt != 0)
    {
      echo "Instructor '$name' already exists";
      exit();
    }
    $Query = "Insert into Instructor_Details(Name, Phone_number, password) values('$name', '$phone_nm', '$pwd')";

    if (mysqli_query($conn, $Query))
    {
      echo "<div style = 'text-align:Center'>Instructor $name inserted successfully</div>";
      exit();
    }
    else
    {
      echo "Error: " . $Query . "<br>" . mysqli_error($conn);
    }

    $conn->close();
    ?>

    </body>
  </div>
  </html>
