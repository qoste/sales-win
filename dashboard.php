<?php include('includes/header.php');

$items_count = count(fetchAllData("items"));
$comment_count = count(fetchAllData("comments"));
$customers_count = count(fetchAllData("customers"));
$user_count = count(fetchAllData("user"));
$transaction_count = count(fetchAllData("transaction"));
$total_price_result = mysqli_fetch_assoc(mysqli_query($conn,"SELECT sum(total_price) as price_aggregate FROM transaction"));
$today_price_result = mysqli_fetch_assoc(mysqli_query($conn,"SELECT SUM(total_price) AS price_aggregate FROM transaction WHERE DATE(created_at) = CURDATE()"));
$this_week_price_result = mysqli_fetch_assoc(mysqli_query($conn,"SELECT SUM(total_price) AS price_aggregate FROM transaction WHERE YEARWEEK(created_at, 1) = YEARWEEK(CURDATE(), 1)"));
$this_month_price_result = mysqli_fetch_assoc(mysqli_query($conn,"SELECT SUM(total_price) AS price_aggregate FROM transaction WHERE YEAR(created_at) = YEAR(CURDATE()) AND MONTH(created_at) = MONTH(CURDATE())"));

$items = fetchAllData("items", "id", "DESC");

?>
<div class="row container">

    <?php if ($user->user_type_id != USERS_TYPE_CUSTOMER) { ?>

        <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fa fa-list"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text"> <a href="item.list.php" class="small-box-footer">
                            Total Items
                        </a></span>
                    <span class="info-box-number"><?php echo $items_count; ?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fa fa-list"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text"> <a href="transaction.list.php" class="small-box-footer">
                            Total transaction
                        </a></span>
                    <span class="info-box-number"><?php echo $transaction_count; ?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

    <?php } ?>

    <!-- /.col -->
    <?php if ($user->user_type_id != USERS_TYPE_CUSTOMER) { ?>

        <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-success"><i class="far fa-envelope"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text"><a href="item.list.php" class="small-box-footer">
                            Items List
                        </a></span>
                    <span class="info-box-number"><?php echo $items_count; ?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-success"><i class="far fa-envelope"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text"><a href="comment.list.php" class="small-box-footer">
                            comments
                        </a></span>
                    <span class="info-box-number"><?php echo $comment_count; ?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
    <?php } ?>
    <?php if ($user->user_type_id == USERS_TYPE_ADMIN) { ?>

        <!-- /.col -->
        <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-warning"><i class="far fa-envelope-open"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text"><a href="customer.list.php" class="small-box-footer">
                            Total customers
                        </a></span>
                    <span class="info-box-number"><?php echo $customers_count; ?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

        <!-- /.col -->
        <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-danger"><i class="far fa-envelope-open"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text"><a href="user.list.php" class="small-box-footer">
                            Total Users
                        </a></span>
                    <span class="info-box-number"><?php echo $user_count; ?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    <?php } ?>
</div>
</div>
<div class="text-pink h2 py-3">Transaction summary</div>

<div class="row container">

    <?php if ($user->user_type_id == USERS_TYPE_SALES || $user->user_type_id == USERS_TYPE_ADMIN) { ?>

        <div class="col-6 ">
            <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fa fa-list"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text"> <a href="item.list.php" class="small-box-footer">
                            Today Sales
                        </a></span>
                    <span class="info-box-number"><?php echo $today_price_result['price_aggregate']; ?>ETB</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
          <div class="col-6 ">
            <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fa fa-list"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text"> <a href="item.list.php" class="small-box-footer">
                            This Week Sales
                        </a></span>
                    <span class="info-box-number"><?php echo $this_week_price_result['price_aggregate']; ?>ETB</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
           <div class="col-6 ">
            <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fa fa-list"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text"> <a href="item.list.php" class="small-box-footer">
                            This Month Sales
                        </a></span>
                    <span class="info-box-number"><?php echo $this_month_price_result['price_aggregate']; ?>ETB</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <div class="col-6">
            <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fa fa-list"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text"> <a href="transaction.list.php" class="small-box-footer">
                           Total Sales
                        </a></span>
                    <span class="info-box-number"><?php echo $total_price_result['price_aggregate']; ?>ETB</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

    <?php } ?>

   
</div>
</div>



<div class="row mt-5">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Recent Transactions</h3>

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
                        <th>ID</th>
                        <th>Transaction code</th>
                        <th>Item Count</th>
                        <th>Customer</th>
                        <th>Total Price</th>
                        <th>Processed by</th>
                        <th>Created At</th>
                     

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $transactions = fetchAllData('transaction');

                    foreach ($transactions as $transaction) {
                       $user= fetchData("user",$transaction['customer_id']);
                    ?>

                        <tr>
                            <td><?php echo $transaction['id']; ?></td>
                            <td><?php echo  $transaction['transaction_code']; ?></td>
                            <td><?php echo  $transaction['quantity']; ?></td>
                            <td><?php echo  $user->first_name." ". $user->middle_name; ?></td>
                            <td><span class="tag tag-success"><?php echo $transaction['total_price']; ?></span></td>
                            <td><?php echo $transaction['processed_by']; ?></td>
                            <td><?php echo $transaction['created_at']; ?></td>
                           

                        </tr>
                    <?php } ?>


                </tbody>
            </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>




<?php include('includes/footer.php'); ?>