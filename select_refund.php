<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Refund</title>
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
        }
        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin: 8px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .button {
            padding: 10px 20px;
            margin-top: 10px;
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
    </style>
</head>
<body>
    <h1>Select Refund</h1>
    <form action="select_refund.php" method="post">
        <label for="refund_id">Refund ID:</label>
        <input type="text" id="refund_id" name="refund_id" required>
        <input type="submit" class="button" value="View Refund">
    </form>
    <a href="refund.php" class="back-link">Back to Refund List</a>

    <?php
    // Check if form has been submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

        // Retrieve and sanitize RefundID from form
        $refund_id = $conn->real_escape_string($_POST["refund_id"]);

        // Query to fetch refund details
        $sql = "SELECT * FROM Refund WHERE RefundID = '$refund_id'";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            echo "<table><tr><th>Refund ID</th><th>Order ID</th><th>Return Reason</th><th>Refund Status</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . htmlspecialchars($row["RefundID"]) . "</td>
                        <td>" . htmlspecialchars($row["OrderID"]) . "</td>
                        <td>" . htmlspecialchars($row["ReturnReason"]) . "</td>
                        <td>" . htmlspecialchars($row["RefundStatus"]) . "</td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No refund found with ID $refund_id.</p>";
        }

        // Close connection
        $conn->close();
    }
    ?>
</body>
</html>
