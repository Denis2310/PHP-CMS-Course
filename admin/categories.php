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
                            Add Category
                            <small>Subheading</small>
                        </h1>
                    </div>

                    <div class="col-xs-6">

                    <?php insert_categories(); ?>

                        <form action="categories.php" method="post">
                            <div class="form-group">
                                <label for="cat_title">Category title</label>
                                <input type="text" name="cat_title" class="form-control"> 
                            </div>
                           <input type="submit" name="submit" value="Add Category" class="btn btn-primary">
                        </form>

                    <?php

                    if(isset($_GET['edit']))
                    {
                        $cat_id = $_GET['edit'];

                        include "includes/update_categories.php";
                    }

                    ?>

                    </div>

                    <div class="col-xs-6">

                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Category Title</th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php show_categories(); ?>

                            <?php delete_categories(); ?>
                            
                            </tbody>
                        </table>
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
