<?php
//establishing connection
include "Session_checking.php";

	
	//variable declaration
	            $no = '';
				$type = '';
				$status= '';
				$daily_charges='';
				$patient_name='';
				$check='';
				$id='';
				$pat='';
	// getting a code for doctors that are in regular doctors and doctors_on_call
	        $query = "SELECT * FROM `".PATIENTS."`;";	
			$pat = mysqli_query($con,$query);
			
	//inserting the record			
	if(!empty($_POST['submit'])&& empty($_POST['remodify']) ){	
		if(!empty($_POST['no']) && !empty($_POST['type']) && !empty($_POST['status']) && !empty($_POST['daily_charges']) && !empty($_POST['patient_name']) ){ 
			$query = "insert into ".ROOMS."(room_no,room_type,room_status,daily_charges,patient_name) values(".$_POST['no']." ,'".$_POST['type']."' ,'".$_POST['status']."', ".$_POST['daily_charges'].",'".$_POST['patient_name']."');" ;
			echo "".$query."";
			$get = mysqli_query($con,$query);
			echo "".$get."";
			//trasfer back to records
			header('location:'.SITE_PATH.'Rooms.php');			
		}
		else
		{
		  header('location:'.SITE_PATH.'room_entry.php?error=Please Fill All Fileds');	
		}
	
	
	if(!empty($_GET['error'])){
		echo $_GET['error'];
	}
	}
	//delete the record 
	if(!empty($_POST['delete'])){
		$id=$_POST['id'];
		$query = "delete  from ".ROOMS." where room_no=".$id.";";
		$get = mysqli_query($con,$query);
		header('location:'.SITE_PATH.'Rooms.php');			
		
	}
	
	
	//check if modify button is clicked
	if(!empty($_POST['modify'])){
		$id=$_POST['id'];
		$query = "select * from ".ROOMS." where room_no=".$id.";";
		$get = mysqli_query($con,$query);
		$check=true;
		if(mysqli_num_rows($get) > 0 )
		{
				$user = mysqli_fetch_array($get);
				$no = $user['room_no'];
				$type = $user['room_type'];
				$status = $user['room_status'];
				$daily_charges=$user['daily_charges'];
				$patient_name=$user['patient_name'];
				
		}
	}
	
	//check to actually update the existing data
	if(!empty($_POST['remodify']) && !empty($_POST['id'])){
		$id=$_POST['id'];
		$query = "update ".ROOMS." set room_no= ".$_POST['no'].", room_type='".$_POST['type']."', room_status='".$_POST['status']."' , daily_charges=".$_POST['daily_charges']." , patient_name='".$_POST['patient_name']."' where id=".$id.";" ;
			$get = mysqli_query($con,$query);
		    header('location:'.SITE_PATH.'Rooms.php');			
		
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


<title>Hotel Management System</title>
</head>

<body background='images/bg2.jpg'>

<header>
<h1>Hospital Management System</h1>
</header>
<?php include "Header.php" ?>
<div id='login'>
<form name='myForm' method="post" action="" onsubmit='return validate()' >
<h1> Room Entry Form</h1>
<p><b>Room no</b></p>
<input type='number' name="no"   value ="<?php echo ''.$no.''?>"  style=' width:200px; height:20px;' />
<input type='hidden' name="remodify" value="<?php echo ''.$check.''?>" />
<input type='hidden' name="id" value="<?php echo ''.$id.''?>"  />
<p><b>Room Type</b></p>
<input type='text' name="type"   value ="<?php echo ''.$type.''?>" style='width:200px; height:20px;'/>
<p><b>Room Status</b></p>
<select name='status'>
<option value="<?php echo ''.$status.''?>"> <?php echo ''.$status.''?></option>
 
 <?php
  //setting option for mal eor females 
  if($status!='')
  	{
		if($status=='available')
		{
			?>
         <option  value="unavailable">Unavailable</option>
		<?php 
		}
		else
		{	
		?>
        <option value= "available">available</option>
  		<?php
		}
	}
	else
	{
	?>
    <option  value="available">Available</option>
    <option value= "unavailable">Unavailable</option>
    <?php
	}
	?>  
</select>
<p><b>Daily Charges</b></p>
<input type='number' name="daily_charges"  value ="<?php echo ''.$daily_charges.''?>" style='width:200px; height:20px;'/>
<p><b>Patient Name</b></p>
<select name='patient_name'>
<option value="<?php echo ''.$patient_name.''?>"> <?php echo ''.$patient_name.''?></option>
 
  <?php
  //generating the option for doctors
    if(mysqli_num_rows($pat) > 0){while($user = mysqli_fetch_array($pat)){ 
	if($user['name']!=$patient_name) {?>
	?>
    <option  value="<?php echo ''.$user['name'].''?> "><?php echo ''.$user['name'].''?></option>
    	<?php }}}?>
</select>
<br><br>
<input type='submit' value='Submit' name='submit' style='margin-left:150px; height:30px; background-color:#000; color:white; border:thin; text-emphasis:accent' />
</form> 

</div>

</body>
</html>