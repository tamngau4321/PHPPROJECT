<?php
include "../config/Database.php";

$db = new Database();
if(isset($_POST['submit']))
{
    if($_FILES['photo']['name'] !=''){
        move_uploaded_file($_FILES['photo']['tmp_name'],"image/" . $_FILES['photo']['name'] );
        $photo = $_FILES['photo']['name'];
    }

    $name_pro =$_POST['name_pro'];
    $price =$_POST['price'];
    $quantity =$_POST['quantity'];
    $description_pro =$_POST['description_pro'];
    $status_pro =$_POST['status_pro']?1:0;
    $create_date = $_POST['create_date'];

    $query = "INSERT INTO PRODUCT(name_pro,price,quantity,description_pro,photo,status_pro,create_date) VALUES('$name_pro','$price','$quantity','$description_pro','$photo','$status_pro','$create_date')";

    $db->selectData($query);
    header("Location:ShowProduct.php");
}


?>

<!doctype html>

<head>
    <meta charset="UTF-8">
    <title>edit product</title>
</head>
<body>
<form method="post" enctype="multipart/form-data">
    <label for="name_pro">tên sp:</label><br/>
    <input type="text" name="name_pro" id="name_pro" value=""><br/>
    <label for="price">giá sp:</label><br/>
    <input type="number" name="price" id="price" value=""><br/>
    <label for="quantity">số lượng sp:</label><br/>
    <input type="number" name="quantity" id="quantity" value=""><br/>
    <label for="description_pro">số lượng sp:</label><br/>
    <textarea cols="40" rows="5" name="description_pro" id="description_pro"">

    </textarea><br/>
    <label for="photo">hình sp:</label><br/>
    <img src="" title="hình sp" width="100px" id="photo"><br/>
    <input type="file" name="photo" onchange="changePic();"><br/>
    <input type="hidden" name="oldphoto" id="oldphoto" value="<">
    <label for="status_pro">trạng thái sp:</label><br/>
    <input type="checkbox" name="status_pro" id="status_pro" checked><br/>
    <label for="create_date">ngày tạo sp:</label><br/>
    <input type="date" name="create_date" id="create_date" value="">
    <hr/>
    <input type="submit" name ="submit" value="Insert">
</form>
<script src="js/editProduct.js"></script>
</body>
</html>