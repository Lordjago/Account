<?php 
	require 'libraries/connection/config.php';
	if (isset($_POST['proceed'])){
       $callup = strtoupper(htmlentities($_POST['callup']));
       $query = mysqli_query($connect, "SELECT * FROM callup WHERE callup_no ='$callup'");
       $num_row = mysqli_num_rows($query);
    if ($num_row === 1) {
          while ($row = mysqli_fetch_array($query)) {
                    $status = $row['status'];
                }
                //Check if the user has been approved to register
            if ($status ==='False') {
            	  session_start();
                  $_SESSION['callup'] = $_POST['callup'];
                  $setstatus = mysqli_query($connect, "UPDATE callup SET status = 'True' WHERE callup_no = '{$_SESSION['callup']}'");
                  $encodeurl = base64_encode($_SESSION['callup']);
                  header("Location: account_submission.php?r_val=".$encodeurl);
                  
                }elseif ($status ==='True') {
 
                  // echo "<script>swal('Oops!', 'Account Submission was succesfull in your previous attempt, if you think this is a mistake, contact the administrator','error');</script>";
                	echo "<script>alert('Account Submission was succesfull in your previous attempt, if you think this is a mistake, contact the administrator');</script>";
                  
                }
            }else
                {
                	echo "<script>alert('Callup Number not registered');</script>";
                  // echo "<script>swal('Oops!', 'Invalid Callup Number','error');</script>";
                }
       
  }
 ?>

 <!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!--Import Google Icon Font-->
    <link type="text/css" rel="stylesheet" href="assets/css/icon.css">
    <link rel="icon" type="image/png" href="assets/image/nysc-logo.png">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="assets/css/materialize.min.css"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="assets/css/sweetalert.min.css"  media="screen,projection"/>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description" content="Notice board for students">
    <style type="text/css">
    main {
        flex: 1 0 auto;
    }
    body
      {
        display: flex;
        /*min-height: 100vh;*/
        flex-direction: column;
        -webkit-font-smoothing: antialiased;
        font-family: inherit;
        background-image: url(assets/image/bac.jpg);
        background-color: #033560;
        background-position: center center;
        background-size: cover;
        box-shadow: inset 0 0 400px #000000;
      }
      nav{
        height: 60px; 
        margin-top: -4px;
        background-color: #033560; !important;
        -webkit-font-smoothing: antialiased;
        color: #ffffff;
        text-transform: uppercase;
        box-shadow: inset 0 0 400px #000;
        background: rgba(0,0,0,0.1);
    }
      .btn{
        background-color: #00695c;
        border-color: #00695c;
      }
      .btn:hover{
        background-color: #007bff;
        border-color: #007bff;
      }  
      input, select, textarea{
    color: #ff0000;
}

textarea:focus, input:focus {
    color: #ff0000;
}
.hover:input{
cursor: pointer;
}
      
    </style>
</head>
<body>
 <!--JavaScript at end of body for optimized loading-->
    <script type="text/javascript" src="assets/js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="assets/js/materialize.min.js"></script>
    <script type="text/javascript" src="assets/js/sweetalert.min.js"></script>
<main>
  <div class="navbar-fixed">
    <nav> 
    <div class="nav-wrapper">
      <strong class="brand-logo left" id="header" style="font-size: 30px; margin-left: 30px;"><img src="assets/image/nysc-logo.png" style="width: 30px; height: 30px;"> NYSC OYO STATE</strong>
      <a href="#" data-target="mobile-demo" class="sidenav-trigger right"><i class="white-text material-icons ">menu</i></a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
         <li><a  href="index.php" style="color: #ffffff; font-size: 9px; padding-right: 15px;">Home</a></li> 
        <li><a  href="#" style="color: #ffffff; font-size: 9px; padding-right: 15px;">Guides</a></li>
        <li><a class="btn" href="index.php" style="color: #ffffff; font-size: 9px;" id="log">Register</a></li>
      </ul>
    </div>
  </nav>
</div>
  <ul class="sidenav" id="mobile-demo" style="background: rgba(0,0,0,0.4);">
        <li><a  href="index.php" style="color: #ffffff; font-size: 9px; padding-right: 15px;">Home</a></li>
        <li><a  href="#" style="color: #ffffff; font-size: 9px; padding-right: 15px;">Guides</a></li> 
        <li><a class="btn" href="index.php" style="color: #ffffff; font-size: 9px;" id="log">Register</a></li>
  </ul> 

  <div class="row white-text">
    <div class="container white-text">
    <div style="background:rgba(0,0,0,0.7);margin-top: 30px; border-radius: 6px;">
    <p class="red-text" style="margin-left: 13px; padding-top: 30px;">*Note: Official Account opened during orientation course in camp is strictly required. if not available, Please contact <a href="tel:08034238180">08034238180</a> not your personal account.</p>
    <div class="row">

  <!-- Modal Structure -->
  <div id="modal1" class="modal" style="margin-top: 180px; background: grey; height: 300px;">
    <div class="modal-content" style="color: red">
      <div class="input-field col s12">
      <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <label id="label" style="color: red">NYSC Callup Number:</label><br/>
      <input type="text" name="callup" class="white-text" autofocus><br/>
    </div>
    <div class="row">
    <div class="col s3"></div>  
    <div class="col s6 center">   
      <button class="btn waves-effect waves-light center " type="submit" name="proceed" style="background:#00695c; border-radius: 3px; margin-top: 50px;">Proceed
      </button></div></form>
      <div class="col s3"></div>  
    </div>
    </div>
  </div>
    <!-- <div class="input-field col s6">
      <i class="material-icons prefix">filter_tilt_shift</i>
      <label id="label">Account Number:</label><br/>
      <input type="text" name="acc" maxlength="10"  class="white-text"><br/>
    </div> -->
    <div class="row" style="margin-bottom: 350px; padding-top: 100px;">
    <div class="col s3"></div>  
    <div class="col s6 center"> 
      <a class="waves-effect waves-light modal-trigger btn" href="#modal1" >Callup Number Availability</a>   
      </div>
      <div class="col s3"></div>  
    </div>
</div>
    </form>
</div>
  </div></div>
</main>
    <!-- Modal Trigger -->
  

      <script type="text/javascript">
        $(document).ready(function(){
    $('.modal').modal();
  });
     $(document).ready(function(){
    $('.sidenav').sidenav();
  });
  </script>
</main>
