<?php
		//session checking and establishing connection
		include "Session_checking.php";

				$name = '';
				$qual = '';
				$salary = '';
				$address = '';
				$phone = '';
				$check='';
				$id='';
				
	if(!empty($_POST['submit']) && empty($_POST['remodify'])){	
		if(!empty($_POST['name']) && !empty($_POST['qual']) && !empty($_POST['salary'])  && !empty($_POST['address']) && !empty($_POST['phone'])){ 
			$query = "insert into ".DOCTORS_ON_CALL."(doc_name,qulification,salary,address,phone) values('".$_POST['name']."' ,'".$_POST['qual']."' ,".$_POST['salary'].",'".$_POST['address']."','".$_POST['phone']."');" ;
			echo "".$query."";
			$get = mysqli_query($con,$query);
				header('location:'.SITE_PATH.'Doctors_on_call.php');			
		}
		else
		{
		 header('location:'.SITE_PATH.'doctors_entry1.php?error=Please Fill All Fileds');	
		}
	
	
	if(!empty($_GET['error'])){
		echo $_GET['error'];
	}
	}
	//delete the record 
	if(!empty($_POST['delete'])){
		$id=$_POST['id'];
		$query = "delete  from ".DOCTORS_ON_CALL." where id=".$id.";";
		$get = mysqli_query($con,$query);
		header('location:'.SITE_PATH.'Doctors_on_call.php');			
		
	}
	
	
	//check if modify button is clicked
	if(!empty($_POST['modify'])){
		$id=$_POST['id'];
		$query = "select * from ".DOCTORS_ON_CALL." where id=".$id.";"; 
		$get = mysqli_query($con,$query);
		$check=true;
		if(mysqli_num_rows($get) > 0 )
		{
				$user = mysqli_fetch_array($get);
				$name = $user['doc_name'];
				$qual = $user['qulification'];
				$salary = $user['salary'];
				$address = $user['address'];
				$phone = $user['phone'];
		}
	}
	//check to actually update the existing data
	if(!empty($_POST['remodify']) && !empty($_POST['id'])){
		$id=$_POST['id'];
		$query = "update ".DOCTORS_ON_CALL." set doc_name= '".$_POST['name']."', qulification='".$_POST['qual']."', salary=".$_POST['salary']." , address='".$_POST['address']."', phone= '".$_POST['phone']."' where id=".$id.";" ;
			$get = mysqli_query($con,$query);
		    header('location:'.SITE_PATH.'Doctors_on_call.php');			
		
		
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
	//alert("I am in");
    
	if(name=='' || qual==''  || salary=='' || address=='' || phone=='' )
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
<div id='login' >
<form name='myForm' method="post" action=""  onsubmit='return validate()' >
<h1> Doctor Entry Form</h1>
<p><b>Enter Name</b></p>
<input type='text' name="name"   value ="<?php echo ''.$name.''?>"  style=' width:200px; height:20px;' />
<input type='hidden' name="remodify" value="<?php echo ''.$check.''?>" />
<input type='hidden' name="id" value="<?php echo ''.$id.''?>"  />
<p><b>Qualification</b></p>
<input type='text' name="qual"   value ="<?php echo ''.$qual.''?>" style='width:200px; height:20px;'/>
<p><b>Salary</b></p>
<input type='number' name="salary"  value ="<?php echo ''.$salary.''?>" style='width:200px; height:20px;'/>
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