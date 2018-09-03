<div class="col-xs-6">

<?php

if(isset($_POST['add_user'])) {

	$username = $_POST['username'];
	$user_firstname = $_POST['user_firstname'];
	$user_lastname = $_POST['user_lastname'];
	$user_email = $_POST['user_email'];
	$user_password = $_POST['user_password'];

	$user_image = $_FILES['user_image']['name'];
	$user_image_tmp = $_FILES['user_image']['tmp_name'];

	$user_role = $_POST['user_role'];


	move_uploaded_file($user_image_tmp, "../user_images/$user_image");

	$query = "INSERT INTO users(username, user_firstname, user_lastname, user_email, user_password, user_image, user_role) ";
	$query .= "VALUES('{$username}', '{$user_firstname}', '{$user_lastname}', '{$user_email}', '{user_password}', '{$user_image}', '{$user_role}')";

	$user_query= mysqli_query($connection, $query);

	confirm($user_query);

	echo "User is created! "." "."<a href='users.php'>View Users</a>";
	echo "<br>";

}

?>

<form action="" method="post" enctype="multipart/form-data">
	
	<div class="form-group">
		<label for="username"> Username: </label>
		<input class="form-control" type="text" name="username">		
	</div>

	<div class="form-group">
		<label for="user_firstname"> First Name: </label>
		<input class="form-control" name="user_firstname"></input>		
	</div>

	<div class="form-group">
		<label for="user_lastname"> Last Name: </label>
		<input class="form-control" type="text" name="user_lastname">		
	</div>

	<div class="form-group">
		<label for="user_email"> Email: </label>
		<input class="form-control" type="email" name="user_email">		
	</div>

	<div class="form-group">
		<label for="user_password"> Password: </label>
		<input class="form-control" type="password" name="user_password">		
	</div>

	<div class="form-group">
		<label for="user_image"> Image: </label>
		<input type="file" name="user_image">		
	</div>

	<div class="form-group">
		<label for="user_role"> Role: </label>
		<select name="user_role" id="">

				<option value="admin">Admin</option>
				<option selected value="subscriber">Subscriber</option>

		</select>
	</div>

	<input class="btn btn-primary" type="submit" name="add_user" value="Add User">
</form>
</div>