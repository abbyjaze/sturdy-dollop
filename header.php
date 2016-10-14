<?php
session_start();
error_reporting();
echo '<!DOCTYPE html>';
echo '<head>';
    if(isset($_SESSION['login'])){
              $timeout = 300; // Number of seconds until it times out.
               
              // Check if the timeout field exists.
              if(isset($_SESSION['timeout'])) {
                  // See if the number of seconds since the last
                  // visit is larger than the timeout period.
                  $duration = time() - (int)$_SESSION['timeout'];
                  if($duration > $timeout) {
                      // Destroy the session and restart it.
                      header('Location: logout.php');  
                  }
              }
               
              // Update the timout field with the current time.
              $_SESSION['timeout'] = time();
          }
      if(isset($_REQUEST['submit']))
      if($_REQUEST['submit']=='Sign Me IN!') {
          extract($_REQUEST);
          $email=htmlspecialchars(trim($_REQUEST['email']));
          $passwd=md5(htmlspecialchars(trim($_REQUEST['passwd'])));
          $performing_login=get_employers("WHERE email='$email' AND pwd='$passwd'");

          $hua_login = mysqli_query($GLOBALS['conn'],$performing_login) or die(mysqli_error($GLOBALS['conn']));
          
          if(mysqli_num_rows($hua_login)!=1){
              $found="N";
              echo "nahi hua login";
          }
          else{
              $_SESSION['login']=$email;
              header('Location: index.php');  
          }
         // header('Location: index.php'); 
      }
  //if(!isset($_SESSION['login']) && $_SESSION['access']=='private')
  //    header('Location: index.php');
  ?>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <?php
  include("include_files.php");
  ?>
  <title>
    <?php
      $basename=basename($_SERVER['PHP_SELF']);
      if($basename=='index.php')
        if(isset($_SESSION['login']))
          if($_SESSION['user']=='employer')
            echo 'Employer\'s Page';
          else
            echo 'Students\' Page';
        else
          echo 'Internship Portal';
      if($basename=='review_applications.php')
        echo 'Review Applications';
      ?>
  </title>
</head>
        <?php
        echo '<body>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Internship Portal</a>
    </div>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="index.php">Home</a></li>';

            if (isset($_SESSION['login'])){
                //write code to goto index page after being logged out
                echo '<li><a href="logout.php">Logout</a></li>';
                //var_dump($_SESSION);
            }
            else{
                //write code to login with a modal form over the pages and stay on index page
                //echo '<li class="'.$basename=basename($_SERVER['PHP_SELF'])=='take_a_test.php' ? 'active' : NULL;
                //echo '"><a href="take_a_test.php">Take A Test</a></li>';
                //var_dump($_SESSION);
                echo '<li><a data-toggle="modal" data-target="#login_Modal2" role="button">Login as Employer</a></li>';
                echo '<li><a data-toggle="modal" data-target="#login_Modal" role="button">Login as Student</a></li>';
                echo '<li><a data-toggle="modal" data-target="#register_Modal2" role="button">Register as Employer</a></li>';
                echo '<li><a data-toggle="modal" data-target="#register_Modal" role="button">Register as Student</a></li>';
            }
            echo '    </ul>
  </div>
</nav>
<div class="container-fluid">';
        ?>
<?php
//put in a modal form for login
echo '
<div id="login_Modal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" data-keyboard="true">&times;</button>
        <h4 class="modal-title"><center>LOGIN as STUDENT</center></h4>
      </div>
      <div class="modal-body">
        <form id="signin_form" method="post" action="check_login.php" ><center>
            <input name="email" type="email" placeholder="Email?" required="required" class="form-control input-sm"/><br>
            <input name="passwd" type="password" placeholder="Password?" required="required" class="form-control input-sm" id="passwordsignin"/><br>
            <input name="submit" type="submit" value="Sign Me IN!" class="btn btn-primary btn-block"  />
        </form>

      </div>
    </div>

  </div>
</div>';

echo '
<div id="login_Modal2" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" data-keyboard="true">&times;</button>
        <h4 class="modal-title"><center>LOGIN as EMPLOYER</center></h4>
      </div>
      <div class="modal-body">
        <form id="signin_form" method="post" action="check_login.php" ><center>
            <input name="email" type="email" placeholder="Email?" required="required" class="form-control input-sm"/><br>
            <input name="passwd" type="password" placeholder="Password?" required="required" class="form-control input-sm" id="passwordsignin"/><br>
            <input name="submit2" type="submit" value="Sign Me IN!" class="btn btn-primary btn-block"  />
        </form>

      </div>
    </div>

  </div>
</div>';

echo '
<div id="register_Modal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" data-keyboard="true">&times;</button>
        <h4 class="modal-title"><center>REGISTER as STUDENT</center></h4>
      </div>
      <div class="modal-body">
        <table class="table table-responsive table-hover">
            <form id="register_form" method="post" action="registration_done.php"><center>
            <tbody>
            <tr>
                <td><input name="stu_name" type="text" placeholder="Your Name?" required="required" class="form-control input-sm"/><br></td>
            </tr>
            <tr>    
                <td><input name="stu_email" type="email" placeholder="Email?" required="required" class="form-control input-sm"/><br></td>
            </tr>
            <tr>    
                <td><input name="stu_pass" type="password" placeholder="Password?" required="required" class="form-control input-sm" /><br></td>
            </tr>
            <tr>    
                <td><select name="stu_qual" placeholder="Qualifications" class="form-control input-sm" required="required">
                  <option value="10th">10th</option>
                  <option value="12th">12th</option>
                  <option value="Under Graduation">Under Graduation</option>
                  <option value="Graduate">Graduate</option>
                  <option value="Post Graduate">Post Graduate</option>
                </select><br></td>
            </tr>
            <tr>    
                <td><input name="stu_contact" placeholder="Contact Number" class="form-control input-sm" required="required" type="number" maxlength="10" /><br></td>
            </tr>
            <tr>
                <td colspan="2"><br><input name="submit" type="submit" value="Register" class="btn btn-primary btn-block" /></td>
            </tr>
            </tbody>
            </form>
        </table>
      </div>
    </div>

  </div>
</div>';


echo '
<div id="register_Modal2" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" data-keyboard="true">&times;</button>
        <h4 class="modal-title"><center>REGISTER as EMPLOYER</center></h4>
      </div>
      <div class="modal-body">
        <table class="table table-responsive table-hover">
            <form id="register_form" method="post" onsubmit="return validateEmployer()" action="registration_done.php"><center>
            <tbody>
            <tr>
                <td><input name="emp_name" type="text" placeholder="Your Name?" required="required" class="form-control input-sm"/><br></td>
            </tr>
            <tr>    
                <td><input name="emp_email" type="email" placeholder="Email?" required="required" class="form-control input-sm"/><br></td>
            </tr>
            <tr>    
                <td><input name="emp_pass" id="pass1" type="password" placeholder="Password?" required="required" class="form-control input-sm" /><br></td>
            </tr>
            <tr>    
                <td><input name="emp_addr" type="text" placeholder="Address?" required="required" class="form-control input-sm"/><br></td>
            </tr>
            <tr>
                <td colspan="2"><br><input name="submit2" type="submit" value="Register" class="btn btn-primary btn-block" /></td>
            </tr>
            </tbody>
            </form>
        </table>
      </div>
    </div>

  </div>
</div>';

?>