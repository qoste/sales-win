</div>
</div>

</section>
</div>
<footer class="main-footer">
    <strong>Copyright &copy;
        2017
        <a href=" http://Tona.Supermarket.com"> Tona Supermarket
        </a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b>
        1.0
    </div>

</footer>

<aside class="control-sidebar control-sidebar-dark"></aside>


</div>

</div>
<div id="temp-modal">
</div>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/moment.min.js"></script>
<script src="assets/js/daterangepicker.js"></script>
<script src="assets/js/Chart.min.js"></script>

<script src="assets/js/tempusdominus-bootstrap-4.min.js"></script>

<script src="assets/js/jquery.overlayScrollbars.min.js"></script>

<script src="assets/js/adminlte.js"></script>

<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/pace.min.js"></script>
<script src="assets/js/bootstrap-switch.min.js"></script>

<script src="assets/js/toastr.min.js"></script>
<script src="assets/js/select2.full.min.js"></script>
<script src="assets/js/sweetalert2.min.js"></script>
<script src="assets/jquery.autocomplete.min.js"></script>
<script>
    $('.select2').select2()


    $('.confirm-swal').submit(function(event) {
        event.preventDefault();

        return confirmSwal(this, "form", "Are you sure??")
    });
    $('.confirm-swal').click(function(event) {
        event.preventDefault();

        return confirmSwal(this, "link", "Are you sure??")
    });

    function confirmSwal(a, type = "link", message = "Are you sure??") {

        Swal.fire({
            title: message,

            showCancelButton: true,
            confirmButtonText: 'Conform',
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.value && type == "link") {

                window.location.href = a.href
                //  Swal.fire('Saved!', '', 'success')
            } else {
                console.log("dfgh");
                return true;
                // Swal.fire('Changes are not saved', '', 'info')
                //return false;

            }
        })
    }
</script>
<script>
    $('.add-to-cart').on('click', function() {
        var itemId = $(this).data('id');
        var itemCard = $(this).closest('div.item-card');
        var itemName = itemCard.find('h3.item-name');
        var itemPrice = itemCard.find('span.item-price');
        var itemCategory = itemCard.find('span.item-category');
        var itemCode = itemCard.find('div.item-code');
        var itemQuantity = itemCard.find('button.quantity-value');
        console.log(itemName.text(), itemPrice.text())
        $('.cart-items').last().after('<tr><td>' + 1 + '</td><td>' + itemCode.text() + '</td><td>' + itemName.text() + '</td><td>' + itemCategory.text() + '</td><td>' + itemPrice.text() + '</td><td class="quantity-td">' + itemQuantity.text() + '</td><td class="price-td">' + Number(itemQuantity.text() * Number(itemPrice.text())) + '</td></tr>');

        var totalPrice = 0;
        var totalQuantity = 0;
        $('.quantity-td').each(function() {
            totalQuantity += Number($(this).text());
        });
        $('.price-td').each(function() {
            totalPrice += Number($(this).text());
        });
        $('.total-price-td').text(totalPrice);
        $('.total-quantity-td').text(totalQuantity);

    });
    $('.quantity-add').on('click', function() {
        console.log($(this).parent().parent('div').data('id'))
        quantityDiv = $(this).parent('div').find('.quantity-value')
        var value = quantityDiv.text();
        quantityDiv.text(Number(value) + 1);

    });
    $('.quantity-minus').on('click', function() {
        console.log($(this).parent().parent('div').data('id'))
        quantityDiv = $(this).parent('div').find('.quantity-value')
        var value = quantityDiv.text();
        if (Number(value) > 0) {
            quantityDiv.text(Number(value) - 1);
        }
    });
</script>
<script>
    $(document).ready(function() {
        $("#submitBtn").click(function() {
            // Create an array to store the data in a key-value pair format
            var tableData = [];

            // Loop over each row in the table
            $("#cart-items-table tr").each(function() {
                var itemCode = $(this).find('td:eq(1)').text()
                var rowData = {
                    'item_code': $(this).find('td:eq(1)').text(),
                    'item_quantity': $(this).find('td:eq(5)').text(),
                };

                // Add the row data to the tableData array
                if (itemCode !== '') {
                    tableData.push(rowData);
                }
            });

            console.log(tableData)
            // Send the collected data to the server using AJAX
            $.ajax({
                url: 'place-order.php', // Replace with your PHP handler file
                type: 'POST',
                data: {
                    tableData: tableData
                },
                success: function(response) {
                    console.log(response); // Log the server response
                    window.location.replace("order.list.php");

                },
                error: function(error) {
                    console.error('Error submitting data:', error);
                }
            });
        });
    });
</script>
</body>

</html>