<?php include('includes/header.php'); ?>
<?php



// fetch new item 

$item = fetchData("item", $_GET['id']);


// item edit 
$msg = '';
$error = false;




if (isset($_POST['register'])) {




    $sql = "UPDATE items  SET  phone=?, first_name=?, middle_name=?, last_name=?, gender=? WHERE id=?";

    $gender = "Female";


    $stmt = mysqli_prepare($conn, $sql);

    print_r($stmt);

    mysqli_stmt_bind_param($stmt, 'sssssi', $_POST['phone'], $_POST['first_name'], $_POST['middle_name'], $_POST['last_name'], $gender, $_POST['id']);

    $res = mysqli_stmt_execute($stmt);

    if ($res) {

        setMessage("Updated successfully");


        header('Location:item.list.php');
    } else {
        $error = true;
        $msg = 'error occuered.';
    }
}

?>



<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit item </h3>
            <a href="item.list.php" class="btn btn-primary btn-sm mx-3 float-right">Back to list</a>


        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="return confirm('are you sure?')">
                <input type="hidden" name="id" value="<?php echo $item->id; ?>" />

                <h1 class="h5 mb-3 font-weight-normal">Please Insert required info</h1>

                <div class="row">

                    <div class="col-sm-4">

                        <div class="form-group">
                            <label for="first-name">First Name</label>
                            <input type="text" name="first_name" id="first-name" class="form-control" autocomplete="first_name" value="<?php echo $item->first_name; ?>" required autofocus>
                        </div>

                    </div>
                    <div class="col-sm-4">

                        <div class="form-group">
                            <label for="middle_name">Middle Name</label>
                            <input type="text" name="middle_name" id="middle_name" class="form-control" autocomplete="middle_name" value="<?php echo $item->middle_name; ?>" required>
                        </div>

                    </div>
                    <div class="col-sm-4">

                        <div class="form-group">
                            <label for="last-name">Last Name</label>
                            <input type="text" name="last_name" id="last-name" class="form-control" autocomplete="last_name" value="<?php echo $item->last_name; ?>" required>
                        </div>

                    </div>
                    <div class="col-sm-4">

                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" name="phone" pattern="(09|\+2519)[0-9]{8}" id="phone" class="form-control" autocomplete="phone" value="<?php echo $item->phone; ?>" required>
                        </div>

                    </div>

                </div>


                <input name="register" value="Update" class="btn float-right  btn-info my-3 " type="submit">

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