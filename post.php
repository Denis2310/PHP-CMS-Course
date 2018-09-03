    <?php include "includes/database.php"; ?>   
    <?php include "includes/header.php"; ?>

    <!-- Navigation -->
    <?php include "includes/navigation.php"; ?>   

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <?php


                if(isset($_GET['post'])) {

                    $post_id = $_GET['post'];
                }

                    $sql = "SELECT * FROM posts WHERE post_id=$post_id";
                    $select_post = mysqli_query($connection, $sql);

                    if(!$select_post) {

                        die("Error: " .mysqli_error($connection));
                    }

                    while($post = mysqli_fetch_assoc($select_post))
                    {
                        $post_title = $post['post_title'];
                        $post_author = $post['post_author'];
                        $post_date = $post['post_date'];
                        $post_image = $post['post_image'];
                        $post_content = $post['post_content'];

                        ?>

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?post=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                <hr>
                <p><?php echo $post_content; ?></p>

                <hr>

                <?php
                    
                    }

                ?>


                <!-- Blog Comments -->

                <!-- Comments Form -->
                <div class="well">


                <?php

                if(isset($_POST['submit_comment'])) {

                    $comment_author = $_POST['comment_author'];
                    $comment_email = $_POST['comment_email'];
                    $comment_content = $_POST['comment_content'];
                    $comment_status = 'Unapproved';

                    if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content)) {

                        $query = "INSERT INTO comments(post_id, comment_author, comment_email, comment_content, comment_status, comment_date) VALUES(";
                        $query .= "{$post_id}, '{$comment_author}', '{$comment_email}', '{$comment_content}', '{$comment_status}', now() )";

                        $add_comment = mysqli_query($connection, $query);
                        if(!$add_comment) { die("Error: " . mysqli_error($connection)); }

                        $update_comment_count_query = "UPDATE posts SET post_comment_count=post_comment_count + 1 WHERE post_id=$post_id";
                        $update_comment_count = mysqli_query($connection, $update_comment_count_query);
                        if(!$update_comment_count) { die("Error: " . mysqli_error($connection)); }

                    } else {


                        echo "<script> alert('Fields cannot be empty!'); </script>";
                    }



                }

                ?>
                    <h4>Leave a Comment:</h4>
                    <form role="form" method="post" action="">

                        <div class="form-group">
                            <label for="comment_author">Author: </label>
                            <input type="text" class="form-control" name="comment_author">
                        </div>

                        <div class="form-group">
                            <label for="comment_email">Email: </label>
                            <input type="email" class="form-control" name="comment_email">
                        </div>

                        <div class="form-group">
                            <label for="comment_content">Comment: </label>
                            <textarea name="comment_content" class="form-control" rows="3" id="body"></textarea>
                        </div>

                        <button name="submit_comment" type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                <?php

                $query = "SELECT * FROM comments WHERE post_id=$post_id ";
                $query .= "AND comment_status='Approved' ORDER BY comment_id DESC";
                $post_comments_query = mysqli_query($connection, $query);
                if(!$post_comments_query) { die("Error: " . mysqli_error($connection)); }

                while($post_comment = mysqli_fetch_assoc($post_comments_query)) {

                    $comment_author = $post_comment['comment_author'];
                    $comment_content = $post_comment['comment_content'];
                    $comment_date = $post_comment['comment_date'];

                ?>

                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"> <?php echo $comment_author; ?>
                            <small><?php echo $comment_date; ?></small>
                        </h4>
                        
                        <?php echo $comment_content; ?>
                    </div>
                </div>


                <?php

                }

                ?>


               
        </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php" ?>
                    <!-- /.row -->

        </div>
        <!-- /.row -->

        <hr>

<?php include "includes/footer.php"; ?>