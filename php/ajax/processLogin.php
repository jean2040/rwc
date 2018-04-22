<?php

	include '../connection.php';
	include '../dbSelect.php';
    session_start();

	$count = getCount('logininfo',Array('UserName'=>$_POST['userName']));
	$count = intval($count);

	if($count === 1){
		$user = getById('logininfo','UserName',$_POST['userName']);
		if(password_verify($_POST['password'],$user['Password'])){

			$_SESSION['Role']=$user['Role'];
			if($_SESSION['Role']==='admin'){
				$_SESSION['UserID'] = $user['CoachID'];
				echo "success";
			}
			elseif ($_SESSION['Role']==='coach') {
				$_SESSION['UserID']=$user['CoachID'];
				echo "success";
			}
			else{
				$_SESSION['UserID']=$user['StudentID'];
                echo "success";
			}

		} 
		else{
			exit();
		}
	}
	else{
		echo "Wrong Credentials";
		exit();
	}
