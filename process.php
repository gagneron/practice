<?php
	require('connection.php');
	session_start();

	if(isset($_POST['selects']))
	{
		greeting();
		header('location:clock.php');
	}
	
// $query = "SELECT * FROM users, clockins WHERE users.id ='{$_POST['select']}' and clockins.users_id = users.id ORDER BY clockins.id desc";
// 		var_dump($query);
// 		$query = fetch_record($query);
// 		var_dump($query);
// 		$_SESSION['clock_in'] = $query['clock_in'];


	function greeting()
	{
		//WHERE id ='{$_POST['select']}'
		// $_SESSION['name'] = $_POST['select'];
		$greeting = "SELECT * FROM users where id='{$_POST['select']}'";
		$greeting = fetch_record($greeting);
		$query = "SELECT * FROM clockins, users WHERE users.id ='{$_POST['select']}' and clockins.users_id = users.id ORDER BY clockins.id desc";
		// var_dump($query);
		$query = fetch_record($query);
		// var_dump($query);
		$_SESSION['clock_in'] = $query['clock_in'];
		$_SESSION['id'] = $greeting['id'];
		$_SESSION['name'] = $greeting['first_name'];
		// var_dump($_SESSION['name']);
		if($query AND($query['clock_out'] == NULL))
		{
			echo "not clocked out yet";
			$_SESSION['clocked_in'] = "<textarea name='message' rows=8 cols=50></textarea><input type='hidden' name='clock_out' value='nada'><input type='submit' value='clock out'>";
			// $query = "UPDATE clockins set clock_out = NOW() where clock_in = '{$query['clock_in']}'";
			// $query = mysql_query($query);
			// echo $query;
		}
		else
		{
			$_SESSION['clocked_in'] = "<input type='hidden' name='clock_in'><input type='submit' value='clock in'>";
			
		}
		
		header('location:clock.php');
	}

	if(isset($_POST['clock_out']))
	{
		$query = "UPDATE clockins set clock_out = NOW(), note = '{$_POST['message']}' where clock_in = '{$_SESSION['clock_in']}'";
		mysql_query($query);
			// $query = mysql_query($query);
			echo $query;
			echo "hello";
			//header('location:process.php');
	}
	if(isset($_POST['clock_in']))
	{
		$query = "INSERT INTO clockins (date, clock_in, users_id, updated_at, created_at) VALUES(NOW(), NOW(), '{$_SESSION['id']}', NOW(), NOW())";
		var_dump($query);
		mysql_query($query);
	}
	header('location:clock.php');
	// else
	// {
	// 	if(isset($_POST['select'])){
	// 		echo "why is this on?";
	// 	}
	// 	var_dump($_POST);
	// 	echo "why is not set?";
	// }
	

?>



