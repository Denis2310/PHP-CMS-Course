<?php
    
    if(isset($_POST['checkBoxArray'])) {

        $bulk_options = $_POST['bulk_options'];

        foreach($_POST['checkBoxArray'] as $postValue_Id) {

            switch($bulk_options){

                case 'Published':
                                $query = "UPDATE posts SET post_status='Published' WHERE post_id={$postValue_Id}";
                                $update_to_published = mysqli_query($connection, $query);
                                confirm($update_to_published); break;
                case 'Draft':
                                $query = "UPDATE posts SET post_status='Draft' WHERE post_id={$postValue_Id}";
                                $update_to_draft = mysqli_query($connection, $query);
                                confirm($update_to_draft); break;

                case 'Delete':
                                $query = "DELETE FROM posts WHERE post_id={$postValue_Id}";
                                $delete_post = mysqli_query($connection, $query);
                                confirm($delete_post); break;

                default: die("Something went wrong."); break;
            }
        }
    }

?>

<form method='post' action=''>

    <table class="table table-bordered table-hover">

        <div id="bulkOptionContainer" class="col-sm-4">
            <select class="form-control" name="bulk_options" id="">
                <option>Select Options</option>
                <option value="Published">Publish</option>
                <option value="Draft">Draft</option>
                <option value="Delete">Delete</option>
            </select>
        </div>

        <div class="col-sm-4">
            <button class="btn btn-success" type='submit'>Apply</button>
            <a class="btn btn-primary" href='posts.php?source=add_post'>Add New</a>

        </div>

            


        <thead>
            <tr>
                <th><input id="selectAllBoxes" type="checkbox"></th>
                <th>ID</th>
                <th>Author</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Image</th>
                <th>Tags</th>
                <th>Comments</th>
                <th>Date</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php show_posts(); ?>

            <?php delete_posts(); ?>
        </tbody>
    </table>

</form>