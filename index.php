<?php
include 'db.php';

$message = '';

// Xử lý xóa thiết bị
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $sql = "DELETE FROM thiet_bi WHERE id = $delete_id";

    if ($conn->query($sql) === TRUE) {
        $message = "Xóa thiết bị thành công!";
    } else {
        $message = "Lỗi: " . $conn->error;
    }

    // Chuyển hướng lại trang sau khi xử lý
    header("Location: index.php?message=" . urlencode($message));
    exit;
}

// Xử lý thêm thiết bị
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ten_thiet_bi'])) {
    $ten = $_POST['ten_thiet_bi'];
    $loai = $_POST['loai_thiet_bi'];
    $so_luong = $_POST['so_luong'];
    $tinh_trang = $_POST['tinh_trang'];
    $ghi_chu = $_POST['ghi_chu'];

    $sql = "INSERT INTO thiet_bi (ten_thiet_bi, loai_thiet_bi, so_luong, tinh_trang, ghi_chu) 
            VALUES ('$ten', '$loai', $so_luong, '$tinh_trang', '$ghi_chu')";

    if ($conn->query($sql) === TRUE) {
        $message = "Thêm thiết bị thành công!";
    } else {
        $message = "Lỗi: " . $conn->error;
    }

    // Chuyển hướng lại trang sau khi xử lý
    header("Location: index.php?message=" . urlencode($message));
    exit;
}

// Kiểm tra thông báo từ tham số URL
if (isset($_GET['message'])) {
    $message = $_GET['message'];
}

// Hiển thị tiêu đề trang
echo "<h1 style='font-size: 32px; text-align: center; margin-bottom: 20px;'>Website quản lý thiết bị dạy học và văn phòng phẩm của THPT Trần Phú</h1>";
?>

<!-- Alert Box -->
<div id="alertBox" style="display: none; position: absolute; top: 20px; left: 50%; transform: translateX(-50%); background-color: #f0f8ff; border: 1px solid #007bff; padding: 10px; border-radius: 5px; z-index: 1000;">
    <span id="alertMessage"></span>
</div>

<!-- Form thêm thiết bị mới -->
<h3>Thêm thiết bị mới</h3>
<form method="post" action="index.php">
    Tên thiết bị: <input type="text" name="ten_thiet_bi" required><br>
    Loại thiết bị:
    <select name="loai_thiet_bi" required>
        <option value="day hoc">Dạy học</option>
        <option value="van phong">Văn phòng</option>
    </select><br>
    Số lượng: <input type="number" name="so_luong" required><br>
    Tình trạng:
    <select name="tinh_trang" required>
        <option value="moi">Mới</option>
        <option value="da su dung">Đã sử dụng</option>
        <option value="can sua chua">Cần sửa chữa</option>
    </select><br>
    Ghi chú: <textarea name="ghi_chu"></textarea><br>
    <input type="submit" value="Thêm thiết bị" style="display: inline-block;">
    <button type="button" onclick="toggleTable()" style="display: inline-block;">Ẩn/Hiện danh sách thiết bị</button>
</form>

<!-- Bảng danh sách thiết bị -->
<div id="deviceTable" style="display: block; margin-top: 20px;">
    <?php
    // Hiển thị danh sách thiết bị
    $result = $conn->query("SELECT * FROM thiet_bi");

    echo "<h2>Danh sách thiết bị</h2>";
    echo "<table border='1'><tr><th>Tên thiết bị</th><th>Loại thiết bị</th><th>Số lượng</th><th>Tình trạng</th><th>Ghi chú</th><th>Hành động</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["ten_thiet_bi"] . "</td>
                <td>" . $row["loai_thiet_bi"] . "</td>
                <td>" . $row["so_luong"] . "</td>
                <td>" . $row["tinh_trang"] . "</td>
                <td>" . $row["ghi_chu"] . "</td>
                <td><a href='index.php?delete_id=" . $row["id"] . "' onclick=\"return confirm('Bạn có chắc chắn muốn xóa thiết bị này?');\">Xóa</a></td>
              </tr>";
    }
    echo "</table>";
    ?>
</div>

<!-- JavaScript để hiển thị alert và xóa tham số trong URL -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var alertBox = document.getElementById("alertBox");
        var alertMessage = document.getElementById("alertMessage");

        // Hiển thị alert nếu có message
        <?php if (!empty($message)): ?>
            alertMessage.innerText = "<?php echo htmlspecialchars($message); ?>";
            alertBox.style.display = "block";

            // Tự động ẩn alert sau 3 giây
            setTimeout(function() {
                alertBox.style.display = "none";
            }, 3000);
        <?php endif; ?>

        // Xóa tham số URL 'message' sau khi hiển thị alert
        if (window.history.replaceState) {
            var url = new URL(window.location);
            url.searchParams.delete('message');
            window.history.replaceState(null, null, url);
        }

        // Kiểm tra trạng thái ẩn/hiện từ localStorage khi tải trang
        var table = document.getElementById("deviceTable");
        var isTableVisible = localStorage.getItem("deviceTableVisible");

        if (isTableVisible === "hidden") {
            table.style.display = "none";
        } else {
            table.style.display = "block";
        }
    });

    // Hàm ẩn/hiện bảng danh sách thiết bị và lưu trạng thái vào localStorage
    function toggleTable() {
        var table = document.getElementById("deviceTable");
        if (table.style.display === "none") {
            table.style.display = "block";
            localStorage.setItem("deviceTableVisible", "visible");
        } else {
            table.style.display = "none";
            localStorage.setItem("deviceTableVisible", "hidden");
        }
    }
</script>

<?php $conn->close(); ?>
