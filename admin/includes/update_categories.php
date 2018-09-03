                    <form action="#" method="post">
                        <div class="form-group">
                        <label for="cat_title">Edit category</label>
                        <?php //EDIT CATEGORY QUERY

                        if(isset($_GET['edit']))
                        {
                            $cat_id = $_GET['edit'];
                            $select_category_query = "SELECT * FROM categories WHERE cat_id = {$cat_id}";
                            $select_category = mysqli_query($connection, $select_category_query);

                            if(!$select_category)
                            {
                                die("Category not found. " . mysqli_error($connection));
                            }

                        while($category = mysqli_fetch_assoc($select_category))
                            {
                        ?>
                    
                        <input value="<?php echo $category['cat_title']; ?>" type="text" name="cat_title" class="form-control">

                    <?php
                            }

                        }

                    ?>

                    <?php //UPDATE CATEGORY QUERY

                    if(isset($_POST['update_category']))
                    {

                        $cat_title = $_POST['cat_title'];
                        $update_category_query = "UPDATE categories SET cat_title='{$cat_title}' WHERE cat_id={$cat_id}";

                        if(!mysqli_query($connection, $update_category_query))
                        {
                            die("Update category query failed: ".mysqli_error($connection));
                        }

                    }

                    ?>
                        </div>
                           <input type="submit" name="update_category" value="Update Category" class="btn btn-primary">
                        </form>