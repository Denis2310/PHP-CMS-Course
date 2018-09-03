<div class="col-xs-6">

<?php
if(isset($_GET['edit'])) {

	$user_id = $_GET['edit'];
	
	$query_user = "SELECT * FROM users WHERE user_id = $user_id";

	$user = mysqli_query($connection, $query_user);

	confirm($user);

	while($result_user = mysqli_fetch_assoc($user)) {

	$username = $result_user['username'];
	$user_firstname = $result_user['user_firstname'];
	$user_lastname = $result_user['user_lastname'];
	$user_email = $result_user['user_email'];
	$user_password = $result_user['user_password'];
	$user_image = $result_user['user_image'];
	$user_role = $result_user['user_role'];
	}
}

if(isset($_POST['update_user'])) {

	$user_id = $_GET['edit'];

	$username = $_POST['username'];
	$user_firstname = $_POST['user_firstname'];
	$user_lastname = $_POST['user_lastname'];
	$user_email = $_POST['user_email'];
	$user_password = $_POST['user_password'];
	$user_image = $_FILES['user_image']['name'];
	$user_image_tmp = $_FILES['user_image']['tmp_name'];
	$user_role = $_POST['user_role'];

	move_uploaded_file($user_image_tmp, "../user_images/$user_image");

	if(empty($user_image)) {

		$query = "SELECT * FROM users WHERE user_id = $user_id";

		$user_query = mysqli_query($connection, $query);
		confirm($user_query);

		while($user = mysqli_fetch_assoc($user_query)) {

			$user_image = $user['user_image'];
		}
	}


	$query = "SELECT user_randSalt FROM users LIMIT 1";
	$user_randSalt = mysqli_query($connection, $query);
	confirm($user_randSalt);

	$randSalt = mysqli_fetch_array($user_randSalt);
	$salt = $randSalt['user_randSalt'];
	$hashed_password = crypt($user_password, $salt);

	$query = "UPDATE users SET ";
	$query .= "username = '{$username}', ";
	$query .= "user_firstname = '{$user_firstname}', ";
	$query .= "user_lastname = '{$user_lastname}', ";
	$query .= "user_password = '{$hashed_password}', ";
	$query .= "user_email = '{$user_email}', ";
	$query .= "user_image = '{$user_image}', ";
	$query .= "user_role = '{$user_role}' ";
	$query .= "WHERE user_id = {$user_id}";

	$update_user_query = mysqli_query($connection, $query);

	confirm($update_user_query);

	echo "User updated!";
}

?>
<form action="" method="post" enctype="multipart/form-data">
	
	<div class="form-group">
		<label for="username"> Username: </label>
		<input class="form-control" type="text" name="username" value="<?php echo $username; ?>">		
	</div>

	<div class="form-group">
		<label for="user_firstname"> First Name: </label>
		<input class="form-control" name="user_firstname" value="<?php echo $user_firstname; ?>">
	</div>

	<div class="form-group">
		<label for="user_lastname"> Last Name: </label>
		<input class="form-control" type="text" name="user_lastname" value="<?php echo $user_lastname; ?>">		
	</div>

	<div class="form-group">
		<label for="user_email"> Email: </label>
		<input class="form-control" type="email" name="user_email" value="<?php echo $user_email; ?>">		
	</div>

	<div class="form-group">
		<label for="user_password"> Password: </label>
		<input class="form-control" type="password" name="user_password" value="<?php echo $user_password; ?>">		
	</div>

	<div class="form-group">

		<?php if($user_image != '') { ?>

			<img name='user_image' src="../user_images/<?php echo $user_image; ?>" height='100' width='100'>
		<?php } ?>
		<input type="file" name="user_image">		
	</div>

	<div class="form-group">
		<label for="user_role"> Role: </label>
		<select class="form-control" name="user_role" id="">

			<?php 

			$roles = array('admin', 'subscriber');
			foreach($roles as $role)
			{
				if($user_role == $role) {

					echo "<option selected value='$user_role'>$user_role</option>";
				} else {

					echo "<option value='$role'>$role</option>";
				}
			}

			?>

		</select>
	</div>

	<input class="btn btn-primary" type="submit" name="update_user" value="Update User">
</form>
</div>