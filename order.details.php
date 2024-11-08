<?php include('includes/header.php'); ?>
<?php

if (isset($_POST['delete'])) {

    $sql = "DELETE FROM orders WHERE id=" . $_POST['order_id'];
    if (mysqli_query($conn, $sql)) {
    

        setMessage("Deleted successfully");
        $currentUrl = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ."?order_parent_id=".$_POST['order_id']."&show-order=true";
    
        header("Location: order.list.php");

    }
}

if (isset($_POST['action']) && isset($_POST['status'])) {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];

  
    $sql = "UPDATE orders_parent SET status = ?, approved_by = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    
    $approved_by= $user->fullName;
   

    $stmt->bind_param('ssi', $status, $approved_by,  $order_id); 
    if ($stmt->execute()) {
        setMessage("Status Updated successfully");
        header('Location:order.list.php');
    }
  
}
if(isset($_GET['order_parent_id']) && isset($_GET['show-order'])){
    $msg = '';
$error = false;

$sql = "SELECT * FROM orders_parent where id=".$_GET['order_parent_id'];
$parent_result = mysqli_query($conn, $sql);
$parent_result = mysqli_fetch_assoc($parent_result);

$sql = "SELECT * FROM orders where parent_id=".$parent_result['id'];
$result = mysqli_query($conn, $sql);
$user_sql = "SELECT * FROM user WHERE id = " . $parent_result['ordered_by'];
$user_qu = mysqli_query($conn, $user_sql);
$user_result = mysqli_fetch_assoc($user_qu);

}
?>



<div class="col-12">
    <div class="card" id="printableArea">
        <div class="card-header">
            <h3 class="card-title">Order </h3>
            <button onclick="printDiv('printableArea')" class="btn btn-success btn-sm mx-3 float-right">Print Invoice</button>
            <a href="order.list.php" class="btn btn-primary btn-sm mx-3 float-right">Back to list</a>

            <div class="card-body table-responsive p-0">
            <table class="table table-hover ">
                <tbody>
                    <tr>
                    <th>Order Code</th>
                    <td><?php echo $parent_result['order_code']?></td>
                        <th>Item Count</th>
                        <td><?php echo $parent_result['item_count']?></td>
                         <th>Total Price</th>
                        <td><?php echo $parent_result['total_price']?>ETB</td>
                        <th>Ordered at</th>
                        <td><?php echo $parent_result['ordered_at']?></td>
                      
                    </tr>
                      <tr>
                        <th>Ordered By </th>
                        <td><?php echo $user_result['first_name']." ".$user_result['middle_name']?></td>
                        <th>Approved By </th>
                        <td><?php echo $parent_result['approved_by']?></td>
                           <th>Status </th>
                           <td colspan="3">

<?php 
    if (in_array($user->user_type_id, [1,3])) { 
        ?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="form-horizontal form-inline">
        <input type="hidden" name="order_id" value="<?php echo $parent_result['id']; ?>" />
        <input type="hidden" name="status_change" value="true" />
        <select for="status_type" class="form-control order-status-select " name="status_type" id="status_type" class="" data-order-id="<?php echo $parent_result['id'];?>">
<option value="0" <?php echo $parent_result['status'] == '0'  ? 'selected' : '' ?>>Pending</option>

<option value="1" <?php echo $parent_result['status'] == '1'  ? 'selected' : '' ?>>Processing</option>
<option value="2" <?php echo $parent_result['status'] == '2'  ? 'selected' : '' ?>>Delivered</option>
<option value="3" <?php echo $parent_result['status'] == '3'  ? 'selected' : '' ?>>Canceled</option>
</select>
    </form>

    <?php
    } else{
    ?>
<?php echo $order_status["".$parent_result['status'].""] ?>
    <?php } ?>
    
</td>
                    </tr>
                </tbody>
            </table>

        </div>
        </div>
        <div class="card-body">
        <h3 class=" text-pink">Order Details </h3>
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
                            // if (!in_array($user->user_type_id, [1,3,4,5]) && $user_result['id'] != $user->id) {
                            //     continue;
                            // }



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
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
</div>

</div>
</div>

<?php include('includes/footer.php'); ?>