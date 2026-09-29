<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Thể Loại</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <?php include_once('../connect.php'); ?>
        <div class="top-bar">
            <h2>Danh sách Thể Loại</h2>
            <a href="theloai_them.php" class="btn-primary">+ Thêm mới</a>
        </div>
        
        <table>
            <thead>
                <tr>
                    <th>Tên Thể Loại</th>
                    <th>Thứ Tự</th>
                    <th>Trạng Thái</th>
                    <th>Biểu Tượng</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $sql = "select * from theloai order by ThuTu asc";
                    $results = mysqli_query($connect, $sql);
                    while (($rows = mysqli_fetch_assoc($results)) != NULL) {
                ?>
                <tr>
                    <td><strong><?php echo htmlspecialchars($rows['TenTL']); ?></strong></td>
                    <td><?php echo $rows['ThuTu']; ?></td>
                    <td>
                        <span style="color: <?php echo $rows['AnHien'] == 1 ? '#4ade80' : '#f87171'; ?>; font-weight: 500; background: <?php echo $rows['AnHien'] == 1 ? 'rgba(74,222,128,0.1)' : 'rgba(248,113,113,0.1)'; ?>; padding: 4px 12px; border-radius: 20px;">
                            <?php echo $rows['AnHien'] == 1 ? "Hiện" : "Ẩn"; ?>
                        </span>
                    </td>
                    <td>
                        <?php if(!empty($rows['icon']) && file_exists("../image/".$rows['icon'])): ?>
                            <img src="../image/<?php echo htmlspecialchars($rows['icon']); ?>" class="thumbnail" alt="icon" />
                        <?php else: ?>
                            <div class="thumbnail" style="display:inline-flex; align-items:center; justify-content:center; color: #64748b; font-size: 0.75rem;">Trống</div>
                        <?php endif; ?>
                    </td>
                    <td>
                        <div class="action-links">
                            <a href="theloai_sua.php?idTL=<?php echo $rows['idTL'];?>" class="btn-outline">Sửa</a>
                            <a href="theloai_xoa.php?idTL=<?php echo $rows['idTL'];?>" class="btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa thể loại này?');">Xóa</a>
                        </div>
                    </td>
                </tr>
                <?php 
                    } 
                    mysqli_close($connect);
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
