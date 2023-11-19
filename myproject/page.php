<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'assignment';

$conn = mysqli_connect($host, $user, $pass, $dbname);


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $message = $_POST['message'];

    $sql = "INSERT INTO contact(name, email, address, message ) VALUES ('$name','$email','$address','$message')";
    mysqli_query($conn, $sql);
}

$sql = "SELECT * FROM contact";
$result = mysqli_query($conn, $sql);

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .headline {
            font-size: 3em;
            color: #45a049;
            margin-bottom: 10px;
            margin-top: 7px;
            text-align: center;
        }

        form {
            max-width: 400px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #4caf50;
            color: #fff;
        }

        p.data {
            font-size: 18px;
            font-weight: bold;
            margin-top: 20px;
        }

        p.no-data {
            color: #888;
        }
    </style>
</head>
<body>
             <div class="headline">Contact Us</div>
    <form action="page.php" method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        
        <label for="address">Adress:</label>
        <input type="text" id="address" name="address" required>
        
        <label for="message">Message:</label>
        <input type="textarea" id="message" name="message" required>
        <input type="submit" name="submit" value="Send Data">
    </form>

    <?php
    if (mysqli_num_rows($result) > 0) {
        echo '<p class="data">Student Data:</p>';
        echo '<table border="1">';
        echo '<tr><th>Name</th><th>Email</th><th>Address</th><th>Message</th></tr>';
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . $row['name'] . '</td>';
            echo '<td>' . $row['email'] . '</td>';
            echo '<td>' . $row['address'] . '</td>';
            echo '<td>' . $row['message'] . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo '<p>No data available.</p>';
    }
    ?>
</body>
</html>