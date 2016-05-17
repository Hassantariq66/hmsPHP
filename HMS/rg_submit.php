<?php
	require_once('./inc/inc.main.php');
	
	echo "before".isset($_POST['name'])."after";				
	if(!empty($_POST['submit'])){	
		if(!empty($_POST['name']) && !empty($_POST['qual']) && !empty($_POST['salary']) && !empty($_POST['entry_time']) && !empty($_POST['exit_time']) && !empty($_POST['phone'])){ 
			echo "php";	
			$query = "insert into ".REGULAR_DOCTORS."(doc_name,qualification,salary,entry_time,exit_time,address,phone) values('".$_POST['name']."' ,'".$_POST['qual']."' ,".$_POST['salary'].",'".$_POST['entry_time']."','".$_POST['exit_time']."','".$_POST['address']."','".$_POST['phone'].");" ;
			echo "".$query."";
			$get = mysqli_query($con,$query);
			echo "".$get."";
				//header('location:'.SITE_PATH.'Regular_doctors.php');			
		}
		else
		{
			//header('location:'.SITE_PATH.'index.php?error=Please Fill All Fileds');	
		}
	
	
	if(!empty($_GET['error'])){
		echo $_GET['error'];
	}
	}	
?>