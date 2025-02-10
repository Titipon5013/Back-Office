<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Refund</title>
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
            border-radius: 5px;
        }
        label, input, textarea, select {
            display: block;
            width: 100%;
            margin: 10px 0;
        }
        input[type="text"], input[type="number"], select, textarea {
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ddd;
        }
        .button {
            margin-top: 20px;
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
        .back-button {
            margin-top: 20px;
            display: inline-block;
            padding: 10px 20px;
            background-color: #555;
            color: white;
            border: none;
            border-radius: 5px;
            text-decoration: none;
        }
        .back-button:hover {
            background-color: #333;
        }
    </style>
</head>
<body>
    <h1>Add New Refund</h1>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Database connection parameters
        $servername = "127.0.0.1";
        $username = "root";
        $password = "Timeza.084"; // replace with your actual MySQL root password
        $dbname = "cj_streetwear";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Retrieve form data
        $orderID = $conn->real_escape_string($_POST["orderID"]);
        $returnReason = $conn->real_escape_string($_POST["returnReason"]);
        $refundStatus = $conn->real_escape_string($_POST["refundStatus"]);

        // Insert query
        $sql = "INSERT INTO Refund (OrderID, ReturnReason, RefundStatus) VALUES ('$orderID', '$returnReason', '$refundStatus')";

        if ($conn->query($sql) === TRUE) {
            echo "<p>New refund entry added successfully!</p>";
        } else {
            echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
        }

        $conn->close();
    }
    ?>

    <form method="post" action="add_refund.php">
        <label for="orderID">Order ID:</label>
        <input type="number" id="orderID" name="orderID" required>

        <label for="returnReason">Return Reason:</label>
        <textarea id="returnReason" name="returnReason" rows="4" required></textarea>

        <label for="refundStatus">Refund Status:</label>
        <select id="refundStatus" name="refundStatus" required>
            <option value="Pending">Pending</option>
            <option value="Approved">Approved</option>
            <option value="Rejected">Rejected</option>
            <option value="Completed">Completed</option>
        </select>

        <input type="submit" value="Add Refund" class="button">
    </form>

    <a href="refund.php" class="back-button">Back to Refund List</a>
</body>
</html>
