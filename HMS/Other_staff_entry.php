<?php
	
	include "Session_checking.php";
	
	//variable declaration
	            $name = '';
				$job_type = '';
				$phone='';
				$address = '';
				$check='';
				$id='';		
	//inserting the record			
	if(!empty($_POST['submit'])&& empty($_POST['remodify']) ){	
		//echo 'reached';
		if(!empty($_POST['name']) && !empty($_POST['job_type']) && !empty($_POST['phone']) && !empty($_POST['address']) ){ 
			$query = "insert into ".OTHER_STAFF."(name,job_type,phone,address) values('".$_POST['name']."' ,'".$_POST['job_type']." ','".$_POST['phone']."','".$_POST['address']."');" ;
			echo "".$query."";
			$get = mysqli_query($con,$query);
			//echo $_POST['address'];
			header('location:'.SITE_PATH.'Other_staff.php');			
		}
		else
		{
		  header('location:'.SITE_PATH.'Other_staff_entry.php?error=Please Fill All Fileds');	
		}
	
	
	if(!empty($_GET['error'])){
		echo $_GET['error'];
	}
	}
	//delete the record 
	if(!empty($_POST['delete'])){
		$id=$_POST['id'];
		$query = "delete  from ".OTHER_STAFF." where id=".$id.";";
		$get = mysqli_query($con,$query);
		header('location:'.SITE_PATH.'Other_staff.php');			
		
	}
	
	
	//check if modify button is clicked
	if(!empty($_POST['modify'])){
		$id=$_POST['id'];
		$query = "select * from ".OTHER_STAFF." where id=".$id.";";
		$get = mysqli_query($con,$query);
		$check=true;
		if(mysqli_num_rows($get) > 0 )
		{
				$user = mysqli_fetch_array($get);
				$name = $user['name'];
				$job_type = $user['job_type'];
				$phone= $user['phone'];
				$address=$user['address'];
				
		}
	}
	
	//check to actually update the existing data
	if(!empty($_POST['remodify']) && !empty($_POST['id'])){
		$id=$_POST['id'];
		$query = "update ".OTHER_STAFF." set name= '".$_POST['name']."', job_type='".$_POST['job_type']."' , phone='".$_POST['phone']." ', address='".$_POST['address']."' where id=".$id.";" ;
		//echo ''.$query.'';
			$get = mysqli_query($con,$query);
		   header('location:'.SITE_PATH.'Other_staff.php');			
		
	}
		
?>
<!DOCTYPE html>
<html>
<head>
<style>

header {
	
    background-color:#000;
    color:#FFF;
    text-align:center;
    padding:5px;	 
}
div#login{
	margin-left:500px;
	margin-top:30px;
}
h1,p{
	color:#CCC;
}
</style>
<script>
function validate()
{	
	var name= document.getElementById('name').value;
	var qual= document.getElementById('job_type').value;
	var salary=document.getElementById('phone').value;
	var address=document.getElementById('address').value;
	    
	if(name=='' || type==''  || phone=='' || address=='')
	{
		alert('Please enter the required fields!!')
		return false;
	}
	return true;
}
</script>

<title>Hotel Management System</title>
</head>

<body background='images/bg2.jpg'>

<header>
<h1>Hospital Management System</h1>
</header>
<?php include "Header.php" ?>
<div id='login'>
<form name='myForm' method="post" action="" >
<h1>Other Staff Form</h1>
<p><b>Enter Name</b></p>
<input type='text' name="name"   value ="<?php echo ''.$name.''?>"  style=' width:200px; height:20px;' />
<input type='hidden' name="remodify" value="<?php echo ''.$check.''?>" />
<input type='hidden' name="id" value="<?php echo ''.$id.''?>"  />
<p><b>Job Type</b></p>
<input type='text' name="job_type"   value ="<?php echo ''.$job_type.''?>" style='width:200px; height:20px;'/>
<p><b>Phone</b></p>
<input type='tel' name="phone"  value ="<?php echo ''.$phone.''?>" style='width:200px; height:20px;'/>
<p><b>Address</b></p>
<input type='text' name="address"  value ="<?php echo ''.$address.''?>" style='width:200px; height:20px;'/>
<br><br>
<input type='submit' value='Submit' name='submit' style='margin-left:150px; height:30px; background-color:#000; color:white; border:thin; text-emphasis:accent' />
</form> 
</div>

</body>
</html>