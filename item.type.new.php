<?php include('includes/header.php'); ?>
<?php
// login item and set session
$msg = '';
$error = false;

if (isset($_POST['register'])) {




    $sql = "INSERT INTO `item_types`(`item_type_code`,`registered_by_id`,  `name`, `min_target`,`max_target`, `category`, status, description)
                                VALUES (?,?,?,?,?,?,?,?)";

    $allergies = "";
    $registered_by_id = $user->id;
    $status = 0;


    $stmt = mysqli_prepare($conn, $sql);


    mysqli_stmt_bind_param($stmt, 'sisiisss', $_POST['item_type_code'], $registered_by_id,  $_POST['name'], $_POST['min_target'],  $_POST['max_target'], $_POST['category'],  $status, $_POST['description']);

    mysqli_stmt_execute($stmt);

    if (mysqli_insert_id($conn)) {

        setMessage("Registered successfully!");


        header('Location:item.type.list.php');
    } else {
        $error = true;
        $msg = 'error occurred.';
    }
}

?>



<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Register new Product Type </h3>
            <a href="item.type.list.php" class="btn btn-primary btn-sm mx-3 float-right">Back to list</a>


        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">


                <h1 class="h5 mb-3 font-weight-normal">Please Insert required info</h1>

                <div class="row">
                    <div class="col-sm-4">

                        <div class="form-group">
                            <label for="item_type_code">Product Type code</label>
                            <input type="item_type_code" value="<?php echo rand(); ?>" name="item_type_code" id="item_type_code" class="form-control" required readonly>
                        </div>

                    </div>
                    <div class="col-sm-4">

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control" autocomplete="name" required autofocus>
                        </div>

                    </div>
                    <div class="col-sm-4">

                        <div class="form-group">
                            <label for="min_target">Min Target</label>
                            <input type="number" name="min_target" id="min_target" min="0" class="form-control" autocomplete="total" required>
                        </div>

                    </div>
                    <div class="col-sm-4">

                        <div class="form-group">
                            <label for="max_target">Max Target</label>
                            <input type="number" name="max_target" id="max_target" min="0" class="form-control" autocomplete="total" required>
                        </div>

                    </div>


                    <div class="col-sm-4">

                        <div class="form-group">
                            <label for="category"> category</label>
                            <select for="category" class="form-control" name="category" id="category">
                                <option value="Water">Water</option>
                                <option value="Goods">Goods</option>


                            </select>

                        </div>

                    </div>
                    <div class="col-sm-10">

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control" autocomplete="description" required rows="5"></textarea>
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