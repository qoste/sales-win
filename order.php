<?php include('includes/header.php');

$items = fetchAllData("items", "id", "DESC");

?>


<div class="row container">

    <?php foreach ($items as $item) { ?>
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <h3 class=" text-lg text-center "><?php echo $item['name']; ?> </h3>
                    <img src='https://picsum.photos/300/200' class="img-rounded img-fluid img-thumbnail img-responsive" alt='<?php echo $item['name']; ?>' />
                    <div>
                        <?php echo $item['description']; ?>
                    </div>
                    <div>
                        Price <span class="badge badge-success"><?php echo $item['item_price']; ?>ETB</span>
                        <button type="button" class="btn btn-sm  float-right btn-warning">Add to cart</button>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>



</div>



<div class="row mt-5">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Cart item List</h3>

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
                            <th>Category</th>
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