                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Author</th>
                                    <th>Comment</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>In response to</th>
                                    <th>Date</th>
                                    <th>Approve</th>
                                    <th>Unapprove</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php show_comments(); ?>

                            </tbody>
                        </table>

                        <?php delete_comments(); ?>

<?php
    if(isset($_GET['approve'])) {

        $comment_id = $_GET['approve'];
        $query = "UPDATE comments SET comment_status='Approved' WHERE comment_id=$comment_id";
        $approve_comment = mysqli_query($connection, $query);

        confirm($approve_comment);

        header("Location: comments.php");
    }

?>

<?php
    if(isset($_GET['unapprove'])) {

        $comment_id = $_GET['unapprove'];
        $query = "UPDATE comments SET comment_status='Unapproved' WHERE comment_id=$comment_id";
        $unapprove_comment = mysqli_query($connection, $query);

        confirm($unapprove_comment);

        header("Location: comments.php");
    }

?>