<?php
//example/thuc_hanh_2.php
//Tìm giá tiền điện theo bậc thang cho sẵn
//Yêu cầu validate:
//Nếu để trống ô nhập, báo lỗi ‘Không được để trống’
//Nếu nhập không phải số, báo lỗi ‘Cần phải nhập số‘
$error = '';
$result = '';
//debug
echo "<pre>";
print_r($_GET);
echo "</pre>";
if (isset($_GET['submit'])) {
    $number = $_GET['number'];
    //check validate -> tự làm
    //bỏ qua bước check validate
    if (empty($error)) {
        if ($number < 50 && $number > 0) {
            $result = $number * 1000;
        } elseif ($number >= 50) {
            $result = (50 * 1000) + ($number - 50) * 2000;
        }
        //hiển thị ra error và result -> tự làm
    }
}
?>

<form action="" method="get">
    Nhập số điện tiêu thụ
    <input type="text" name="number" value="" />
    <table border="1" cellspacing="0" cellpadding="8">
        <tr>
            <th colspan="2">
                Bảng giá theo bậc thang
            </th>
        </tr>
        <tr>
            <td>0 - 50KW</td>
            <td>
                <b>1000đ/KW</b>
            </td>
        </tr>
        <tr>
            <td>Trên 50 - 100KW</td>
            <td>
                <b>2000đ/KW</b>
                <br />
                Từ 0 - 50KW giá là 1000đ/KW
            </td>
        </tr>
    </table>
    <input type="submit" name="submit" value="Tính tiền điện" />
</form>
