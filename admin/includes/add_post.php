<?php

if(isset($_POST['create_post'])) {

	$post_title = $_POST['post_title'];
	$post_author = $_POST['post_author'];
	$post_category_id = $_POST['post_category'];
	$post_status = $_POST['post_status'];

	$post_image = $_FILES['post_image']['name'];
	$post_image_tmp = $_FILES['post_image']['tmp_name'];

	$post_tags = $_POST['post_tags'];
	$post_content = $_POST['post_content'];
	$post_date = date('d-m-y');


	move_uploaded_file($post_image_tmp, "../images/$post_image");

	$query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) ";
	$query .= "VALUES({$post_category_id}, '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}') ";

	$create_post = mysqli_query($connection, $query);

	confirm($create_post);

	//Get the last added id in database
	$post_id = mysqli_insert_id($connection);
	echo "<p class='bg-success'>Post added. <a href='../post.php?post={$post_id}'>View post</a></p>";

}

?>


<div class="col-xs-6">
<form action="" method="post" enctype="multipart/form-data">
	
	<div class="form-group">
		<label for="post_title"> Title: </label>
		<input class="form-control" type="text" name="post_title">		
	</div>

	<div class="form-group">
		<label for="post_author"> Author: </label>
		<input class="form-control" type="text" name="post_author">		
	</div>

	<div class="form-group">
		<label for="post_image"> Image: </label>
		<input type="file" name="post_image">		
	</div>

	<div class="form-group">
		<label for="post_category"> Category: </label>
		<select class="form-control" name="post_category" id="post_category">

			<?php 

				$query = "SELECT * FROM categories";
    			$categories_query = mysqli_query($connection, $query);

    			confirm($categories_query);

    			while($category = mysqli_fetch_assoc($categories_query)) {

    				$cat_id = $category['cat_id'];
    				$cat_title = $category['cat_title'];

    				echo "<option value='{$cat_id}'> {$cat_title} </option>";
    			}


			?>

		</select>
	</div>

	<div class="form-group">
		<label for="post_tags"> Tags: </label>
		<input class="form-control" type="text" name="post_tags">		
	</div>

	<div class="form-group">
		<label for="post_status"> Status: </label>
		<select class="form-control" name="post_status">
			<option value="Draft">Draft</option>
			<option value="Published">Published</option>
		</select>	
	</div>

	<div class="form-group">
		<label for="post_content"> Content: </label>
		<textarea class="form-control" name="post_content" id="body"></textarea>	
	</div>

	<input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
</form>
</div>