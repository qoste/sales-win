<?php include('includes/header.php'); ?>

<div class="col-12">

    <h4>Transactions list </h4>
</div>

<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"> Transactions list</h3>

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

</div>
</div>

<?php include('includes/footer.php'); ?>