<?php
if (isset($_POST['begin']) && !empty($_FILES['file_email']['name'])) {
    // Kiểm tra nếu file chưa được chọn
    if ($_FILES['file_email']['error'] != UPLOAD_ERR_OK) {
        echo "<alert>Chưa nhập file</alert>";
    } else {
        // Lưu trữ file đã tải lên vào thư mục
        $uploadDir = 'D:/xampp/htdocs/KNOWLEDGE IT/PHP/PHP-PROJECT/PHP-SPAM/simplexlsx/src/';
        $uploadFile = $uploadDir . basename($_FILES['file_email']['name']);
        $name_file = $_FILES['file_email']['name'];
        if (move_uploaded_file($_FILES['file_email']['tmp_name'], $uploadFile)) {
            echo "<p class='success'> ". "File đã được tải lên thành công." . "</p>";
            echo $name_file;
        } else {
            echo "Không thể tải lên file.";
        }
    }}

require 'SimpleXLSX.php'; // Đảm bảo đường dẫn đúng

use Shuchkin\SimpleXLSX;

use function PHPSTORM_META\type;
if(isset($name_file)){
    $filePath = $name_file;
    
    $array_data= [];
    if ($xlsx = SimpleXLSX::parse($filePath)) {
        // Lặp qua các hàng và cột
        foreach ($xlsx->rows() as $row) {
            // echo implode("\t", $row) . "\n";
            array_push($array_data,$row);
        }
    } else {
        echo SimpleXLSX::parseError();
    }
    
    echo "<p class='email_detect'>" . "Số lượng mail nhận thấy  " . count($array_data) . "<br>";

    echo "<a target='_blank' class = 'forward' href='sent-mailer.php?a=" . urlencode(json_encode($array_data)) . "'>" . "BẮT ĐẦU GỬI(click song treo cả ngày)" . "</a> ". "</br>" ;

 
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
        }
        form {
            margin-bottom: 20px;
        }
        .upfile {
            margin-bottom: 10px;
        }
        .btn_submit {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn_submit:hover {
            background-color: #0056b3;
        }
        .success {
            color: green;
            font-weight: bold;
        }
        .email_detect {
            margin-top: 10px;
            font-style: italic;
        }
        .forward {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
        }
        .forward:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<form action="" method="POST" enctype="multipart/form-data">
    <input type="file" name="file_email" class="upfile" >
    <input type="submit" name="begin" value="XONG" class="btn_submit">

</form>
<script>
    
</script>
</body>
</html>