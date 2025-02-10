<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Refund</title>
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
            background-color: #f44336;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .button:hover {
            background-color: #d32f2f;
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
    <h1>Delete Refund</h1>
    <form action="delete_refund.php" method="post">
        <label for="refund_id">Refund ID:</label>
        <input type="text" id="refund_id" name="refund_id" required>
        <input type="submit" class="button" value="Delete Refund">
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

        // Delete refund from database
        $sql = "DELETE FROM Refund WHERE RefundID = '$refund_id'";
        if ($conn->query($sql) === TRUE) {
            echo "<p>Refund with ID $refund_id deleted successfully.</p>";
        } else {
            echo "<p>Error deleting refund: " . $conn->error . "</p>";
        }

        // Close connection
        $conn->close();
    }
    ?>
</body>
</html>
