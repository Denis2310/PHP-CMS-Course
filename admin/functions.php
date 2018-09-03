<?php

function confirm($result) {

	global $connection;

	if(!$result) {

		die("Error: " .mysqli_query($connection));
	}
}

function insert_categories(){

	global $connection;

    if(isset($_POST['submit'])) {

    if(empty($_POST['cat_title']) or ($_POST['cat_title'] == ""))
        {
            echo "This field should not be empty.";
        }

    else {

        $category_title = $_POST['cat_title'];
        $add_category_title_query = "INSERT INTO categories(cat_title) VALUES ('$category_title')";

        if(!mysqli_query($connection, $add_category_title_query)) {

             die("Error: ".mysqli_error($connection));
            }
        }
    }
}

function show_categories(){

	global $connection;

    $query = "SELECT * FROM categories";
    $query_all_categories = mysqli_query($connection, $query);

    while($category = mysqli_fetch_assoc($query_all_categories)) {

        $category_id = $category['cat_id'];
        $category_name = $category['cat_title'];

        echo "<tr>";
        echo "<td>{$category_id}</td>";
        echo "<td>{$category_name}</td>";
        echo "<td><a href='categories.php?delete={$category_id}'>Delete</a></td>";
        echo "<td><a href='categories.php?edit={$category_id}'>Edit</a></td>";
        echo "</tr>";
    }
}

function delete_categories(){

	global $connection;

    if(isset($_GET['delete']))
    {
        $category_id = $_GET['delete'];
        $delete_category_query = "DELETE FROM categories WHERE cat_id = {$category_id}";
        
        if(!mysqli_query($connection, $delete_category_query))
        {
            die("Category not deleted: ".mysqli_error($connection));
        }

        header("Location: categories.php");
    }
}

function show_posts(){

	global $connection;

	$query_all_posts = "SELECT * FROM posts";
	$posts = mysqli_query($connection, $query_all_posts);

	confirm($posts);

	while($post = mysqli_fetch_assoc($posts)) {

		echo "<tr>";
		echo "<td><input type='checkbox' class='post_checkbox' name='checkBoxArray[]' value={$post['post_id']}></td>";
		echo "<td>{$post['post_id']}</td>";
		echo "<td>{$post['post_author']}</td>";
		echo "<td><a href='../post.php?post={$post['post_id']}'>{$post['post_title']}</a></td>";

		$category_id = $post['post_category_id'];
		$category_query = "SELECT * FROM categories WHERE cat_id= $category_id";
		$category = mysqli_query($connection, $category_query);
		confirm($category);

		while($post_category = mysqli_fetch_assoc($category)) {

			echo "<td>{$post_category['cat_title']}</td>";
		}

		echo "<td>{$post['post_status']}</td>";
		echo "<td><img src='../images/{$post['post_image']}' width='100' height='100'></img></td>";
		echo "<td>{$post['post_tags']}</td>";
		echo "<td>{$post['post_comment_count']}</td>";
		echo "<td>{$post['post_date']}</td>";
		echo "<td><a href='posts.php?source=edit_post&edit={$post['post_id']}'>Edit</a></td>";
		echo "<td><a onclick=\" javascript: return confirm('Are you sure you want delete this item?'); \" href='posts.php?delete={$post['post_id']}'>Delete</a></td>";
		echo "</tr>";
	}
}

function delete_posts() {

	global $connection;

	if(isset($_GET['delete'])) {

		$post_id = $_GET['delete'];
		$query = "DELETE FROM posts WHERE post_id = $post_id";
		$delete_post = mysqli_query($connection, $query);

		confirm($delete_post);

		header("Location: posts.php");
	}
}

function show_comments() {

	global $connection;

	$query_all_comments = "SELECT * FROM comments";
	$comments = mysqli_query($connection, $query_all_comments);

	confirm($comments);

	while($comment = mysqli_fetch_assoc($comments)) {

		echo "<tr>";
		echo "<td>{$comment['comment_id']}</td>";
		echo "<td>{$comment['comment_author']}</td>";
		echo "<td>{$comment['comment_content']}</td>";
		echo "<td>{$comment['comment_email']}</td>";
		echo "<td>{$comment['comment_status']}</td>";

		$query = "SELECT * FROM posts WHERE post_id= {$comment['post_id']}";
		$post_query = mysqli_query($connection, $query);
		confirm($post_query);

		while($post = mysqli_fetch_assoc($post_query)) {

			echo "<td><a href='../post.php?post={$post['post_id']}'>{$post['post_title']}</a></td>";
		}

		echo "<td>{$comment['comment_date']}</td>";
		echo "<td><a href='comments.php?approve={$comment['comment_id']}'>Approve</a></td>";
		echo "<td><a href='comments.php?unapprove={$comment['comment_id']}'>Unapprove</a></td>";
		echo "<td><a href='comments.php?source=edit_comment&edit={$comment['comment_id']}'>Edit</a></td>";
		echo "<td><a href='comments.php?delete={$comment['comment_id']}'>Delete</a></td>";
		echo "</tr>";
	}
}

function delete_comments() {

	global $connection;

	if(isset($_GET['delete'])) {

		$comment_id = $_GET['delete'];
		$query = "DELETE FROM comments WHERE comment_id = $comment_id";
		$delete_comment = mysqli_query($connection, $query);
		confirm($delete_comment);


		header("Location: comments.php");
	}
}

function show_users() {

	global $connection;

	$query_all_users = "SELECT * FROM users";
	$users = mysqli_query($connection, $query_all_users);

	confirm($users);

	while($user= mysqli_fetch_assoc($users)) {

		echo "<tr>";
		echo "<td>{$user['user_id']}</td>";
		echo "<td>{$user['username']}</td>";
		echo "<td>{$user['user_firstname']}</td>";
		echo "<td>{$user['user_lastname']}</td>";
		echo "<td>{$user['user_email']}</td>";

		if($user['user_image'] == '') { 
			
			echo "<td>Picture is not uploaded</td>"; 
		} else {

			echo "<td><img src='../user_images/{$user['user_image']}' width='100' height='100'></td>";
		}

		echo "<td>{$user['user_role']}</td>";
		echo "<td>";

		echo "<a href='users.php?toadmin={$user['user_id']}'>Admin</a> <br>";
		echo "<a href='users.php?tosubscriber={$user['user_id']}'>Subscriber</a>";

		echo "</td>";
		echo "<td><a href='users.php?source=edit_user&edit={$user['user_id']}'>Edit</a></td>";
		echo "<td><a href='users.php?delete={$user['user_id']}'>Delete</a></td>";
		echo "</tr>";
	}
}

function delete_users() {

	global $connection;

	if(isset($_GET['delete'])) {

		$user_id = $_GET['delete'];
		$query = "DELETE FROM users WHERE user_id = $user_id";
		$delete_user = mysqli_query($connection, $query);
		confirm($delete_user);


		header("Location: users.php");
	}
}

?>