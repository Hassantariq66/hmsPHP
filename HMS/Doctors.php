<?php
// Connection establish for constant parameters
	require_once('inc/inc.main.php');
	
// Session check whether it is established
	if(empty($_SESSION['name'])){
		header('location:'.SITE_PATH.'/index.php');
	}
//	
	
?>


<!-- Style for for page --->


<style>
header {
	
    background-color:#000;
    color:#FFF;
    text-align:center;
    padding:5px;	 
}
#center_button{
	margin-top:160px;
	margin-left:600px;
}
div{
	font-size:18px;
	color:white;
}
</style>
<title>Hotel Management System</title>
</head>
<body background="images/bg2.jpg">

<header>
<h1>Hospital Management System</h1>
</header>
<?php include "Header.php" ?>

<div id='center_button'>
<a href="Regular_Doctors.php"><input type="button" value="Regular Doctors"  style="border-color:none; width:120px; height:30px;"/></a>
</br>
</br>
</br>
<a href="Doctors_on_call.php"><input type="button" value="Doctors On Call"  style="border-color:none; width:120px; height:30px; "/></a>
</div>
<body>
</body>
</html>