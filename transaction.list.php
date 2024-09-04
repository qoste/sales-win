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
                        <th>Item</th>
                        <th>Customer</th>
                        <th>Amount</th>
                        <th>Created At</th>
                        <th>actions</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $transactions = fetchAllData('transaction');

                    foreach ($transactions as $transaction) {
                    ?>

                        <tr>
                            <td><?php echo $transaction['id']; ?></td>
                            <td><?php echo  $transaction['transaction_code']; ?></td>
                            <td><?php echo  $transaction['item_id']; ?></td>
                            <td><?php echo  $transaction['customer_id']; ?></td>
                            <td><span class="tag tag-success"><?php echo $transaction['amount']; ?></span></td>
                            <td><?php echo $transaction['created_at']; ?></td>
                            <td>
                            </td>

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