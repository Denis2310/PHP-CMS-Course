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
                            Welcome to admin
                            <small><?php echo $_SESSION['username']; ?></small>
                        </h1>

                    </div>
                </div>
                <!-- /.row -->
        
        <?php

            $query = "SELECT * FROM posts";
            $posts = mysqli_query($connection, $query);
            $number_of_posts = mysqli_num_rows($posts);

            $query = "SELECT * FROM posts WHERE post_status='draft'";
            $draft_posts = mysqli_query($connection, $query);
            $number_of_draft_posts = mysqli_num_rows($draft_posts);

        ?>   
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                  <div class='huge'><?php echo $number_of_posts; ?></div>
                                        <div>Posts</div>
                                    </div>
                                </div>
                            </div>
                            <a href="posts.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>

                <?php

                    $query = "SELECT * FROM comments";
                    $comments = mysqli_query($connection, $query);
                    $number_of_comments = mysqli_num_rows($comments);

                    $query = "SELECT * FROM comments WHERE comment_status='unapproved'";
                    $unapproved_comments = mysqli_query($connection, $query);
                    $number_of_unapproved_comments = mysqli_num_rows($unapproved_comments);

                ?> 
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                     <div class='huge'><?php echo $number_of_comments; ?></div>
                                      <div>Comments</div>
                                    </div>
                                </div>
                            </div>
                            <a href="comments.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>

                <?php

                    $query = "SELECT * FROM users";
                    $users = mysqli_query($connection, $query);
                    $number_of_users = mysqli_num_rows($users);

                    $query = "SELECT * FROM users WHERE user_role='subscriber'";
                    $subscribers = mysqli_query($connection, $query);
                    $number_of_subscribers = mysqli_num_rows($subscribers);

                ?> 
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                    <div class='huge'><?php echo $number_of_users; ?></div>
                                        <div> Users</div>
                                    </div>
                                </div>
                            </div>
                            <a href="users.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>

                <?php

                    $query = "SELECT * FROM categories";
                    $categories = mysqli_query($connection, $query);
                    $number_of_categories = mysqli_num_rows($categories);

                ?> 
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class='huge'><?php echo $number_of_categories; ?></div>
                                         <div>Categories</div>
                                    </div>
                                </div>
                            </div>
                            <a href="categories.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>

                </div>
                <!-- /.row -->

                <div class="row">

                <script type="text/javascript">
                  google.charts.load('current', {'packages':['bar']});
                  google.charts.setOnLoadCallback(drawChart);
                  function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                      ['Data', 'Count'],
                      ['All Posts', <?php echo $number_of_posts; ?>],
                      ['Active Posts', <?php echo $number_of_posts - $number_of_draft_posts; ?>],
                      ['Draft Posts', <?php echo $number_of_draft_posts; ?>],
                      ['All Comments', <?php echo $number_of_comments; ?>],
                      ['Active Comments', <?php echo $number_of_comments - $number_of_unapproved_comments; ?>],
                      ['Pending Comments', <?php echo $number_of_unapproved_comments; ?>],
                      ['All Users', <?php echo $number_of_users; ?>],
                      ['Administrators', <?php echo $number_of_users - $number_of_subscribers; ?>],
                      ['Subscribers', <?php echo $number_of_subscribers; ?>],
                      ['Categories', <?php echo $number_of_categories; ?>]
                    ]);

                    var options = {
                      chart: {
                        title: '',
                        subtitle: '',
                      }
                    };

                    var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                    chart.draw(data, google.charts.Bar.convertOptions(options));
                  }
                </script> 

                    <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>

                </div>



            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <?php include "includes/admin_footer.php"; ?>
