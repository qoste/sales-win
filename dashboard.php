<?php include('includes/header.php');

$items_count = count(fetchAllData("items"));
$comment_count = count(fetchAllData("comments"));
$customers_count = count(fetchAllData("customers"));
$user_count = count(fetchAllData("user"));
$transaction_count = count(fetchAllData("transaction"));

$items = fetchAllData("items", "id", "DESC");

?>



<div class="row container">

    <?php if ($user->user_type_id == USERS_TYPE_NURSE || $user->user_type_id == USERS_TYPE_ADMIN) { ?>

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
    <?php if ($user->user_type_id == USERS_TYPE_CUSTOMER || $user->user_type_id == USERS_TYPE_ADMIN) { ?>

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



<div class="row mt-5">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Recent items</h3>

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
                            <th>Item code</th>

                            <th>Name</th>
                            <th>Categoy</th>
                            <th>Item Price</th>
                            <th>Total</th>
                            <th>Registered At</th>


                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach ($items as $key => $row) {

                            if ($key > 4)
                                break;
                        ?>
                            <tr>
                                <td><?php echo $key + 1 ?></td>
                                <td><?php echo $row['item_code'] ?></td>

                                <td><?php echo $row['name']  ?></td>
                                <td><span class="tag tag-success"><?php echo $row['category'] ?></span></td>
                                <td><?php echo $row['item_price'] ?>ETB</td>
                                <td><?php echo $row['total'] ?></td>
                                <td><?php echo $row['registered_at'] ?></td>

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