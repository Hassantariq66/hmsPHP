<?php
	require_once('./inc/inc.main.php');
	if(!empty($_POST['login'])){		
		if(!empty($_POST['id']) && !empty($_POST['pass'])){
			
			$query = "SELECT * FROM `".ADMIN."` WHERE
			name = '".$_POST['id']."' AND
			password = '".$_POST['pass']."';";
			$get = mysqli_query($con,$query);
			if(mysqli_num_rows($get) > 0){
				$user = mysqli_fetch_array($get);
				$id = $user['id'];
				$name = $user['name'];
				echo $_SESSION['id'] = $id;
				echo $_SESSION['name'] = $name;
				header('location:'.SITE_PATH.'Home.php');
			}
			else
			{
				header('location:'.SITE_PATH.'index.php?error=Email Or Password Is Wrong');
			}
			
		}
		else
		{
			header('location:'.SITE_PATH.'index.php?error=Please Fill All Fileds');	
		}
	}
	
	if(!empty($_GET['error'])){
		echo $_GET['error'];
	}	
?>

<?php //generating the required HTML ?>
<!DOCTYPE html>
<html>
<head>
<?php // maaintaning the style ?>
<style>

header {
	
    background-color:#000;
    color:#FFF;
    text-align:center;
    padding:5px;	 
}
div#login{
	margin-left:500px;
	margin-top:80px;
}
p{
	color:white;
}

</style>
<?php // validating using javaScript ?>
<script>
function validate()
{	//var username=document.getElementById("id").value
	var username=document.forms["myForm"]["id"].value;
	var pswd=document.forms["myForm"]["pass"].value;
	if(username==null || username=="" || pswd==null || pswd=="")
	{
		alert("Please enter the required fields!!")
		return false
	}
	
}
</script>
<?php // necessory html to generate page ?>

<title>Hotel Management System</title>
</head>
<?php // getting image from image folder ?>
<body background="images/bg2.jpg">

<header>
<h1>Hospital Management System</h1>
</header>
<hr color="#FF0000" />

<?php // generating form ?>
<div id="login" >
<form action="" method="post" name="myform" onsubmit=" return validate()">
	<p ><b>Enter ID</b></p>
    <input type="text" name="id"  style=" width:200px; height:20px;" />
    <p><b>Password</b></p>
    <input type="password" name="pass" style="width:200px; height:20px;" />
    <br><br>
    <input type="submit" name="login" value="Login" />
</form> 
</div>
</body>
</html>
