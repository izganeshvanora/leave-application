<?php
require('connect.php');
?>

<!DOCTYPE html>
<head></head>
<body>
<?php
// this is join table ... retrival
$sql = "SELECT login.emp_name, attendance.day_date, attendance.check_in, attendance.check_out FROM login, attendance WHERE login.slno_empid = attendance.emp_id GROUP BY login.slno_empid ";

    $rs=mysqli_query($link,$sql) or die(mysqli_error($link));
    echo '<table width="80%" border="0" cellspacing="1" cellpadding="1">';
    while($result=mysqli_fetch_array($rs))
    {

            $delta_time = strtotime($result["check_out"]) - strtotime($result["check_in"]);
            $hours = floor($delta_time / 3600);
            $delta_time %= 3600;
            $minutes = floor($delta_time / 60);            



        echo '<tr>
                <td>'.$result["emp_name"].'</td>
                <td>'.$result["day_date"].'</td>
                <td>'.$result["check_in"].'</td>
                <td>'.$result["check_out"].'</td>
                <td>';echo "{$hours} hours ago and {$minutes} minutes";echo '</td>
              </tr>';
    }
    echo '</table>';
    ?>
</body>

</html>