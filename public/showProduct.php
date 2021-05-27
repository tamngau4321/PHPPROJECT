<?php
session_start();
    include "../config/Database.php";
    $db= new Database();
    $username = $_SESSION['username'];
    if(!isset($username)){
        header("Location:Login.php");
    }

        if (isset($_GET['search'])) {
            $query = "select * from product where concat(id,name_pro) like ?";
            $param = "%{$_GET['search']}%";

            $stmt = $db->selectDataParam($query, $param);
            $result = $stmt->get_result();
        } else {
            $query = "select * from product";
            $stmt = $db->selectData($query);
            $result = $stmt->get_result();
        }
        if (isset($_GET['id'])) {
            $query = "DELETE FROM PRODUCT where id=?";
            $param = $_GET['id'];
            $stmt = $db->selectDataParam($query, $param);
            header("Location:showProduct.php");
        }


?>
<!doctype html>
<html >
<head>
    <meta charset="UTF-8">
    <title>show product</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
<div class="welcome-admin">
    <i class="fa fa-user-circle"></i>
    <?php echo  $username ?><br>
    <a  href="logout.php">Sign out</a>
</div>
<form method="get" style="margin-top:40px">
    <label for="search">tìm kiếm:</label>
    <input type="text" name="search" id="search">

    <input type="submit" value="find">
</form>
<table id="example" class="table table-striped table-bordered" style="width:100%">
    <tr>
        <th>mã sp</th>
        <th>tên sp</th>
        <th>giá</th>
        <th>số lượng</th>
        <th>mô tả</th>
        <th>hình ảnh</th>
        <th>trạng thái</th>
        <th>ngày tạo</th>
        <th>cập nhật</th>
        <td><a href="insertProduct.php">Thêm sản phẩm</a></td>
        <th>xóa sản phẩm</th>
    </tr>
    <?php
        while($row = $result->fetch_assoc()):
    ?>
    <tr>
        <td><?php echo $row['id']?></td>
        <td><?=$row['name_pro']?></td>
        <td><?=$row['price']?></td>
        <td><?=$row['quantity']?></td>
        <td><?=$row['description_pro']?></td>
        <td><img src="image/<?=$row['photo']?>" width="100px"></td>
        <td><?=$row['status_pro']?"còn hàng":"hết hàng" ?></td>
        <td><?=$row['create_date']?></td>
        <td><a href="editProduct.php?id=<?=$row['id']?>">edit</a></td>
        <td><a href="insertProduct.php">Thêm</a></td>
        <td><a href="showProduct.php?id=<?=$row['id']?>">Xóa</a></td>
    </tr>

    <?php
        endwhile;
        $db->closeConn();

    ?>

</table>
</body>
</html>
