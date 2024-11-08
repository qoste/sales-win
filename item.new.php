<?php include('includes/header.php'); ?>
<?php
// login item and set session
$msg = '';
$error = false;

if (isset($_POST['register'])) {




    $sql = "INSERT INTO `items`(`item_code`,`registered_by_id`,  `name`, `total`, `category`, expiry_date, `item_price`, status, description)
                                VALUES (?,?,?,?,?,?,?,?, ?)";

    $registered_by_id = $user->id;
    $status = 0;
  


    $stmt = mysqli_prepare($conn, $sql);


    mysqli_stmt_bind_param($stmt, 'sisissiis', $_POST['item_code'], $registered_by_id,  $_POST['name'], $_POST['total'], $_POST['category'], $_POST['expiry_date'],  $_POST['item_price'], $status, $_POST['description']);

    mysqli_stmt_execute($stmt);

    if (mysqli_insert_id($conn)) {

        setMessage("Registered successfully!");


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
            <h3 class="card-title">Register new item </h3>
            <a href="item.list.php" class="btn btn-primary btn-sm mx-3 float-right">Back to list</a>


        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">


                <h1 class="h5 mb-3 font-weight-normal">Please Insert required info</h1>

                <div class="row">
                    <div class="col-sm-4">

                        <div class="form-group">
                            <label for="item_code">item code</label>
                            <input type="item_code" value="<?php echo rand(); ?>" name="item_code" id="item_code" class="form-control" required readonly>
                        </div>

                    </div>
                    <div class="col-sm-4">

                        <div class="form-group">
                            <label for="name">Name</label>
                            <select for="name" class="form-control" name="name" id="product_name">
                           <option >Select Item Type</option>
                             
                             <?php 
$item_types = fetchAllData("item_types", "id", "DESC");

foreach ($item_types as $item) { 

                                echo "<option data-mintarget='". $item['min_target']."' data-maxtarget='". $item['max_target']."' value='". $item['name'] ."'>". $item['name'] ."</option>";
}
                                
                                ?>
                                

                            </select>

                        </div>

                    </div>
                    <div class="col-sm-4">

                        <div class="form-group">
                            <label for="product_total">Total</label>
                            <input type="number" name="total" id="product_total" class="form-control" autocomplete="total" required>
                        </div>

                    </div>


                    <div class="col-sm-4">

                        <div class="form-group">
                            <label for="item_price">Item price</label>
                            <input type="number" name="item_price" id="item_price" class="form-control" autocomplete="item_price" required>
                        </div>

                    </div>
                    <div class="col-sm-4">

                        <div class="form-group">
                            <label for="expiry_date">Expiry Date</label>
                            <input type="date" name="expiry_date" id="expiry_date" class="form-control" autocomplete="expiry_date" required>
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