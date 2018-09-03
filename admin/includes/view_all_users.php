                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Username</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Image</th>
                                    <th>Current Role</th>
                                    <th>Change Role</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php show_users(); ?>

                            </tbody>
                        </table>

                        <?php delete_users(); ?>

<?php
    if(isset($_GET['toadmin'])) {

        $user_id = $_GET['toadmin'];
        $query = "UPDATE users SET user_role='admin' WHERE user_id=$user_id";
        $user_to_admin = mysqli_query($connection, $query);

        confirm($user_to_admin);

        header("Location: users.php");
    }

?>

<?php
    if(isset($_GET['tosubscriber'])) {

        $user_id = $_GET['tosubscriber'];
        $query = "UPDATE users SET user_role='subscriber' WHERE user_id=$user_id";
        $user_to_subscriber = mysqli_query($connection, $query);

        confirm($user_to_subscriber);

        header("Location: users.php");
    }

?>