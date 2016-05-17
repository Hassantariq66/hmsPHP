<?php
        include "Session_checking.php";

            $query = "SELECT * FROM `".ROOMS."`;";	
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

<h1>Rooms Data</h1>

<a id ="add_new" href="room_entry.php"><input type="button" value="ADD NEW"  style="border-color:none; width:80px; height:30px; margin-left:630px;" /></a>
<div style="color:#FFF;  margin-left:100px; margin-right:100px; margin-top:20px;">
<table style="width:100% ">
  <tr>
    <th>Room No</th>
    <th>Room Type</th> 
    <th>Room Status</th>
    <th>Daily Charges</th>
    <th>Patient Name</th>
  </tr>
  
   <?php if(mysqli_num_rows($get) > 0){while($user = mysqli_fetch_array($get)){ ?>
  <tr>
    <?php $id=$user['room_no'] ?>
    
    <td> <?php echo "".$user['room_no'].""; ?> </td>
    <td> <?php echo "".$user['room_type'].""; ?> </td>
    <td> <?php echo "".$user['room_status'].""; ?> </td>
    <td> <?php echo "".$user['daily_charges'].""; ?> </td>
    <td> <?php echo "".$user['patient_name'].""; ?> </td>
     <td> <?php echo '<form action="room_entry.php" method="post" > <input type="hidden" value="'.$id.'" name="id" /><input type="submit" value="Modify" name="modify" /> </form> '?> </td>
    <td> <?php echo '<form action="room_entry.php" method="post" > <input type="hidden" value="'.$id.'" name="id" /><input type="submit" value="Delete" name="delete" /> </form> '?> </td>   
  <?php }} ?>
  </tr>
</table>
</div>

<body>
</body>
</html>