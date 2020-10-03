<?php
/**
 * huong_dan_code_teamwork_theo_git.php
 * 1 - Tình huống:
 * + Giảng viên là PM dự án, cần tuyển 3 bạn trong lớp join cùng để
 * code chung 1 dự án
 * + Đầu tiên PM sẽ tạo 1 respository chứa code của dự án, sau đó PM
 * sẽ add từng thành viên vào dự án
 * + Các member comment tài khoản github để PM add vào dự án, comment tại
 * status của buổi học
 * + PM sau khi tạo repository sẽ vào repo đó, click tab Settings, r
 * click chức năng Manage Access để bắt đầu add các thành viên vào
 * dự án dựa vào tài khoản github của họ, click Invite a collaborator
 * + Các thành viên sau khi đồng ý join vào dự án, thao tác đầu tiên
 * sẽ là lấy code dự án về:
 * git clone <url>
 * + Member tạo 1 nhánh mới từ nhánh master, sau đó nhảy sang nhánh
 * mới tạo luôn
 * git checkout -b <tên-nhánh-tự-đặt>
 * VD: git checkout -b code_login
 * + Demo các member code trên local, đẩy các file lên hệ thống, bằng
 * cách tạo 1 số file, dùng lại các lệnh git add, git commit , git push,
 * tuy nhiên khi push sẽ push lên chính nhánh hiện tại
 */