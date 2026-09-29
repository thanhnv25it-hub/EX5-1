<?php
include('connect.php');
$samples = [
    ['Kinh tế', 1, 1, 'kinhte_icon.png'],
    ['Thể thao', 2, 1, 'thethao_icon.png'],
    ['Xã hội', 3, 1, 'xahoi_icon.png']
];

foreach ($samples as $s) {
    // Insert dummy data using ON DUPLICATE KEY UPDATE in case they already exist to avoid errors.
    $sql = "INSERT INTO theloai (TenTL, ThuTu, AnHien, icon) VALUES ('{$s[0]}', '{$s[1]}', '{$s[2]}', '{$s[3]}') ON DUPLICATE KEY UPDATE icon='{$s[3]}'";
    mysqli_query($connect, $sql);
}
echo "Đã thêm dữ liệu mẫu!";
?>
