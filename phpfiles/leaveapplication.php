<?php
require('connect.php');
?>

<!DOCTYPE html>
<head></head>
<body>
<?php
// this is join table ... retrival
$sql = "SELECT login.emp_name, leave_application.reason FROM login, leave_application WHERE login.slno_empid = leave_application.emp_id GROUP BY login.slno_empid ";

    $rs=mysqli_query($link,$sql) or die(mysqli_error($link));
    echo '<table width="100%" border="0" cellspacing="5" cellpadding="5">';
    while($result=mysqli_fetch_array($rs))
    {
        echo '<tr>
                <td>'.$result["emp_name"].'</td>
                <td>'.$result["reason"].'</td>
              </tr>';
    }
    echo '</table>';
    ?>
</body>

</html>