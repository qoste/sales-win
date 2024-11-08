<?php
include 'includes/helpers/session_start.php';
include 'includes/helpers/connection.php';
include_once('includes/helpers/message.php');

$user = new stdClass();

if (isset($_SESSION['user_id'])) {

    $user = (object) $_SESSION['user'];
    $user->fullName = $user->first_name . " " . $user->middle_name;
} else {
    // header('Location:logout.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Check if the data is sent from the client
    if (isset($_POST['tableData'])) {
        $err = false;
        // Retrieve the posted data
        $tableData = $_POST['tableData'];

        $quantity_count = 0;
        $total_price = 0.0;
        $status = 0;
        $order_codes=[];

        // Loop through the data and process each row
        foreach ($tableData as $row) {
            // Access individual row values
            $item_code = $row['item_code'];
            $item_quantity = $row['item_quantity'];

            $quantity_count += $item_quantity;

            $sql = "SELECT * FROM items WHERE item_code = '$item_code'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $total_price += $row['item_price'] * $item_quantity;


                $sql = "INSERT INTO `orders`(`item_id`,`quantity`,  `item_price`, `ordered_by`,  status, order_code)
    VALUES (?,?,?,?,?,?)";


                $ordered_by = $user->id;
                $order_code = rand();
                $order_codes[]=$order_code;



                $stmt = mysqli_prepare($conn, $sql);


                mysqli_stmt_bind_param($stmt, 'iiiiis', $row['id'], $item_quantity,  $row['item_price'], $ordered_by,  $status, $order_code);

                mysqli_stmt_execute($stmt);

                if (mysqli_insert_id($conn)) {

                    // setMessage("Registered successfully!");

                } else {
                    $error = true;
                    $msg = 'error occurred.';
                    $err = true;
                }
            } else {
                $msg = "Error: Item not found";
            }
        }

        if (!$err) {
            $parent_order_code = rand();
            $orders_parent_sql = "INSERT INTO `orders_parent`(`item_count`,  `total_price`, `ordered_by`,  status, order_code)
    VALUES (?,?,?,?,?)";
            $stmt = mysqli_prepare($conn, $orders_parent_sql);


            mysqli_stmt_bind_param($stmt, 'iiiis', $quantity_count, $total_price,  $user->id,  $status, $parent_order_code);
            mysqli_stmt_execute($stmt);
            $sql = "UPDATE orders SET parent_id = ? WHERE order_code = ?";
            $stmt = $conn->prepare($sql);
            
        
            $last_id=mysqli_insert_id($conn);
            foreach ($order_codes as $order_c){
        
            $stmt->bind_param('is', $last_id, $order_c); 
            $stmt->execute();
        }

            setMessage("Registered successfully!");
        }
        // Optionally, send a response back to the client
        echo json_encode(['status' => 'success', 'message' => 'Data processed successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No data received']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
