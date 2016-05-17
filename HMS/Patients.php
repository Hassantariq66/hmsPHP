<?php
// Connection establish for constant parameters
include "Session_checking.php";

            $query = "SELECT * FROM `".PATIENTS."`;";	
			$get = mysqli_query($con,$query);
			$count=0;
			
?>

<style>

header {
	
    background-color:#000;
    color:#FFF;
    text-align:center;
    padding:5px;	 
}
h1 ,.add_new{
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
table, th,td {
    border: 4px solid black;
    border-collapse: collapse;
}
th,td {
	text-align:center;
    padding: 15px;
}
</style>



</head>
<body background="images/bg2.jpg">

<header>
<h1>Hospital Management System</h1>
</header>
<?php include "header.php" ?>

<h1>Patients Data</h1>

<a id ="add_new" href="Patients_entry.php"><input type="button" value="ADD NEW"  style="border-color:none; width:80px; height:30px; margin-left:630px;" /></a>
<div style="color:#FFF;  margin-left:100px; margin-right:100px; margin-top:20px;">
<table style="width:100% ">
  <tr>
    <th>Name</th>
    <th>Age</th> 
    <th>Sex</th>
    <th>Diagnostic</th>
    <th>Treatment </th>
    <th>Doctor Name</th>
  </tr>
  
   <?php if(mysqli_num_rows($get) > 0){while($user = mysqli_fetch_array($get)){ ?>
  <tr>
    <?php $id=$user['id'] ?>
    
    <td> <?php echo "".$user['name'].""; ?> </td>
    <td> <?php echo "".$user['age'].""; ?> </td>
    <td> <?php echo "".$user['sex'].""; ?> </td>
    <td> <?php echo "".$user['diagnostic'].""; ?> </td>
    <td> <?php echo "".$user['treatement'].""; ?> </td>
     <td> <?php echo "".$user['doc_name'].""; ?> </td>
	<td> <?php echo '<form action="Patients_entry.php" method="post" > <input type="hidden" value="'.$id.'" name="id" /><input type="submit" value="Modify" name="modify" /> </form> '?> </td>
    <td> <?php echo '<form action="Patients_entry.php" method="post" > <input type="hidden" value="'.$id.'" name="id" /><input type="submit" value="Delete" name="delete" /> </form> '?> </td>   
  <?php }} ?>
  </tr>
</table>
</div>

<body>
</body>
</html>