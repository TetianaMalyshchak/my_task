<?php
include 'connect.php';
$sql = "SELECT * FROM country;";
 
$result = mysqli_query($link,$sql);
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
	<title>Site</title>
</head>
<body>
<div class="wrapper">

	<form action="registration.php" method="POST">
		Email:<input type="email" name="email" placeholder="email"><br/>
		Login:<input type="text" name="login" placeholder="Login"><br/>
		Real name:<input type="text" name="real_name" placeholder="Real name"><br/>
		Password:<input type="password" name="password" placeholder="password"><br/>
		Birth date<input type="date" name="birth_date"><br/>
		 <p><select size="1" name="select">
    <option disabled>Выберите страну</option>
    <?php while($object = mysqli_fetch_assoc($result)):?>
    <option value ="<?=$object['name_country']?>"><?=$object['name_country']; ?></option>
    <?php endwhile;?>
   </select></p>
  
		<input type="checkbox" name="checkme">agree with terms and conditions <br/>
		<input type="submit" name="Sign in" value="Sign in">
	</form>
</div>
</body>
</html>
