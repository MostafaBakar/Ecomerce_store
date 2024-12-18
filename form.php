<?php

$servername="localhost";
$username="root";
$password="";
$dbname="project";

try {
     $connect = new PDO("mysql:host=localhost;dbname=$dbname" , $username, $password );
} catch (Exception $e) {
    echo $e->getMessage();
    exit();
}

$result = $connect->query("SELECT * from produc");
$products = $result->fetchAll(PDO::FETCH_ASSOC);

include 'validation.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
   $item_brand = $_POST['item_brand'];
   $item_name = $_POST['item_name'];
   $item_price = $_POST['item_price'];
   $image = $_FILES['image'];
   $item_image = $image['name'];
   $imageTmp = $image['tmp_name'];

    // for validation if we do validation
    $errors = [];

   if (empty($errors)) {
      // insert into new columns
      $insert_result = $connect->query("INSERT INTO `produc`(`item_brand`, `item_name`, `item_price`, `item_image`) VALUES ('$item_brand', '$item_name', '$item_price', '$item_image')");

      if ($insert_result) {
          move_uploaded_file($imageTmp, "uploads/images/$item_image");
      }
   }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        h1 {
            color: #007BFF;
            font-size: 24px;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
        }

        input[type="text"], input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #007BFF;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .message {
            font-size: 18px;
            margin-top: 15px;
        }

        .message.success {
            color: green;
        }

        .message.error {
            color: red;
        }

        ul {
            padding-left: 20px;
            text-align: left;
        }

        ul li {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit My Products</h1>

        <?php if (isset($insert_result) && $insert_result) { ?>
            <div class="message success">Added success</div>
        <?php } ?>

        <?php if (isset($errors) && !empty($errors)) { ?>
            <div class="message error"> 
                <ul>
                    <?php foreach ($errors as $e) { ?>
                        <li><?php echo $e ?></li>
                    <?php } ?> 
                </ul>
            </div>
        <?php } ?>

        <form action="#" method="POST" enctype="multipart/form-data">
            <label for="item_brand">Product Brand:</label>
            <input type="text" id="item_brand" name="item_brand" required>

            <label for="item_name">Product Name:</label>
            <input type="text" id="item_name" name="item_name" required>

            <label for="item_price">Product Price:</label>
            <input type="text" id="item_price" name="item_price" required>

            <label for="image">Product Image:</label>
            <input type="file" id="image" name="image" accept="image/*">

            <input type="submit" value="Add Product">
        </form>
    </div>
</body>
</html>