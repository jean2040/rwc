<?php
	include 'connection.php';
	include 'dbSelect.php';


	
	$count = getCount('logininfo',Array('UserName'=>$_POST['UserName']));
	$count = intval($count);

	if($count === 1){
		$user = getById('logininfo','UserName',$_POST['UserName']);
		
		if(password_verify($_POST['Password'],$user['Password'])){
			session_start();
			$_SESSION['Role']=$user['Role'];
			if($_SESSION['Role']==='coach'){
				$_SESSION['UserID'] = $user['CoachID'];
			}
			elseif ($_SESSION['Role']==='student') {
				$_SESSION['UserID']=$user['StudentID'];
			}
			else{
				$_SESSION['UserID']=NULL;
			}
			echo('UserID: ' . $_SESSION['UserID'] . ', Role: ' . $_SESSION['Role']);
		} 
		else{
			header("Location: ../public/login.php");
			exit();
		}
	}
	else{
		header("Location: ../public/login.php");
		exit();
	}
?>