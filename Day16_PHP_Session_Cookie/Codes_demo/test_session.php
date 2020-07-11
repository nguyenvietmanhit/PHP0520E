<?php
session_start();
//test_session.php
//Demo việc hiển thị biến session và biến thông thường đã khai báo
//ở file demo_session.php
//hiển thị biến session
//1 biến khi đc khai báo bằng session thì sẽ đc truy cập từ bất
//cứ nơi nào trên hệ thống
echo $_SESSION['name']; //Mạnh
//hiển thị biến $test
echo $test; //báo lỗi ko biết biến này từ đâu sinh ra