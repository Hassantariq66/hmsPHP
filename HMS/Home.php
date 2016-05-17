<?php
include "Session_checking.php";
?>
<!-- Style for for page --->


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
div{
	font-size:18px;
	color:white;
}
</style>
</head>
<body background="images/bg2.jpg">

<header>
<h1>Hospital Management System</h1>
</header>
<?php include "Header.php" ?>
<div>
<p> Hello, <?php echo "<b>".$_SESSION['name']."</b>" ?> Welcome To Hosptial Management System</p>
<p> This management System provides Following things </p>
<ul>
<li > Show,create,update,delete All Doctors including Regular and Doctors Record by using databse and .php page</li>
<li > Show,create,update,delete All Staff member Record by using databse and .php page</li>
<li > Show,create,update,delete All Patients Record by using databse and .php page</li>
<li > Show,create,update,delete All Rooms Record by using databse and .php page</li>
<li > Session Handling </li>
</ul>
</div>

<body>
</body>
</html>