    <?php include "includes/admin_header.php"; ?>
    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/admin_navigation.php"; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">


                        <h1 class="page-header">
                            Profile
                            <small><?php echo $_SESSION['username']; ?></small>
                        </h1>

                <?php

                    if(isset($_SESSION['username'])) {

                        $username = $_SESSION['username'];
                        
                        $query_user = "SELECT * FROM users WHERE username = '$username'";

                        $user = mysqli_query($connection, $query_user);

                        confirm($user);

                        while($result_user = mysqli_fetch_assoc($user)) {

                        $username = $result_user['username'];
                        $user_firstname = $result_user['user_firstname'];
                        $user_lastname = $result_user['user_lastname'];
                        $user_email = $result_user['user_email'];
                        $user_image = $result_user['user_image'];
                        $user_role = $result_user['user_role'];
                        }
                    }

                ?>

                <?php
                if(isset($_POST['update_user'])) {

                    $username = $_POST['username'];
                    $user_firstname = $_POST['user_firstname'];
                    $user_lastname = $_POST['user_lastname'];
                    $user_email = $_POST['user_email'];
                    $user_image = $_FILES['user_image']['name'];
                    $user_image_tmp = $_FILES['user_image']['tmp_name'];
                    $user_role = $_POST['user_role'];

                    move_uploaded_file($user_image_tmp, "../user_images/$user_image");

                    if(empty($user_image)) {

                        $query = "SELECT * FROM users WHERE username = '$username'";

                        $user_query = mysqli_query($connection, $query);
                        confirm($user_query);

                        while($user = mysqli_fetch_assoc($user_query)) {

                            $user_image = $user['user_image'];
                        }
                    }

                    $query = "UPDATE users SET ";
                    $query .= "username = '{$username}', ";
                    $query .= "user_firstname = '{$user_firstname}', ";
                    $query .= "user_lastname = '{$user_lastname}', ";
                    $query .= "user_email = '{$user_email}', ";
                    $query .= "user_image = '{$user_image}', ";
                    $query .= "user_role = '{$user_role}' ";
                    $query .= "WHERE username = '{$username}'";

                    $update_user_query = mysqli_query($connection, $query);

                    confirm($update_user_query);

                    header("Location: profile.php");
                }

                ?>
                        <div class="col-xs-6">
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

                                <?php if($user_image != '') { ?>

                                    <img name='user_image' src="../user_images/<?php echo $user_image; ?>" height='100' width='100'>
                                <?php } ?>
                                <input type="file" name="user_image">       
                            </div>

                            <div class="form-group">
                                <label for="user_role"> Role: </label>
                                <select name="user_role" id="">

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

                            <input class="btn btn-primary" type="submit" name="update_user" value="Update Profile">
                        </form>
                        </div>



                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <?php include "includes/admin_footer.php"; ?>
