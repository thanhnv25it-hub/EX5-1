<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Thể Loại</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container" style="max-width: 500px;">
        <h2>Thêm Thể Loại Mới</h2>
        <form action="theloai_them_xl.php" method="post" enctype="multipart/form-data" name="form1">
            <div class="form-group">
                <label>Tên Thể Loại</label>
                <input type="text" name="TenTL" value="" placeholder="Ví dụ: Thể thao" required />
            </div>
            
            <div class="form-group">
                <label>Thứ Tự</label>
                <input type="text" name="ThuTu" value="" placeholder="Ví dụ: 1" required />
            </div>
            
            <div class="form-group">
                <label>Trạng Thái</label>
                <select name="AnHien">
                    <option value="1">Hiển thị</option>
                    <option value="0">Ẩn</option>
                </select>
            </div>
            
            <div class="form-group">
                <label>Biểu tượng (Icon)</label>
                <input type="file" name="image" id="anh" required accept="image/*" />
            </div>
            
            <div class="form-actions">
                <input type="submit" name="Them" value="Thêm mới" class="btn-primary" />
                <input type="reset" name="Huy" value="Làm lại" class="btn-outline" />
                <a href="theloai.php" class="btn-outline" style="margin-left:auto;">Quay lại</a>
            </div>
        </form>
    </div>
</body>
</html>
