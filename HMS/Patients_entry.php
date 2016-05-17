<?php
//establishing connection
include "Session_checking.php";

	
	//variable declaration
	            $name = '';
				$age = '';
				$sex = '';
				$diag='';
				$treat='';
				$doc_name = '';
				$check='';
				$id='';
				$doc='';
				$doc1='';
	// getting a code for doctors that are in regular doctors and doctors_on_call
	        $query = "SELECT * FROM `".REGULAR_DOCTORS."`;";	
			$doc = mysqli_query($con,$query);
			$query = "SELECT * FROM `".DOCTORS_ON_CALL."`;";	
			$doc1 = mysqli_query($con,$query);
			
	//inserting the record			
	if(!empty($_POST['submit'])&& empty($_POST['remodify']) ){	
		if(!empty($_POST['name']) && !empty($_POST['age']) && !empty($_POST['sex']) && !empty($_POST['diag']) && !empty($_POST['treat']) && !empty($_POST['doc_name'])){ 
			$query = "insert into ".PATIENTS."(name,age,sex,diagnostic,treatement,doc_name) values('".$_POST['name']."' ,".$_POST['age']." ,'".$_POST['sex']."','".$_POST['diag']."','".$_POST['treat']."','".$_POST['doc_name']."');" ;
			echo "".$query."";
			$get = mysqli_query($con,$query);
			echo "".$get."";
				header('location:'.SITE_PATH.'Patients.php');			
		}
		else
		{
		  header('location:'.SITE_PATH.'Patients_entry.php?error=Please Fill All Fileds');	
		}
	
	
	if(!empty($_GET['error'])){
		echo $_GET['error'];
	}
	}
	//delete the record 
	if(!empty($_POST['delete'])){
		$id=$_POST['id'];
		$query = "delete  from ".PATIENTS." where id=".$id.";";
		$get = mysqli_query($con,$query);
		header('location:'.SITE_PATH.'Patients.php');			
		
	}
	
	
	//check if modify button is clicked
	if(!empty($_POST['modify'])){
		$id=$_POST['id'];
		$query = "select * from ".PATIENTS." where id=".$id.";";
		$get = mysqli_query($con,$query);
		$check=true;
		if(mysqli_num_rows($get) > 0 )
		{
				$user = mysqli_fetch_array($get);
				$name = $user['name'];
				$age = $user['age'];
				$sex = $user['sex'];
				$diag=$user['diagnostic'];
				$treat=$user['treatement'];
				$doc_name = $user['doc_name'];
				
		}
	}
	
	//check to actually update the existing data
	if(!empty($_POST['remodify']) && !empty($_POST['id'])){
		$id=$_POST['id'];
		$query = "update ".PATIENTS." set name= '".$_POST['name']."', age=".$_POST['age'].", sex='".$_POST['sex']."' , diagnostic='".$_POST['diag']." ', treatement='".$_POST['treat']." ', doc_name= '".$_POST['doc_name']."' where id=".$id.";" ;
			$get = mysqli_query($con,$query);
		    header('location:'.SITE_PATH.'Patients.php');			
		
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
<p><b>Age</b></p>
<input type='number' name="age"   value ="<?php echo ''.$age.''?>" style='width:200px; height:20px;'/>
<p><b>sex</b></p>
<select name='sex'>
 <option value="<?php echo ''.$sex.''?>"> <?php echo ''.$sex.''?></option>
 
  <?php
  //setting option for mal eor females 
  if($sex!='')
  	{
		if($sex=='Male')
		{
			?>
         <option  value="Female">Female</option>
		<?php 
		}
		else
		{	
		?>
        <option value= "Male">Male</option>
  		<?php
		}
	}
	else
	{
	?>
    <option  value="Female">Female</option>
    <option value= "Male">Male</option>
    <?php
	}
	?>
</select>
<p><b>Diagnostic</b></p>
<input type='text' name="diag"  value ="<?php echo ''.$diag.''?>" style='width:200px; height:20px;'/>
<p><b>Treatement</b></p>
<input type='text' name="treat"  value ="<?php echo ''.$treat.''?>" style='width:200px; height:20px;'/>
<p><b>Doctor Name</b></p>
<select name='doc_name'>
<option value="<?php echo ''.$doc_name.''?>"> <?php echo ''.$doc_name.''?></option>
 
  <?php
  //generating the option for doctors
    if(mysqli_num_rows($doc) > 0){while($user = mysqli_fetch_array($doc)){ 
	if($user['doc_name']!=$doc_name) {?>
	?>
    <option  value="<?php echo ''.$user['doc_name'].''?> "><?php echo ''.$user['doc_name'].''?></option>
    	<?php }}}?>
        <?php
     if(mysqli_num_rows($doc1) > 0){while($user = mysqli_fetch_array($doc1)){ 
	 if($user['doc_name']!=$doc_name) {?>
    <option  value="<?php echo ''.$user['doc_name'].''?> "><?php echo ''.$user['doc_name'].''?></option>
    	<?php }}}?>
 
  
</select>
<br><br>
<input type='submit' value='Submit' name='submit' style='margin-left:150px; height:30px; background-color:#000; color:white; border:thin; text-emphasis:accent' />
</form> 

</div>

</body>
</html>