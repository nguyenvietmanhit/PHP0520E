// assets/js/script.js
// File js chính của ứng dụng
// Code để nhúng CKEditor như sau, truyền giá trị của
// thuộc tính name ứng với textarea muốn tích hợp:
//Xóa cache trình duyệt: Ctrl + Shift + R
//+ Mặc định CKEditor ko có chức năng upload ảnh từ máy tính
//của bạn lên
// + Cần tích hợp CKFinder để cho phép upload ảnh từ local
// + Thay đổi lại nội dung của phương thức replace như sau:
// CKEDITOR.replace('category_description');
CKEDITOR.replace('category_description' , {
    //đường dẫn đến file ckfinder.html của ckfinder
    filebrowserBrowseUrl: 'assets/ckfinder/ckfinder.html',
    //đường dẫn đến file connector.php của ckfinder
    filebrowserUploadUrl: 'assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
});
