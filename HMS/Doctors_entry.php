<?php
	include "Session_checking.php";
	            $name = '';
				$qual = '';
				$salary = '';
				$entry_time='';
				$exit_time='';
				$address = '';
				$phone = '';
				$check='';
				$id='';
	//inserting the record			
	if(!empty($_POST['submit'])&& empty($_POST['remodify']) ){	
		if(!empty($_POST['name']) && !empty($_POST['qual']) && !empty($_POST['salary']) && !empty($_POST['entry_time']) && !empty($_POST['exit_time']) && !empty($_POST['phone'])){ 
			$query = "insert into ".REGULAR_DOCTORS."(doc_name,qualification,salary,entry_time,exit_time,address,phone) values('".$_POST['name']."' ,'".$_POST['qual']."' ,".$_POST['salary'].",'".$_POST['entry_time']."','".$_POST['exit_time']."','".$_POST['address']."','".$_POST['phone']."');" ;
			echo "".$query."";
			$get = mysqli_query($con,$query);
			echo "".$get."";
				header('location:'.SITE_PATH.'Regular_doctors.php');			
		}
		else
		{
		  header('location:'.SITE_PATH.'Doctors_entry.php?error=Please Fill All Fileds');	
		}
	
	
	if(!empty($_GET['error'])){
		echo $_GET['error'];
	}
	}
	//delete the record 
	if(!empty($_POST['delete'])){
		$id=$_POST['id'];
		$query = "delete  from ".REGULAR_DOCTORS." where id=".$id.";";
		$get = mysqli_query($con,$query);
		header('location:'.SITE_PATH.'Regular_doctors.php');			
		
	}
	
	
	//check if modify button is clicked
	if(!empty($_POST['modify'])){
		$id=$_POST['id'];
		$query = "select * from ".REGULAR_DOCTORS." where id=".$id.";";
		$get = mysqli_query($con,$query);
		$check=true;
		if(mysqli_num_rows($get) > 0 )
		{
				$user = mysqli_fetch_array($get);
				$name = $user['doc_name'];
				$qual = $user['qualification'];
				$salary = $user['salary'];
				$entry_time=$user['entry_time'];
				$exit_time=$user['exit_time'];
				$address = $user['address'];
				$phone = $user['phone'];
				
		}
	}
	
	//check to actually update the existing data
	if(!empty($_POST['remodify']) && !empty($_POST['id'])){
		$id=$_POST['id'];
		$query = "update ".REGULAR_DOCTORS." set doc_name= '".$_POST['name']."', qualification='".$_POST['qual']."', salary=".$_POST['salary']." , entry_time='".$_POST['entry_time']." ', exit_time='".$_POST['exit_time']." ', address='".$_POST['address']."', phone= '".$_POST['phone']."' where id=".$id.";" ;
			$get = mysqli_query($con,$query);
		    header('location:'.SITE_PATH.'Regular_doctors.php');			
		
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
	var qual= document.getElementById('qual').value;
	var salary=document.getElementById('salary').value;
	var address=document.getElementById('address').value;
	var phone=document.getElementById('phone').value;
    var ent=document.getElementById('entry_time').value;
	var ext=document.getElementById('exit_time').value;
	//alert("I am in");
    
	if(name=='' || qual==''  || salary=='' || address=='' || phone=='' || ent=='' || ext=='')
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
<form name='myForm' method="post" action="" onsubmit='return validate()' >
<h1> Doctor Entry Form</h1>
<p><b>Enter Name</b></p>
<input type='text' name="name"   value ="<?php echo ''.$name.''?>"  style=' width:200px; height:20px;' />
<input type='hidden' name="remodify" value="<?php echo ''.$check.''?>" />
<input type='hidden' name="id" value="<?php echo ''.$id.''?>"  />
<p><b>Qualification</b></p>
<input type='text' name="qual"   value ="<?php echo ''.$qual.''?>" style='width:200px; height:20px;'/>
<p><b>Salary</b></p>
<input type='number' name="salary"  value ="<?php echo ''.$salary.''?>" style='width:200px; height:20px;'/>
<p><b>Entry Time</b></p>
<input type='time' name="entry_time"  value ="<?php echo ''.$entry_time.''?>" style='width:200px; height:20px;'/>
<p><b>Exit Time</b></p>
<input type='time' name="exit_time"  value ="<?php echo ''.$exit_time.''?>" style='width:200px; height:20px;'/>
<p><b>Address</b></p>
<input type='text' name="address"  value ="<?php echo ''.$address.''?>"style='width:200px; height:20px;'/>
<p><b>Phone</b></p>
<input type='text' name="phone"  value ="<?php echo ''.$phone.''?>" style='width:200px; height:20px;'/>
<br><br>
<input type='submit' value='Submit' name='submit' style='margin-left:150px; height:30px; background-color:#000; color:white; border:thin; text-emphasis:accent' />
</form> 

</div>

</body>
</html>