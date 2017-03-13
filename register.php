

<html>
 <head>
 Register page
 </head>
 <body>
 

<?php
include("config.php");
//Step2
$a=$_POST['username'];
$b=$_POST['passwd'];
$c=$_POST['email'];
$d=$_POST['gender'];
$query = "insert into register values('$a','$b','$c','$d')";

echo "" . '<br />';

if((mysqli_query($db, $query))==1)
{
 echo 'sucessfully registerd as '.$a.'<br />'; 
}
else
{
	echo 'Username is taken or registration error';
}
//Step 4
mysqli_close($db);
?>

<a href="/vulnerable/index.html" >Go back </a>

<script>
if(top != window) {
  top.location = window.location
}

</script>
</body>
</html>