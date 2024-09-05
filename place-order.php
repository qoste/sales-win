<?php
include 'includes/helpers/session_start.php';
include 'includes/helpers/connection.php';

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
        // Retrieve the posted data
        $tableData = $_POST['tableData'];

        // Loop through the data and process each row
        foreach ($tableData as $row) {
            // Access individual row values
            $item_code = $row['item_code'];
            $item_quantity = $row['item_quantity'];

            $sql = "SELECT * FROM items WHERE item_code = '$item_code'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);

                $sql = "INSERT INTO `orders`(`item_id`,`quantity`,  `item_price`, `ordered_by`,  status, order_code)
    VALUES (?,?,?,?,?,?)";


                $ordered_by = $user->id;
                $status = 0;
                $order_code = rand();



                $stmt = mysqli_prepare($conn, $sql);


                mysqli_stmt_bind_param($stmt, 'iiiiis', $row['id'], $item_quantity,  $row['item_price'], $ordered_by,  $status, $order_code);

                mysqli_stmt_execute($stmt);

                if (mysqli_insert_id($conn)) {

                    // setMessage("Registered successfully!");

                } else {
                    $error = true;
                    $msg = 'error occurred.';
                }
            } else {
                echo "Error: Item not found";
            }
        }

        // Optionally, send a response back to the client
        echo json_encode(['status' => 'success', 'message' => 'Data processed successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No data received']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
