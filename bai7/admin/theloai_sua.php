<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Thể Loại</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container" style="max-width: 500px;">
        <h2>Sửa Thể Loại</h2>
        <?php 
            include("../connect.php");
            if(isset($_GET['idTL'])){
                $sl="select * from theloai where idTL=" . intval($_GET['idTL']);
                $results = mysqli_query($connect, $sl);
                $d = mysqli_fetch_array($results);
            }
        ?>
        <form action="" method="post" enctype="multipart/form-data" name="form1">
            <div class="form-group">
                <label>Tên Thể Loại</label>
                <input type="text" name="TenTL" value="<?php echo htmlspecialchars($d['TenTL']);?>" required />
            </div>
            
            <div class="form-group">
                <label>Thứ Tự</label>
                <input type="text" name="ThuTu" value="<?php echo htmlspecialchars($d['ThuTu']);?>" required />
            </div>
            
            <div class="form-group">
                <label>Trạng Thái</label>
                <select name="AnHien">
                    <option value="1" <?php if($d['AnHien']==1) echo "selected";?>>Hiển thị</option>
                    <option value="0" <?php if($d['AnHien']==0) echo "selected";?>>Ẩn</option>
                </select>
            </div>
            
            <div class="form-group">
                <label>Biểu tượng hiện tại</label>
                <?php if(!empty($d['icon'])): ?>
                    <div style="margin-bottom: 1rem;">
                        <img src="../image/<?php echo htmlspecialchars($d['icon']); ?>" class="thumbnail" style="width: 80px; height: 80px;" />
                    </div>
                <?php endif; ?>
                <label>Thay đổi biểu tượng</label>
                <input type="file" name="image" id="image" accept="image/*" />
                <input type="hidden" name="ten_anh" value="<?php echo htmlspecialchars($d['icon']); ?>" >
            </div>
            
            <div class="form-actions">
                <input type="hidden" name="idTL" value="<?php echo $_GET['idTL'];?>" />
                <input type="submit" name="Sua" value="Cập nhật" class="btn-primary" />
                <input type="reset" name="Huy" value="Khôi phục" class="btn-outline" />
                <a href="theloai.php" class="btn-outline" style="margin-left:auto;">Quay lại</a>
            </div>
        </form>

        <?php
            if (isset($_POST['Sua'])) {
                $theloai = $_POST['TenTL'];
                $thutu = $_POST['ThuTu'];
                $an= $_POST['AnHien'];
                $ten_file_tai_len = "";
                
                if(isset($_FILES["image"]["name"]) && $_FILES["image"]["name"] != "") { 
                    $ten_file_tai_len = $_FILES["image"]["name"];	
                    $icon = $ten_file_tai_len;
                } else {
                    $icon = $_POST['ten_anh'];
                }
                                        
                $key = $_POST["idTL"];
                
                // Kiểm tra trùng tên ảnh
                $check_sl = "select count(*) from theloai where icon='$icon' and idTL != '$key'";
                $check_results = mysqli_query($connect, $check_sl);
                $check_d = mysqli_fetch_array($check_results);
                
                if($check_d[0] == 0 || $ten_file_tai_len == "") {
                    $sl = "update theloai set TenTL='$theloai', ThuTu='$thutu', AnHien='$an', icon='$icon' where idTL ='$key'";

                    if($ten_file_tai_len != "") {	
                        move_uploaded_file($_FILES['image']['tmp_name'], "../image/".$ten_file_tai_len);
                        $duong_dan_anh_cu = "../image/".$_POST['ten_anh'];
                        if(file_exists($duong_dan_anh_cu) && !empty($_POST['ten_anh'])){
                            unlink($duong_dan_anh_cu);
                        }
                    }

                    if(mysqli_query($connect, $sl)) {
                        echo "<script language='javascript'>alert('Cập nhật thành công!'); location.href='theloai.php';</script>";
                    }
                } else {
                    echo "<script language='javascript'>alert('Tên ảnh bị trùng, vui lòng đổi tên ảnh khác!'); location.href='theloai_sua.php?idTL=$key';</script>";
                }
            }
        ?>
    </div>
</body>
</html>
