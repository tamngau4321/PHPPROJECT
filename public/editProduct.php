<?php
session_start();
    include "../config/Database.php";
    $db = new Database();


    if($_SERVER['REQUEST_METHOD']==='POST')
    {
        if($_FILES['photo']['name']!='')
        {
            move_uploaded_file($_FILES['photo']['tmp_name'], "image/".$_FILES['photo']['name']);
            $photo = $_FILES['photo']['name'];
        }else{
            $photo = $_POST['oldphoto'];
        }
        $name_pro =$_POST['name_pro'];
        $price =$_POST['price'];
        $quantity =$_POST['quantity'];
        $description_pro =$_POST['description_pro'];
        $status_pro =$_POST['status_pro']?1:0;
        $create_date = $_POST['create_date'];
        $query = "update product set name_pro='$name_pro', price='$price', quantity='$quantity', description_pro='$description_pro', photo='$photo', status_pro='$status_pro', create_date='$create_date' where id=?";
        $param = $_GET['id'];
        $db->selectDataParam($query,$param);
        header("Location:showProduct.php");
    }

        if(isset($_GET['id']))
        {
            $query = "select * from product where id=?";
            $param = $_GET['id'];

            $stmt = $db->selectDataParam($query,$param);
            $result = $stmt->get_result();
        }else{
            header('Location: showProduct.php');

    }


?>

<!doctype html>

<head>
    <meta charset="UTF-8">
    <title>edit product</title>
</head>
<body>

    <form method="post" enctype="multipart/form-data">
        <?php while ($row = $result->fetch_assoc()){ ?>
        <label for="name_pro">tên sp:</label><br/>
        <input type="text" name="name_pro" id="name_pro" value="<?=$row['name_pro']?>"><br/>
        <label for="price">giá sp:</label><br/>
        <input type="number" name="price" id="price" value="<?=$row['price']?>"><br/>
        <label for="quantity">số lượng sp:</label><br/>
        <input type="number" name="quantity" id="quantity" value="<?=$row['quantity']?>"><br/>
        <label for="description_pro">số lượng sp:</label><br/>
        <textarea cols="40" rows="5" name="description_pro" id="description_pro"">
            <?=$row['description_pro']?>
        </textarea><br/>
        <label for="photo">hình sp:</label><br/>
        <img src="image/<?=$row['photo']?>" title="hình sp" width="100px" id="photo"><br/>
        <input type="file" name="photo" onchange="changePic();"><br/>
        <input type="hidden" name="oldphoto" id="oldphoto" value="<?=$row['photo']?>">
        <label for="status_pro">trạng thái sp:</label><br/>
        <input type="checkbox" name="status_pro" id="status_pro" <?=$row['status_pro']?"checked":""?> ><br/>
        <label for="create_date">ngày tạo sp:</label><br/>
        <input type="date" name="create_date" id="create_date" value="<?=$row['create_date']?>">
        <hr/>
        <input type="submit" value="update">
    </form>
    <?php } ?>
    <script src="js/editProduct.js"></script>
</body>
</html>
