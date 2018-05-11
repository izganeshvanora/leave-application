<!DOCTYPE html>
<html lang="en">
<head>
  <title>Attendance</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</head>

<body>
  <?php
require('connect.php');

$emp=$_GET["user"];

$sql = "SELECT * FROM login where slno_empid='$emp'";
$result = $link->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
?>
  <div class = "container">
    <div class = "row">
          <div class = "sign-container">
            <form>
              <h2>Welcome</h2><br/>
              <img src="https://thumb.ibb.co/ehr95d/account_manager.jpg" alt="profile-pic"/><br/>
              <label class="emp-id">#<?php echo $row['slno_empid']?></label><br/>
              <label class="emp-name"><?php echo $row['emp_name']?></label><br/>
              <label class="emp-timestamp"><?php echo date('Y-m-d H:i:s'); ?></label><br/>
              <input type="submit" class="btn-check-out" value="Check-Out"/>
            </form>
          </div>
      </div>
    </div>
  </div>
  <?php
}
}
  ?>
</body>

</html>