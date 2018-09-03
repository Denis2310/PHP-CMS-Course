<?php
if(isset($_GET['edit'])) {

	$post_id = $_GET['edit'];
	
	$query_post = "SELECT * FROM posts WHERE post_id = $post_id";

	$post = mysqli_query($connection, $query_post);

	confirm($post);

	while($result_post = mysqli_fetch_assoc($post)) {

		$post_title = $result_post['post_title'];
		$post_author = $result_post['post_author'];
		$post_category_id = $result_post['post_category_id'];
		$post_status = $result_post['post_status'];
		$post_image = $result_post['post_image'];
		$post_tags = $result_post['post_tags'];
		$post_content = $result_post['post_content'];
		$post_date = $result_post['post_date'];
		$post_comment_count = $result_post['post_comment_count'];
	}
}

if(isset($_POST['update_post'])) {

	$post_title = $_POST['post_title'];
	$post_author = $_POST['post_author'];
	$post_category_id = $_POST['post_category'];
	$post_status = $_POST['post_status'];
	$post_image = $_FILES['post_image']['name'];
	$post_image_tmp = $_FILES['post_image']['tmp_name'];
	$post_tags = $_POST['post_tags'];
	$post_content = $_POST['post_content'];

	move_uploaded_file($post_image_tmp, "../images/$post_image");

	if(empty($post_image)) {

		$query = "SELECT * FROM posts WHERE post_id = $post_id";

		$post_query = mysqli_query($connection, $query);
		confirm($post_query);

		while($post = mysqli_fetch_assoc($post_query)) {

			$post_image = $post['post_image'];
		}
	}

	$query = "UPDATE posts SET ";
	$query .= "post_title = '{$post_title}', ";
	$query .= "post_category_id = {$post_category_id}, ";
	$query .= "post_date = now(), ";
	$query .= "post_author = '{$post_author}', ";
	$query .= "post_status = '{$post_status}', ";
	$query .= "post_tags = '{$post_tags}', ";
	$query .= "post_content = '{$post_content}', ";
	$query .= "post_image = '{$post_image}' ";
	$query .= "WHERE post_id = {$post_id}";

	$update_post_query = mysqli_query($connection, $query);

	confirm($update_post_query);

	echo "<p class='bg-success'>Post updated. <a href='../post.php?post={$post_id}'>View post</a> or <a href='posts.php'>Edit more posts</a></p>";
}

?>

<div class="col-xs-6">
<form action="" method="post" enctype="multipart/form-data">
	
	<div class="form-group">
		<label for="post_title"> Title: </label>
		<input class="form-control" type="text" name="post_title" value="<?php echo $post_title; ?>">		
	</div>

	<div class="form-group">
		<label for="post_author"> Author: </label>
		<input class="form-control" type="text" name="post_author" value="<?php echo $post_author; ?>">		
	</div>

	<div class="form-group">
		<label for="post_image"> Image: </label>
		<img width='100' src="../images/<?php echo $post_image; ?>"/>
		<input type='file' name='post_image'>
	</div>

	<div class="form-group">
		<label for="select_category">Category: </label>
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
		<input class="form-control" type="text" name="post_tags" value="<?php echo $post_tags; ?>">		
	</div>

	<div class="form-group">
		<label for="post_status"> Status: </label>
		<select class="form-control" name="post_status" id="post_category" style="margin-bottom: 10px;">

			<?php

			if($post_status == 'Draft') {

				echo "<option selected value='Draft'>Draft</option>";
				echo "<option value='Published'>Published</option";
			} else {

				echo "<option value='Draft'>Draft</option>";
				echo "<option selected value='Published'>Published</option";
			}

			?>

		</select>	
	</div>

	<div class="form-group">
		<label for="post_content"> Content: </label>
		<textarea name="post_content" id="body" rows="10"><?php echo $post_content; ?></textarea>		
	</div>

	<input class="btn btn-primary" type="submit" name="update_post" value="Update Post">

</form>
</div>