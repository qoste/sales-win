<?php include('includes/header.php'); ?>

<?php

if (isset($_POST['delete'])) {

    $sql = "DELETE FROM items WHERE id=" . $_POST['item_id'];
    if (mysqli_query($conn, $sql)) {

        setMessage("Deleted successfully");

        header('Location:item.list.php');
    }
}


// login Item and set session
$msg = '';
$error = false;

$sql = "SELECT * FROM items";
$result = mysqli_query($conn, $sql);





?>


<div class="col-12">

    <h4>Item list </h4>
</div>

<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"> Items list</h3>
            <a href="item.new.php" class="btn btn-primary btn-sm mx-3">New Item</a>

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
                        <th>Item code</th>

                        <th>Name</th>
                        <th>Categoy</th>
                        <th>Item Price</th>
                        <th>Total</th>
                        <th>Registered At</th>
                        <th>actions</th>

                    </tr>
                </thead>
                <tbody>
                    <?php

                    if (mysqli_num_rows($result) > 0) {
                        // output data of each row
                        while ($row = mysqli_fetch_assoc($result)) {

                    ?>
                            <tr>
                                <td><?php echo $row['item_code'] ?></td>

                                <td><?php echo $row['name']  ?></td>
                                <td><span class="tag tag-success"><?php echo $row['category'] ?></span></td>
                                <td><?php echo $row['item_price'] ?>ETB</td>
                                <td><?php echo $row['total'] ?></td>
                                <td><?php echo $row['registered_at'] ?></td>
                                <td>
                                    <a href="item.edit.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">edit</a>
                                    <form method="post" onsubmit="return confirm('are you sure you want to delete this item');" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="form-horizontal form-inline">
                                        <input type="hidden" name="item_id" value="<?php echo $row['id']; ?>" />
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