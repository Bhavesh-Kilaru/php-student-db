<!DOCTYPE html>
<html lang="en" dir="ltr">
<!-- <head>
<meta charset="utf-8">
<title></title>
<div style = 'text-align: center'>
<script>
var user_type = document.getElementsByName('User_Type');
console.log(user_type[0].value);
</script>
</div>
</head> -->
<body>
  <!-- <div style = 'text-align: center'>
  <label for = "User Type">who is logging in?:</label>
  <select name = "User Type" id = "User Type">
  <option value="select">select</option>
  <option value="Super User">Super User</option>
  <option value="Administrator">Administrator</option>
  <option value="Instructor">Instructor</option>
</select>
<div>
<br> <button type="submit">Submit</button>
</div>
</div> -->
<?php
echo "<div style = 'text-align:center'>";
echo ("<h2> My Dashboard </h2>");
$serverName = "localhost";
$userName = "root";
$password = "Chintu@0204";
$dbName = "mydemo";
$conn = new mysqli($serverName, $userName, $password, $dbName);
// if ($conn->connect_error) {
//   die("Connection failed: " . $conn->connect_error);
// }
// echo "Connected successfully";
$result1 = $conn->query("Select * from user_type");
$rows = $result1->fetch_all(MYSQLI_ASSOC);
//  foreach ($rows as $row) {
//    printf("%s \n", $row["User_Type"]);
// }
// $stmt = $conn->prepare('Select * from user_type');
// $stmt->execute();
// $stmt->store_result();
// printf("Number of rows: %d.\n", $stmt->num_rows);
//      echo "<label for = 'User Type'>who is logging in?:</label>";
//
// echo "<select name='User_Type'>";
//      echo "<option value = ''>select</option>";
//       foreach ($rows as $row) {
//           echo "<option value= " . $row['User_Type'] ." >" . $row['User_Type'] ."</option>";
//         }
//         echo "</div>";
//         echo "<br></br>";
?>
</select>
<form action = "site.php" method = "get">
  <div style= 'text-align: center'>
    <label for = 'User_Type'>who is logging in?:</label>
    <select name='User_Type'>
      <option value = "">Select</option>
      <?php
      foreach ($rows as $row) {
        echo "<option value= " . $row['User_Type'] ." >" . $row['User_Type'] ."</option>";
      }
      ?>
    </select>
    <br></br>
    <br>LogIn ID: <input type = "text" name = "LogIn_Id" placeholder= "Enter your LoginId"> </br>
    <br></br>
    Passsword: <input type = "password" name = "Password" placeholder=" enter your password">
    <br></br>
  <br><input type = 'submit'></br>
  </div>
</form>

<?php
$UserType = $_GET["User_Type"]??NULL;
$LoginId = $_GET["LogIn_Id"]??NULL;
$Pwd = $_GET["Password"]??NULL;
//echo $Pwd;
if($UserType == "Administrator")
{
  $result2 = $conn->query("Select User_Id, Password From Administrators");
  $Admins =  $result2->fetch_all(MYSQLI_ASSOC);
  $Admin_Found = False;
  foreach ($Admins as $Admin)
  {
    if($Admin['User_Id'] == $LoginId and $Admin['Password'] == $Pwd)
    {
      $Admin_Found = True;
    }
  }
  if($Admin_Found == False)
  {
    echo "<br>$LoginId is not an administrator. Request denied.<br>";
    exit();
  }
  else
  {
    // echo "<br>$LoginId logged in as an administrator<br>";
    // $Result3 = $conn->query("Select user_action, User_Type From User_Action  group by user_Action having user_type = 'Administrator'");
    // $Result4 = $conn->query("Select user_access, user_type  from User_Action  group by user_access having user_type = 'Administrator'");
    // $Actions = $Result3->fetch_all(MYSQLI_ASSOC);
    // $Parties = $Result4->fetch_All(MYSQLI_ASSOC);
    // echo "<form action = 'site.php' method = get>";
    // echo "<label for = 'Actions_To_Be_Done' >What needs to be done:</label>";
    // echo "<select name = 'Actions_To_Be_Done'>";
    // echo "<option = ''>Select</option>";
    // foreach($Actions as $Action)
    // {
    //   echo "<option value = " .$Action["user_action"]. "> ". $Action["user_action"] . "</option>";
    // }
    // echo "</select>";
    //
    // // foreach ($Actions as $row) {
    // //    printf("%s \n", $row["user_action"]);
    // // }
    // echo "<br><label for = 'Effected_party' >whom should we acted?</label>";
    // echo "<select name = 'Effected_party'>";
    // echo "<option = ''>Select</option>";
    // foreach($Parties as $Party)
    // {
    //   echo "<option value = " .$Party["user_access"]. "> ". $Party["user_access"] . "</option>";
    // }
    // echo "</select>";
    // echo "<input type = 'submit'>";
    // // foreach ($Parties as $row) {
    // //    printf("%s \n", $row["user_access"]);
    // // }
    // echo "</br";
    // echo "</form>";
    // $Act = $_GET["Actions_To_Be_Done"]??NULL;
    // $Pty = $_GET["Effected_party"]??NULL;
    // if($Act == "Add" and $Pty == "Instructor")
    // {
    //   echo "Instructor";
    // }
    header('Location: http://localhost:4000/www/administrator.php');
    exit;
  }
}
elseif($UserType == "Instructor")
{
  $result = $conn->query("select Name,Password from Instructor_Details");
  $insts = $result->fetch_all(MYSQLI_ASSOC);
  $Instructor_Found = False;
  foreach ($insts as $inst)
  {
    if($inst["Name"] == $LoginId and $inst["Password"] == $Pwd)
    {
      $Instructor_Found = True;
      echo "You successfully logged as an instructor";
    }
  }
  if($Instructor_Found == False)
  {
    echo "You are not an instructor";
  }
  else {
    echo "<script>window.location.href = 'http://localhost:4000/www/Instructor_Action.php'</script>";
  }
}
?>

</body>
</html>
