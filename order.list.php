<?php include('includes/header.php'); ?>

<?php

if (isset($_POST['delete'])) {

    $sql = "DELETE FROM orders WHERE id=" . $_POST['order_id'];
    if (mysqli_query($conn, $sql)) {

        setMessage("Deleted successfully");

        header('Location:order.list.php');
    }
}


// login Order and set session
$msg = '';
$error = false;

$sql = "SELECT * FROM orders";
$result = mysqli_query($conn, $sql);





?>


<div class="col-12">

    <h4>Order list </h4>
</div>

<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"> Orders list</h3>
            <a href="order.new.php" class="btn btn-primary btn-sm mx-3">New Order</a>

            <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <table class="table table-hover ">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Order code</th>
                        <th>Item code</th>

                        <th>Name</th>
                        <th>Category</th>
                        <th>Item Price</th>
                        <th>Item Quantity</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th>Ordered By</th>

                        <th>Ordered At</th>
                        <th>Actions</th>

                    </tr>
                </thead>
                <tbody>
                    <?php

                    if (mysqli_num_rows($result) > 0) {
                        // output data of each row
                        while ($row = mysqli_fetch_assoc($result)) {
                            $item_sql = "SELECT * FROM items WHERE id = " . $row['item_id'];
                            $item_qu = mysqli_query($conn, $item_sql);
                            $item_result = mysqli_fetch_assoc($item_qu);

                            $user_sql = "SELECT * FROM user WHERE id = " . $row['ordered_by'];
                            $user_qu = mysqli_query($conn, $user_sql);
                            $user_result = mysqli_fetch_assoc($user_qu);
                            if ($user_result['user_type_id'] != 1 && $user_result['id'] != $user->id) {
                                continue;
                            }



                    ?>
                            <tr>
                                <td><?php echo $row['id'] ?></td>
                                <td><?php echo $row['order_code'] ?></td>
                                <td><?php echo $item_result['item_code'] ?></td>

                                <td><?php echo $item_result['name']  ?></td>
                                <td><?php echo $item_result['category']  ?></td>
                                <td><?php echo $row['item_price']  ?>ETB</td>
                                <td><?php echo $row['quantity']  ?></td>
                                <td><?php echo $row['item_price'] * $row['quantity']  ?>ETB</td>
                                <td><span class="tag tag-success"><?php echo $row['status'] ?></span></td>
                                <td><?php echo $user_result['first_name'] . ' ' . $user_result['last_name'] ?></td>
                                <td><?php echo $row['ordered_at'] ?></td>
                                <td>
                                    <form method="post" onsubmit="return confirm('are you sure you want to delete this order');" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="form-horizontal form-inline">
                                        <input type="hidden" name="order_id" value="<?php echo $row['id']; ?>" />
                                        <input type="hidden" name="delete" value="true" />
                                        <button class="btn btn-danger btn-sm">delete</button>
                                    </form>
                                </td>
                            </tr>

                    <?php

                        }
                    } else {
                        echo "0 results";
                    }


                    ?>

                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
</div>

</div>
</div>

<?php include('includes/footer.php'); ?>