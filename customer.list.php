<?php include('includes/header.php'); ?>

<div class="col-12">

    <h4>Customers list </h4>
</div>

<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"> Customers list</h3>

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
                        <th>Full Name</th>
                        <th>Gender</th>
                        <th>Assigned At</th>
                        <th>actions</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $customers = fetchAllData('customers');

                    foreach ($customers as $customer) {
                    ?>

                        <tr>
                            <td><?php echo $customer['id']; ?></td>
                            <td><?php echo  $customer['first_name'] . " " . $customer['middle_name']; ?></td>
                            <td><span class="tag tag-success"><?php echo $customer['gender']; ?></span></td>
                            <td><?php echo $customer['registered_at']; ?></td>
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