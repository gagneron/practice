<?php
	require('connection.php');
	session_start();

?>
<html>
<head>
	<title>Clock In</title>
</head>
<style type="text/css">
	.container{width:960px; margin: 0 auto; min-height:500px; background-color:lightblue;}

</style>
<body>
	<div class='container'>
		<a href="summary.php">Summary</a>
		<h1>Clock In/Out</h1>
		<h2>Step:1 Choose your name</h2>
		<form action="process.php" method='post'>
			<input type='hidden' name='selects'>
		<label for='name'>Name:</label>
		<select name='select'>
			<?php
				$query= "SELECT * FROM users";
				$users= fetch_all($query);
				foreach($users as $user)
				{
					echo "<option value='{$user['id']}'>".$user['first_name'].' '.$user['last_name']."</option>";
				}
			?>
		<input type='submit' value='Update'>
		</select>
		</form>
	
		<?php
			if(isset($_SESSION['name']))
			{
				echo "<h3>Hi ".$_SESSION['name']."!";
				echo "date";
				echo "time";	
			}
			unset($_SESSION['name']);
			echo "<form action='process.php' method='post'>";
			if(isset($_SESSION['clocked_in']))
			{
				echo $_SESSION['clocked_in'];
			}
			unset($_SESSION['clocked_in']);
				echo "</form>";
		?>

	</div>

</body>
</html>