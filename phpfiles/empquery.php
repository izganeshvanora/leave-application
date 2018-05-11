<!DOCTYPE html>
<html lang="en">
<head>
  <title>Check-in query | Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">  
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</head>

<body>
    <form action="#" method="GET">
    <div class="container">
    <nav class="navbar navbar-light bg-light db-light">
            <div class="login-info">
                <span class="navbar-brand mb-1"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/1d/Simpleicons_Interface_businessman.svg/1000px-Simpleicons_Interface_businessman.svg.png" alt="profile-pic"/><br/></span>
                <span class="mb-4">Employee name</span>
                <span class="mb-4"><b>[ADMIN]</b></span>
            </div>
            <a class="nav-item nav-link" href="#">Back</a>
    </nav>
    
  <div class = "dashboard-container">        
    <div class="row">
        <div class="col-6">
            <input id="Fromdate" type="date" name="From" />
            <label>To</label>
            <input id="Fromdate" type="date" name="To" value=""/>
        </div>
        <div class="col-2">
            <div class="form-group">
                <select class="form-control" id="timepierods" name="timepierods">
                    <option>All</option>
                    <option>Weekly</option>
                    <option>Monthly</option>
                    <option>Quaterly</option>
                    <option>Yearly</option>
                </select>
            </div> 
        </div>
        <div class="col-2">
          <input class="form-control" id="inputdefault" type="text" name="Empid" placeholder="EmployeeID"/>
        </div>
        <div class="col-2">
          <input type="submit" class="btn-submit" value="Query"/>
        </div>
    </div>
    
  <div class="row">
    <div class="col-12">
        <table class="table table-hover">
            <thead>
                <tr>
                <th>Employee ID</th>
                <th>Employee Name</th>
                <th>last Check-in</th>
                <th>last Check-out</th>
                <th>Current Status</th>
                <th>No. of hours</th>
                </tr>
            </thead>
            <tbody>

                <?php
                  
                    require('connect.php');

                          $from=$_GET['From'];
                          $to=$_GET['To'];
                          $from = date("Y-m-d",strtotime($from));
                          $to = date("Y-m-d",strtotime($to));
                          $present=date("Y-m-d");
                          $tp=$_GET['timepierods'];
                          $empid=$_GET['Empid'];

                    if($from!='1970-01-01' && $to!='1970-01-01'){
                        
                        $sql = "SELECT login.slno_empid, login.emp_name, attendance.day_date, attendance.check_in, attendance.check_out FROM login, attendance WHERE login.slno_empid = attendance.emp_id and attendance.day_date between '$from' and '$to' GROUP BY login.slno_empid ";

                    }elseif($empid!=null){

                        $sql = "SELECT login.slno_empid, login.emp_name, attendance.day_date, attendance.check_in, attendance.check_out FROM login, attendance WHERE login.slno_empid = attendance.emp_id and attendance.emp_id = $empid GROUP BY login.slno_empid ";
                    
                    }elseif ($tp!=null || $tp=='All') {
                       
                    $sql = "SELECT login.slno_empid, login.emp_name, attendance.day_date, attendance.check_in, attendance.check_out FROM login, attendance WHERE login.slno_empid = attendance.emp_id GROUP BY login.slno_empid ";
                    
                    }elseif ($tp=='Weekly') {
                        $w=date('Y-m-d',(strtotime ( '-1 week' , strtotime ( $present) ) ));
                        $sql = "SELECT login.slno_empid, login.emp_name, attendance.day_date, attendance.check_in, attendance.check_out FROM login, attendance WHERE login.slno_empid = attendance.emp_id and attendance.day_date between '$w' and '$present' GROUP BY login.slno_empid ";
                    }elseif ($tp=='Monthly') {
                        $w=date('Y-m-d',(strtotime ( '-1 month' , strtotime ( $present) ) ));
                        $sql = "SELECT login.slno_empid, login.emp_name, attendance.day_date, attendance.check_in, attendance.check_out FROM login, attendance WHERE login.slno_empid = attendance.emp_id and attendance.day_date between '$w' and '$present' GROUP BY login.slno_empid ";
                    }elseif ($tp=='Quaterly') {
                        $w=date('Y-m-d',(strtotime ( '-3 month' , strtotime ( $present) ) ));
                        $sql = "SELECT login.slno_empid, login.emp_name, attendance.day_date, attendance.check_in, attendance.check_out FROM login, attendance WHERE login.slno_empid = attendance.emp_id and attendance.day_date between '$w' and '$present' GROUP BY login.slno_empid ";
                    }elseif ($tp=='Yearly') {
                        $w=date('Y-m-d',(strtotime ( '-1 year' , strtotime ( $present) ) ));
                        $sql = "SELECT login.slno_empid, login.emp_name, attendance.day_date, attendance.check_in, attendance.check_out FROM login, attendance WHERE login.slno_empid = attendance.emp_id and attendance.day_date between '$w' and '$present' GROUP BY login.slno_empid ";
                    }

               $rs=mysqli_query($link,$sql) or die(mysqli_error($link));
    
    while($result=mysqli_fetch_array($rs))
    {

            $delta_time = strtotime($result["check_out"]) - strtotime($result["check_in"]);
            $hours = floor($delta_time / 3600);
            $delta_time %= 3600;
            $minutes = floor($delta_time / 60);            



        echo '<tr>
                <td>'.$result["slno_empid"].'</td>
                <td>'.$result["emp_name"].'</td>
                <td>'.$result["day_date"].'</td>
                <td>'.$result["check_in"].'</td>
                <td>'.$result["check_out"].'</td>
                <td>';echo "{$hours} hours ago and {$minutes} minutes";echo '</td>
              </tr>';
    } ?>
            </tbody>
        </table>
    </div>
  </div>
  </div>
</div>
</form>
</body>


</html>