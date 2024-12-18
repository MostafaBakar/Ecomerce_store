<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

include 'validation.php'; // تضمين ملف التحقق

try {
    $connect = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // الحصول على معرف المنتج من الرابط
    $id = $_GET['id'] ?? null;
    if (!$id) {
        die("No product ID provided.");
    }

    // التعامل مع طلب التعديل
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $image = $_FILES['image'];

        // استخدام التحقق من البيانات
        $errors = validateProduct($name, $price, $image);

        //  لو البيانات صح  حدثها
        if (empty($errors)) {
            $imageName = $image['name'] ?: $product['image'];
            if ($image['name']) move_uploaded_file($image['tmp_name'], "uploads/images/$imageName");

            $sql = "UPDATE products SET name = '$name', price = '$price', image = '$imageName' WHERE id = $id";
            $connect->exec($sql);

            $success = true;
        }
    } else {
        // هاتلى تفاصيل المنتج عند تحميل الصفحة
        $sql = "SELECT * FROM products WHERE id = $id";
        $result = $connect->query($sql);
        $product = $result->fetch(PDO::FETCH_ASSOC);

        if (!$product) {
            die("Product not found.");
        }
    }
} catch (Exception $e) {
    die($e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
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

        a {
            text-decoration: none;
            color: #007BFF;
            font-size: 16px;
            display: block;
            margin-top: 20px;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Update Product</h1>

        <?php
        // success message
        if (isset($success) && $success) {
            echo '<div class="message success">Product updated successfully!</div>';
        }

        // error message
        if (!empty($errors)) {
            echo '<div class="message error">';
            echo '<ul>';
            foreach ($errors as $error) {
                echo '<li>' . htmlspecialchars($error) . '</li>';
            }
            echo '</ul>';
            echo '</div>';
        }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <label for="name">Product Name:</label>
            <input type="text" id="name" name="name"  ?>

            <label for="price">Product Price:</label>
            <input type="text" id="price" name="price" ?>

            <label for="image">Product Image:</label>
            <input type="file" id="image" name="image" accept="image/*">

            <input type="submit" value="Update Product">
        </form>

        <a href="index.php">Back to Home</a>
    </div>
</body>
</html>