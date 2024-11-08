<?php include('includes/header.php'); ?>
<?php



// fetch new item 

$item = fetchData("items", $_GET['id']);


// item edit 
$msg = '';
$error = false;




if (isset($_POST['register'])) {



    $sql = "UPDATE items  SET   name=?, total=?, item_price=?, category=?, description=? WHERE id=?";

    $stmt = mysqli_prepare($conn, $sql);

    print_r($stmt);

    mysqli_stmt_bind_param($stmt, 'siissi', $_POST['name'], $_POST['total'], $_POST['item_price'], $_POST['category'], $_POST['description'], $_POST['id']);

    $res = mysqli_stmt_execute($stmt);

    if ($res) {

        setMessage("Updated successfully");


        header('Location:item.list.php');
    } else {
        $error = true;
        $msg = 'error occurred.';
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
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control" autocomplete="name" value="<?php echo $item->name; ?>" required autofocus>
                        </div>

                    </div>
                    <div class="col-sm-4">

                        <div class="form-group">
                            <label for="total">Total</label>
                            <input type="number" name="total" id="total" class="form-control" autocomplete="total" value="<?php echo $item->total; ?>" required>
                        </div>

                    </div>
                    <div class="col-sm-4">

                        <div class="form-group">
                            <label for="item_price">Item Price</label>
                            <input type="text" name="item_price" id="item_price" class="form-control" autocomplete="item_price" value="<?php echo $item->item_price; ?>" required>
                        </div>

                    </div>

                    <div class="col-sm-4">

                        <div class="form-group">
                            <label for="category"> Category</label>
                            <?php $categories = ['Water', 'Goods']; ?>
                            <select for="category" class="form-control" name="category" id="category">
                                <?php foreach ($categories as $category) {
                                ?>
                                    <option <?php $cat = $category == $item->category ? "selected" : "";
                                            echo $cat ?> value="<?php echo $category; ?>"><?php echo $category; ?> </option>

                                <?php } ?>

                            </select>

                        </div>

                    </div>
                    <div class="col-sm-10">

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control" autocomplete="description" required rows="5"><?php echo $item->description; ?></textarea>
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