<?php
  require 'libraries/helper.php';
  if (isset($_POST['reg'])) {
    $sname = strtoupper($_POST['sname']);
    $oname = strtoupper($_POST['oname']);
    $callup_no = $r_val;
    $osc = $_POST['osc'];
    $nsc = $_POST['nsc'];
    $phone = $_POST['phone'];
    $abn = $_POST['abn'];
    $acc = $_POST['acc'];
    $gender = $_POST['gender'];
    $time = time();
    $reg_date = date('Y-m-d H:i:s', $time);
    $query = mysqli_query($connect, "SELECT * FROM datafield WHERE osc='$osc' AND nsc='$nsc'");
    $num_row = mysqli_num_rows($query);
    if (empty($sname) || empty($oname) || empty($osc)||empty($nsc) || empty($phone) || empty($abn) || empty($acc)){
      echo "<script>swal('Oops!', 'You are Expected to fill out all the above credentials','error');</script>";
    }else if ($num_row === 0) {
      mysqli_query($connect, "INSERT INTO datafield (sname, oname, osc,nsc, callup_no , phone, abn, acc, gender, date) VALUES ('$sname', '$oname', '$osc','$nsc', '$callup_no','$phone', '$abn','$acc', '$gender', '$reg_date')");
      echo '<script>swal({
                    text: "Account Submittion Successful",
                    icon: "success",
                  })
                  .then((willDelete) => {
                    if (willDelete) {
                      window.location.href="logout.php";
                    } else {
                      return false;
                    }
                  });</script>';
//       echo "<script>swal('Success', 'Account Submittion Successful','success');</script>";
//       session_start();
//       unset($_SESSION['callup']);
//       session_destroy();
//       echo "<script>
// window.location.href='index.php';
//       </script>";
      
    }
    else{
      echo "<script>swal('Oops!', 'State Code ALready Exist','error');</script>";
    }
  }
?>

  <title>Registration Form</title>
  <style type="text/css">
     #label, label{
      color: white;
      opacity: 2px;
    }
  </style>
  <main>
    <div class="row white-text">
        <div class="container white-text">
    <form method="post" action="account_submission.php?r_val=<?php echo base64_encode($r_val); ?>" class="col s12" style="background:rgba(0,0,0,0.7);margin-top: 10px; border-radius: 6px;">
    <h5 style="color:#ffffff;">RELOCATED - IN CORPS MEMBERS ACCOUNT DETAILS SUBMISSION</h5><br>
    <p class="red-text" style="margin-left: 13px; ">*Note: Official Account opened during orientation course in camp is strictly required. if not available, Please contact <a href="tel:08034238180">08034238180</a> not your personal account.</p>
    <div class="row">
    <div class="input-field col s6">
      <i class="material-icons prefix">account_circle</i>
      <label id="label">Surname:</label><br>
      <input type="text" name="sname" class="white-text"><br>
    </div>
    <div class="input-field col s6">
      <i class="material-icons prefix">assignment_ind</i>
      <label id="label">Other names:</label><br>
      <input type="text" name="oname" class="white-text"><br>
    </div>
    <div class="input-field col s6">
      <i class="material-icons prefix">looks</i>
      <label id="label">Old State Code:</label><br/>
      <input type="text" name="osc"  class="white-text" maxlength="11"><br>
    </div>
    <div class="input-field col s6">
      <i class="material-icons prefix">loop</i>
      <label id="label">New State Code:</label><br/>
      <input type="text" name="nsc"  class="white-text" value="OY/20A/" maxlength="11"><br>
    </div>
    <div class="input-field col s6">
      <i class="material-icons prefix">dialpad</i>
      <label id="label">Phone Number:</label><br/>
      <input type="text" name="phone" class="white-text" maxlength="11"><br>
    </div>
    <div class="input-field col s6">
      <i class="material-icons prefix">attach_money</i>
      <label id="label">Allocated Bank Name:</label><br/>
      <input type="text" name="abn"  class="white-text"><br/>
    </div>
    <div class="input-field col s6">
      <i class="material-icons prefix">filter_tilt_shift</i>
      <label id="label">Account Number:</label><br/>
      <input type="text" name="acc" maxlength="10"  class="white-text"><br/>
    </div>
    <div>
    <label style="margin-left:20px;">Gender:</label><br>
      <label>
        <input style="margin-left:20px;" name="gender" type="radio" value="male" />
        <span>Male</span>
      </label>
    </p>
    <p>
      <label>
        <input style="margin-left:30px;" name="gender" type="radio" value="female" />
        <span>Female</span>
      </label>
    </p>
    <div class="row">
    <div class="col s3"></div>  
    <div class="col s6 center">   
      <button class="btn waves-effect waves-light center " type="submit" name="reg" style="background:#00695c; border-radius: 3px;">Register<i class="material-icons right">send</i>
      </button></div>
      <div class="col s3"></div>  
    </div>
</div>
    </form>
</div>
  </div></div>
</main>
</body>
</html>