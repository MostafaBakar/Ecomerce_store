<?php

function validateName($name){
    return !empty($name) && strlen($name) >= 3;
}


function validatePrice($price){
    return is_numeric($price) && $price > 0;
}


function validateImage($image) {
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    // explode بتقسم اسم الملف الى ارراى بناء على النقطة
    // end بتاخد اخر عنصر فى الاراى اللى هيكون مثلا png
    // strtolower بتحول النص إلى حروف صغيرة زى JPG to jpg
    // الهدف فى الاخر الحصول على امتداد الصورة مثلا jpg
     // تقسيم اسم الملف إلى مصفوفة بناءً على النقطة
     $arrayofname = explode('.', $image['name']);
    
     // الحصول على الامتداد
     $extension = strtolower(end($arrayofname));
    
    // in_array بتشوف اذا كان الامتداد موجود فى الاراى والا لا
    return in_array($extension, $allowedExtensions);
}




function validateProduct($name, $price, $image) {
    $errors = [];

    if (!validateName($name)) {
        $errors[] = 'Product name is required and must be at least 3 characters';
    }

    if (!validatePrice($price)) {
        $errors[] = 'Product price must be positive number';
    }

    if (!validateImage($image)) {
        $errors[] = 'Product image must be a valid image file (jpg, jpeg, png, gif)';
    }

    return $errors;
}

 

?>