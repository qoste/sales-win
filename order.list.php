<?php include('includes/header.php'); ?>

<?php




if (isset($_POST['action']) && isset($_POST['status'])) {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];

    $sql = "UPDATE orders_parent SET status = ?, approved_by = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    $approved_by = $user->fullName;


    $stmt->bind_param('ssi', $status, $approved_by,  $order_id);


    if ($stmt->execute()) {

        if ($status == 2) {

            $order_parent = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM orders_parent WHERE id =".$order_id));

            $sql = "INSERT INTO `transaction`(`total_price`, `quantity`, `customer_id`, `transaction_code`, `processed_by`) VALUES (?,?,?,?,?)";

            $registered_by_id = $user->id;
            $status = 0;
            $transaction_code = rand();

            $stmt = mysqli_prepare($conn, $sql);


            mysqli_stmt_bind_param($stmt, 'iiiss', $order_parent['total_price'], $order_parent['item_count'],  $order_parent['ordered_by'], $transaction_code, $user->fullName);

            mysqli_stmt_execute($stmt);

            if (mysqli_insert_id($conn)) {

                setMessage("Created Transaction successfully!");
            } else{
            }
          

        }
        setMessage("Status Updated successfully");
    }
}


if (isset($_POST['delete'])) {

    $sql = "DELETE FROM orders_parent WHERE id=" . $_POST['order_id'];
    if (mysqli_query($conn, $sql)) {
        $child_sql = "DELETE FROM orders WHERE parent_id=" . $_POST['order_id'];
        mysqli_query($conn, $child_sql);

        setMessage("Deleted successfully");

        header('Location:order.list.php');
    }
}


// login Order and set session
$msg = '';
$error = false;

$sql = "SELECT * FROM orders_parent";
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
                        <th>Item Count</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th>Ordered By</th>
                        <th>Approved By</th>
                        <th>Ordered At</th>
                        <th>Actions</th>

                    </tr>
                </thead>
                <tbody>
                    <?php

                    if (mysqli_num_rows($result) > 0) {
                        // output data of each row
                        while ($row = mysqli_fetch_assoc($result)) {

                            $user_sql = "SELECT * FROM user WHERE id = " . $row['ordered_by'];
                            $user_qu = mysqli_query($conn, $user_sql);
                            $user_result = mysqli_fetch_assoc($user_qu);
                            if (!in_array($user->user_type_id, [1, 3, 4, 5]) && $user_result['id'] != $user->id) {
                                continue;
                            }



                    ?>
                            <tr>
                                <td><?php echo $row['id'] ?></td>
                                <td><?php echo $row['order_code'] ?></td>
                                <td><?php echo $row['item_count'] ?></td>
                                <td><?php echo $row['total_price'] ?>ETB</td>
                                <td>

                                    <?php
                                    if (in_array($user->user_type_id, [1, 3])) {
                                    ?>

                                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="form-horizontal form-inline">
                                            <input type="hidden" name="order_id" value="<?php echo $row['id']; ?>" />
                                            <input type="hidden" name="status_change" value="true" />
                                            <select for="status_type" class="form-control order-status-select" name="status_type" id="status_type" class="" data-order-id="<?php echo $row['id']; ?>">
                                                <option value="0" <?php echo $row['status'] == '0'  ? 'selected' : '' ?>>Pending</option>

                                                <option value="1" <?php echo $row['status'] == '1'  ? 'selected' : '' ?>>Processing</option>
                                                <option value="2" <?php echo $row['status'] == '2'  ? 'selected' : '' ?>>Delivered</option>
                                                <option value="3" <?php echo $row['status'] == '3'  ? 'selected' : '' ?>>Canceled</option>
                                            </select>
                                        </form>

                                    <?php
                                    } else {
                                    ?>
                                        <?php echo $order_status["" . $row['status'] . ""] ?>
                                    <?php } ?>

                                </td>

                                <td><?php echo $user_result['first_name'] . ' ' . $user_result['last_name'] ?></td>
                                <td><?php echo $row['approved_by'] ?></td>
                                <td><?php echo $row['ordered_at'] ?></td>
                                <td>
                                    <a href="order.details.php?order_parent_id=<?php echo $row['id']; ?>&&show-order=true" class="btn btn-success btn-sm">Details</a>

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