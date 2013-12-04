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
	table{border:2px solid black;}
	td{padding:5px;}
</style>
<body>
	<div class='container'>
		<a href="clock.php">Clock In/Out</a>
		<h1>Summary</h1>
		<table>
			<tr>
				<th>Name</th>
				<th>Date</th>
				<th>Clock In</th>
				<th>Clock Out</th>
				<th>Total Hours</th>
				<th>Note</th>
			</tr>
			<?php
				$query = 'SELECT users.first_name, clockins.date, clockins.clock_in, clockins.clock_out, clockins.total_hours, clockins.note FROM users, clockins where users.id = clockins.users_id ORDER BY clockins.clock_in DESC Limit 10 ';
				$query = fetch_all($query);

				foreach($query as $row)
				{
					echo "<tr><td>{$row['first_name']}</td><td>{$row['date']}</td><td>{$row['clock_in']}</td><td>{$row['clock_out']}</td><td>{$row['total_hours']}</td><td>{$row['note']}</td></tr>";
				}

			?>
		</table>

		

	</div>

</body>
</html>