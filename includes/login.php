<?php include "database.php"; ?>
<?php session_start(); ?>


<?php 

	if(isset($_POST['login_submit'])) {

		$username = mysqli_real_escape_string($connection, $_POST['username']);
		$password = mysqli_real_escape_string($connection, $_POST['user_password']);

		$query = "SELECT * FROM users WHERE username = '$username'";
		$user_found = mysqli_query($connection, $query);

		if(!$user_found) { die("Error: " . mysqli_error($connection)); }

		while($user = mysqli_fetch_assoc($user_found)) {

			$db_firstname = $user['user_firstname'];
			$db_lastname = $user['user_lastname'];
			$db_username = $user['username'];
			$db_password = $user['user_password'];
			$db_role = $user['user_role'];
		}

		$password = crypt($password, $db_password);


		if( ($username !== $db_username) || ($password !== $db_password)) {

			header("Location: ../index.php");

		} else {

				$_SESSION['username'] = $db_username;
				$_SESSION['user_firstname'] = $db_firstname;
				$_SESSION['user_lastname'] = $db_lastname;
				$_SESSION['user_role'] = $db_role;
				
				header("Location: ../admin");
		}
	}


?>