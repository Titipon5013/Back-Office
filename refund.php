<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Refund Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f0f0f0;
        }
        h1 {
            margin-top: 20px;
        }
        table {
            margin: 20px auto;
            border-collapse: collapse;
            width: 80%;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: center;
        }
        .button-container {
            margin: 20px;
        }
        .button {
            padding: 10px 20px;
            margin: 5px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            cursor: pointer;
        }
        .button:hover {
            background-color: #45a049;
        }
        .edit-button {
            background-color: #FFA500;
            color: white;
            padding: 8px 16px;
            text-decoration: none;
            border-radius: 5px;
        }
        .edit-button:hover {
            background-color: #FF8C00;
        }
    </style>
</head>
<body>
    <h1>Refund Management</h1>
    <h2>List of Refunds</h2>
    <?php
    // Database connection parameters
    $servername = "127.0.0.1";
    $username = "root";
    $password = "Timeza.084"; // replace with your actual MySQL password
    $dbname = "cj_streetwear";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query to fetch refunds
    $sql = "SELECT * FROM Refund";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table><tr><th>Refund ID</th><th>Order ID</th><th>Return Reason</th><th>Refund Status</th><th>Actions</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . htmlspecialchars($row["RefundID"]) . "</td>
                    <td>" . htmlspecialchars($row["OrderID"]) . "</td>
                    <td>" . htmlspecialchars($row["ReturnReason"]) . "</td>
                    <td>" . htmlspecialchars($row["RefundStatus"]) . "</td>
                    <td><a href='edit_refund.php?RefundID=" . $row['RefundID'] . "' class='edit-button'>Edit</a></td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No refunds found.</p>";
    }

    $conn->close();
    ?>

    <div class="button-container">
        <a href="add_refund.php" class="button">Add</a>
        <a href="delete_refund.php" class="button">Delete</a>
        <a href="select_refund.php" class="button">Select</a>
        <a href="main.php" class="button">Back to Main Page</a>
    </div>
</body>
</html>
