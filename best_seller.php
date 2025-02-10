<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Best Seller of the Store</title>
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
    </style>
</head>
<body>
    <h1>Best Seller of the Month</h1>

    <?php
    // Database connection parameters
    $servername = "127.0.0.1";
    $username = "root";
    $password = "Timeza.084"; // Replace with your actual password
    $dbname = "cj_streetwear";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get the current month and year
    $currentMonth = date('m');
    $currentYear = date('Y');

    // Query to find the best-selling collections of the current month
    $sql = "
        SELECT 
            collectionlist.Name, 
            collectionlist.Price, 
            collectionlist.Images,
            COUNT(order.OrderID) AS TotalOrders
        FROM `order`
        JOIN collectionlist ON collectionlist.CollectionID = order.CollectionID
        WHERE MONTH(order.OrderDate) = ? AND YEAR(order.OrderDate) = ?
        GROUP BY order.CollectionID
        ORDER BY TotalOrders DESC
        LIMIT 10;
    ";

    // Prepare and bind
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $currentMonth, $currentYear);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if there are any results and display them
    if ($result->num_rows > 0) {
        echo "<table><tr><th>Collection Name</th><th>Price</th><th>Image</th><th>Total Orders</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . htmlspecialchars($row["Name"]) . "</td>
                    <td>" . htmlspecialchars($row["Price"]) . "</td>
                    <td><img src='" . htmlspecialchars($row["Images"]) . "' alt='Image' width='50'></td>
                    <td>" . htmlspecialchars($row["TotalOrders"]) . "</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No sales data available for this month.</p>";
    }

    // Close connection
    $stmt->close();
    $conn->close();
    ?>

    <div class="button-container">
        <a href="collectionlist.php" class="button">Back to Collection List</a>
    </div>
</body>
</html>
