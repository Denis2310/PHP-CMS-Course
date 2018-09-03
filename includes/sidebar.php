            <div class="col-md-4">

                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <form action="search.php" method="post">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit" name="submit">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                    </div>
                    <!-- /.input-group -->
                    </form>
                </div>

                <!-- Login -->

                <?php

                if(isset($_POST['login_submit'])) {}

                ?>

                <div class="well">
                    <h4>Login</h4>
                    <form action="includes/login.php" method="post">
                    <div class="form-group">
                        <input type="text" name="username" class="form-control" placeholder="Enter username">
                    </div>

                    <div class="form-group">
                        <input type="text" name="user_password" class="form-control" placeholder="Enter password">
                    </div>
                    <div class="text-right">
                        <button class="btn btn-primary" type="submit" name="login_submit">
                            Login   
                        </button>
                    </div>
                    

                    </form>
                </div>


                <!-- Blog Categories Well -->
                <div class="well">

                <?php

                $query = "SELECT * FROM categories";

                $query_all_categories = mysqli_query($connection, $query);

                ?>
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">

                            <?php

                                while($category = mysqli_fetch_assoc($query_all_categories)) {
                                    $category_id = $category['cat_id'];
                                    $category_name = $category['cat_title'];
                                    echo "<li><a href='category.php?category=$category_id'>{$category_name}</a></li>";
                                }

                            ?>

                            </ul>
                        </div>


                        <!-- /.col-lg-12 -->
                    </div>

                </div>

                <!-- Side Widget Well -->
                <?php include "widget.php"; ?>

            </div>