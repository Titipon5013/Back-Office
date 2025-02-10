<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Refund</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f0f0f0;
        }
        h1 {
            margin-top: 20px;
        }
        form {
            display: inline-block;
            margin-top: 20px;
            padding: 20px;
            border: 1px solid #ddd;
            background-color: #fff;
            border-radius: 8px;
            width: 300px;
        }
        input[type="text"], select {
            width: 100%;
            padding: 8px;
            margin: 8px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .button:hover {
            background-color: #45a049;
        }
        .back-link {
            margin-top: 20px;
            display: block;
            color: #4CAF50;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <h1>Edit Refund</h1>
    <?php
    // Database connection parameters
    $servername = "127.0.0.1";
    $username = "root";
    $password = "Timeza.084"; 
    $dbname = "cj_streetwear";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if RefundID is provided
    if (isset($_GET["RefundID"])) {
        $refund_id = $conn->real_escape_string($_GET["RefundID"]);

        // Fetch existing refund details
        $sql = "SELECT * FROM Refund WHERE RefundID = '$refund_id'";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
        } else {
            echo "<p>Refund not found.</p>";
            echo '<a href="refund.php" class="back-link">Back to Refund List</a>';
            exit;
        }
    } else {
        echo "<p>No RefundID specified for editing.</p>";
        echo '<a href="refund.php" class="back-link">Back to Refund List</a>';
        exit;
    }

    // Update refund details upon form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $return_reason = $conn->real_escape_string($_POST["return_reason"]);
        $refund_status = $conn->real_escape_string($_POST["refund_status"]);

        $update_sql = "UPDATE Refund SET ReturnReason = '$return_reason', RefundStatus = '$refund_status' WHERE RefundID = '$refund_id'";

        if ($conn->query($update_sql) === TRUE) {
            echo "<p>Refund updated successfully!</p>";
            echo '<a href="refund.php" class="back-link">Back to Refund List</a>';
        } else {
            echo "<p>Error updating refund: " . $conn->error . "</p>";
        }

        $conn->close();
        exit;
    }
    ?>
    <form method="post" action="">
        <label for="return_reason">Return Reason:</label>
        <input type="text" id="return_reason" name="return_reason" value="<?php echo htmlspecialchars($row['ReturnReason']); ?>" required>

        <label for="refund_status">Refund Status:</label>
        <select id="refund_status" name="refund_status" required>
            <option value="Pending" <?php if($row['RefundStatus'] == 'Pending') echo 'selected'; ?>>Pending</option>
            <option value="Approved" <?php if($row['RefundStatus'] == 'Approved') echo 'selected'; ?>>Approved</option>
            <option value="Rejected" <?php if($row['RefundStatus'] == 'Rejected') echo 'selected'; ?>>Rejected</option>
            <option value="Processed" <?php if($row['RefundStatus'] == 'Processed') echo 'selected'; ?>>Processed</option>
        </select>

        <input type="submit" class="button" value="Update Refund">
    </form>

    <a href="refund.php" class="back-link">Back to Refund List</a>

    <?php $conn->close(); ?>
</body>
</html>
