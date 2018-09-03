<?php
if(isset($_GET['edit'])) {

	$comment_id = $_GET['edit'];
	
	$query_comment = "SELECT * FROM comments WHERE comment_id = $comment_id";

	$comment = mysqli_query($connection, $query_comment);

	confirm($comment);

	while($result_comment = mysqli_fetch_assoc($comment)) {

	$comment_content = $result_comment['comment_content'];
	$comment_author = $result_comment['comment_author'];
	$comment_email = $result_comment['comment_email'];
	$comment_post_id = $result_comment['post_id'];
	$comment_status = $result_comment['comment_status'];

	}
}

if(isset($_POST['update_comment'])) {

	$comment_content = $_POST['comment_content'];
	$comment_author = $_POST['comment_author'];
	$comment_email = $_POST['comment_email'];
	$comment_post_id = $_POST['post_id'];
	$comment_status = $_POST['comment_status'];


	$query = "UPDATE comments SET ";
	$query .= "comment_author = '{$comment_author}', ";
	$query .= "post_id = {$comment_post_id}, ";
	$query .= "comment_date = now(), ";
	$query .= "comment_content = '{$comment_content}', ";
	$query .= "comment_email = '{$comment_email}', ";
	$query .= "comment_status = '{$comment_status}' ";
	$query .= "WHERE comment_id = {$comment_id}";

	$update_comment_query = mysqli_query($connection, $query);

	confirm($update_comment_query);

	header("Location: comments.php");
}

?>

<div class="col-xs-6">
<form action="" method="post" enctype="multipart/form-data">
	
	<div class="form-group">
		<label for="comment_author"> Author: </label>
		<input class="form-control" type="text" name="comment_author" value="<?php echo $comment_author; ?>">		
	</div>

	<div class="form-group">
		<label for="comment_email"> Email: </label>
		<input class="form-control" type="text" name="comment_email" value="<?php echo $comment_email; ?>">		
	</div>

	<div class="form-group">
		<label for="comment_status"> Status: </label>
		<select class="form-control" name="comment_status">
			<?php

			if($comment_status == 'Approved') {

				echo "<option selected value='Approved'>Approved</option>";
				echo "<option value='Unapproved'>Unapproved</option>";
			} else {

				echo "<option value='Approved'>Approved</option>";
				echo "<option selected value='Unapproved'>Unapproved</option>";				
			}

			?>
		</select>
	</div>

	<div class="form-group">
		<label for="select_category">In response to: </label>
		<select class="form-control" name="post_id" id="">

			<?php 

				$query = "SELECT * FROM posts";
    			$posts_query = mysqli_query($connection, $query);

    			confirm($posts_query);

    			while($post = mysqli_fetch_assoc($posts_query)) {

    				$post_id = $post['post_id'];
    				$post_title = $post['post_title'];

    				if($post_id == $comment_post_id)
    				{
    					echo "<option selected value='{$post_id}'> {$post_title} </option>";
    				}
    				else
    				{
    					echo "<option  value='{$post_id}'> {$post_title} </option>";
    				}
    				
    			}


			?>

		</select>

	</div>

	<div class="form-group">
		<label for="comment_content"> Comment: </label>
		<textarea class="form-control" name="comment_content" id="body"><?php echo $comment_content; ?></textarea>		
	</div>

	<input class="btn btn-primary" type="submit" name="update_comment" value="Update Comment">
</form>
</div>