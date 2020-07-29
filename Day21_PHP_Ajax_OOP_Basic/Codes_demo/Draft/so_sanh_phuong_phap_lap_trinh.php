<?php
//so_sanh_phuong_phap_lap_trinh.php
//So sánh các phương pháp lập trình từ trc đến giờ
//trong khóa học
// + Lập trình tuyến tính: phổ biến ở các bạn mới, nghĩ gì
//viết nấy. Vd: bài toán cộng 2 số
$a = 5;
$b = 6;
echo "$a + $b = " . ($a + $b);
//nhược điểm: khó bảo trì code khi project lớn, code ko
//có tính sử dụng lại, ko có bảo mật
// + Lập trình có cấu trúc - Function: đã biết viết hàm, chia
//project của bạn thành các chức năng, và mỗi chức năng
//đc viết thành hàm. Phương pháp này khá ổn khi chưa có
//lập trình hướng đối tượng
//vd: code 1 chức năng quản lý sinh viên, sẽ chia thành
//các function sau:
function connectDatabase() {}
function disconectDatabase() {}
function addStudent() {}
function editStudent() {}
function listStudent() {}
function deleteStudent() {}
// + Lập trình hướng đối tượng: đây chính là cách tiếp cận
//phổ biến nhất hiện nay, lấy đối tượng làm trung tâm, để
//đưa ra các thuộc tính và phương thức mà đối tượng đó
//có thể có
//VD: lấy đối tượng sinh viên để phân tích, thì các thuộc
//tính có thể có của sinh viên: id, name, age, birthday ..,
//có các phương thức: study, beer