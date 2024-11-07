<?php include('includes/header.php');

$items = fetchAllData("items", "id", "DESC");

?>


<div class="row container">

    <?php foreach ($items as $item) { ?>
        <div class="col-4">
            <div class="card item-card" id="item-card-<?php echo $item['id'] ?>">
                <div class="card-body">
                    <h3 class=" text-lg text-center item-name"><?php echo $item['name']; ?> </h3>
                    <div class=" text-lg text-center item-code" style="display: none;"><?php echo $item['item_code']; ?> </div>
                    <div class=" text-lg text-center item-category" style="display: none;"><?php echo $item['category']; ?> </div>
                    <img src='win-water.jpg' width="300px" height="200px" class="img-rounded img-fluid img-thumbnail img-responsive" alt='<?php echo $item['name']; ?>' />
                    <div>
                        <?php echo $item['description'];
                        $diff_day = ((new DateTime(date('y-m-d')))->diff(new DateTime($item['expiry_date'])))->format('%r%a');
                        ?>
                    </div>
                    <div class="text-xs mt-5 float-right text-italic <?php echo $diff_day + 0 < 0 ? 'text-red' : '' ?>">Expiry Date: <span><?php
                                                                                                                                            echo $item['expiry_date'] . ' (' . ($diff_day + 0 > 0 ? $diff_day . ' days left' : $diff_day . ' Expired');  ?>)</span></div>

                    <div class=" ">
                        Price: <span class="badge badge-success item-price"><?php echo $item['item_price']; ?></span><span>ETB</span>

                    </div>

                </div>
                <div class="card-footer" data-id="<?php echo $item['id']; ?>">
                    <div class="float-left">
                        <span>Quantity</span>
                        <button type="button" class="btn btn-sm quantity-minus  btn-warning">-</button>
                        <button type="button" class="btn btn-sm  quantity-value btn-warning">1</button>
                        <button type="button" class="btn btn-sm quantity-add  btn-warning">+</button>
                    </div>
                    <button type="button" class="btn btn-sm  float-right btn-warning add-to-cart" data-id="<?php echo $item['id']; ?>">Add to cart</button>
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
                <table class="table table-hover  " id="cart-items-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Item code</th>

                            <th>Name</th>
                            <th>Category</th>
                            <th>Item Price</th>
                            <th>Item Quantity</th>
                            <th>Total Price</th>


                        </tr>
                    </thead>
                    <tbody class="cart-items">




                    </tbody>
                    <tfoot>
                        <tr class="text-bold">
                            <td colspan="4">Total</td>
                            <td></td>
                            <td class="total-quantity-td">0</td>
                            <td class="total-price-td">0</td>
                        </tr>
                        <tr>
                            <td colspan="7">
                                <button class=" float-right btn btn-success" id="submitBtn">Place Order</button>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>




<?php include('includes/footer.php'); ?>