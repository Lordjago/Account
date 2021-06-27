<?php 
//To protect all input by the user from SQL Injection, truncate html tags and trim white spaces
	function protect($data){
		global $connect;
		$data = $connect->real_escape_string(htmlentities(trim($data)));
		return $data;
	}
	//To run the sql query
	function run_query($sql){
		global $connect;
		$runs = mysqli_query($connect, $sql);
		return $runs;
	}
	//Time
	function time_frame(){
		$time = time();
	    $real_date = date('h:i:s A', $time);
	    $real_time = date('d M, Y', $time);
	    // echo $real_date;
	   	// echo $real_time;
	}
	//Attempted Credential by Users
	function login_file_attempts($matric_no, $password, $status, $run){
		$handle = fopen('includes/paths.txt','a');
	    $time = time();
	    $real_date = date('h:i:s A', $time);
	    $real_time = date('d M, Y', $time);
	    $address = $_SERVER['REMOTE_ADDR'];
	    $num_row=mysqli_num_rows($run);
		if ($num_row === 1) {
			$status = 'Login Succesfull';
			$info = "\n\nNew Request made with the following credentials:\nMatric Number: - $matric_no \nPassword: - $password\nStatus: - $status\nAccess Date: - $real_time\nAccess Time: - $real_date\nRemote Address: - $address";
	    	$message = fwrite($handle, $info);
		}else{
			$status = 'Invalid Login Credential';
			$info = "\n\nNew Request made with the following credentials:\nMatric Number: - $matric_no \nPassword: - $password\nStatus: - $status\nAccess Date: - $real_time\nAccess Time: - $real_date\nRemote Address: - $address";
	    	$message = fwrite($handle, $info);
		}
	    
	}
	//Confrimis query runs
	function confirm($result){
		if (!$result) {
			die("<script>swal('Error', 'Contact Administrator','error');</script>");
		}
	}
	//Setting cookies for users
	function cookie(){
		setcookie('matric_no',$_POST['matric_no'], time()+(3600 * 24 * 7 * 365));
        setcookie('password',$_POST['password'], time()+(3600 * 24 * 7 * 365));
        // time()+(3600 * 24 * 7 * 365)
        return true;
	}
	//Un-setting  user cookie
	function cookie_unset(){
		if (isset($_COOKIE['matric_no'])) {
          setcookie('matric_no',"");
        }
        if (isset($_COOKIE['password'])) {
          setcookie('password',"");
        }
	}
	//Create session  for user if login successfull
	function create_sess(){
		session_start();
        $_SESSION['matric_no'] = $_POST['matric_no'];
        $_SESSION['password'] = $_POST['password'];
	} 
	//Check row number to confirm if student is present
	function check_std($num){
		$num_row=mysqli_num_rows($num);
		if ($num_row === 1) {
			create_sess();
			header('location:welcomepage.php');
		}else{
			echo "<script>swal('Oops!!!', 'Invalid login credentials','error');</script>";
		}
	}
	//Authenticate students
	function confirm_std($data){
		global $connect;
	    $matric_no = protect(strtoupper($_POST['matric_no']));
	    $password = protect($_POST['password']);
	    $sql = "SELECT matric_no, password FROM voters WHERE matric_no ='".mysql_real_escape_string($matric_no)."' AND password ='".mysql_real_escape_string($password)."'";
	    $run = run_query($sql);
	    confirm($run);
	    check_std($run);
	    login_file_attempts($matric_no, $password,$status, $run);
	    cookie();
	}
	//Coverting php timestamp to time ago
	function time_Ago($time) { 
    // Calculate difference between current 
    // time and given timestamp in seconds 
    $time_diff     = time() - $time; 
    // Time difference in seconds 
    $second     = $time_diff; 
    // Convert time difference in minutes 
    $minutes     = round($time_diff / 60 ); 
    // Convert time difference in hours 
    $hours    = round($time_diff / 3600); 
    // Convert time difference in days 
    $days     = round($time_diff / 86400 ); 
    // Convert time difference in weeks 
    $weeks     = round($time_diff / 604800); 
    // Convert time difference in months 
    $months     = round($time_diff / 2600640 );
    // Convert time difference in years 
    $years     = round($time_diff / 31207680 ); 
    // Check for seconds 
    if($second <= 60) { 
        $message = "$second seconds ago"; 
        return $message;
    } 
    // Check for minutes 
    else if($minutes <= 60) { 
        if($minutes==1) { 
            $message = "1 minute ago"; 
            return $message;
        } 
        else { 
            $message = "$minutes minutes ago"; 
            return $message;
        } 
    } 
    // Check for hours 
    else if($hours<= 24) { 
        if($hours== 1) {  
            $message = "1 hour ago"; 
            return $message;
        } 
        else { 
            $message = "$hours hour ago"; 
            return $message;
        } 
    } 
    // Check for days 
    else if($days <= 7) { 
        if($days == 1) { 
            $message = "Yesterday"; 
            return $message;
        } 
        else { 
            $message = "$days days ago"; 
            return $message;
        } 
    } 
    // Check for weeks 
    else if($weeks <= 4.3) { 
        if($weeks == 1) { 
            $message = "A week ago"; 
            return $message;
        } 
        else { 
            $message = "$weeks weeks ago"; 
            return $message;
        } 
    } 
    // Check for months 
    else if($months <= 12) { 
        if($months == 1) { 
            $message = "A month ago"; 
            return $message;
        } 
        else { 
            $message = "$months months ago"; 
            return $message;
        } 
    }
    // Check for years 
    else { 
        if($years == 1) { 
            $message = "1 year ago"; 
            return $message;
        } 
        else { 
            $message = "$years years ago"; 
            return $message;
        } 
    } 
} 

 ?>