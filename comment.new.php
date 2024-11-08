<?php include('includes/header.php'); ?>
<?php
// login comment and set session
$msg = '';
$error = false;

if (isset($_POST['register'])) {




    $sql = "INSERT INTO `comments`(`comment_code`,`commented_by`,  `title`, `content`,  status, is_anonymous)
                                VALUES (?,?,?,?,?,?)";

    $commented_by = $user->first_name;
    $status = 0;
    $is_anonymous = 0;
    

    $stmt = mysqli_prepare($conn, $sql);


    mysqli_stmt_bind_param($stmt, 'ssssii', $_POST['comment_code'], $commented_by,  $_POST['title'], $_POST['content'],  $status, $is_anonymous);

    mysqli_stmt_execute($stmt);

    if (mysqli_insert_id($conn)) {

        setMessage("Registered successfully!");


        header('Location:comment.list.php');
    } else {
        $error = true;
        $msg = 'error occurred.';
    }
}

?>



<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Send new Comment </h3>
            <a href="comment.list.php" class="btn btn-primary btn-sm mx-3 float-right">Back to list</a>


        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">


                <h1 class="h5 mb-3 font-weight-normal">Please Insert required info</h1>

                <div class="row">
                    <div class="col-sm-4">

                        <div class="form-group">
                            <label for="comment_code">comment code</label>
                            <input type="comment_code" value="<?php echo rand(); ?>" name="comment_code" id="comment_code" class="form-control" required readonly>
                        </div>

                    </div>
                    <div class="col-sm-10">

                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control" autocomplete="title" required autofocus>
                        </div>

                    </div>
                    <div class="col-sm-10">

                        <div class="form-group">
                            <label for="content">content</label>
                            <textarea name="content" id="content" class="form-control" autocomplete="content" required rows="5" cols="10"></textarea>
                        </div>

                    </div>


                </div>


                <input name="register" value="Register" class="btn float-right  btn-info my-3 " type="submit">

                </input>

            </form>

        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
</div>

</div>
</div>

<?php include('includes/footer.php'); ?>