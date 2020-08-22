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
CKEDITOR.replace('description', {
    //đường dẫn đến file ckfinder.html của ckfinder
    filebrowserBrowseUrl: 'assets/ckfinder/ckfinder.html',
    //đường dẫn đến file connector.php của ckfinder
    filebrowserUploadUrl: 'assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
});

//+ Sử dụng JS xử lý show ảnh preview khi upload file
// Search google với từ khóa sau:
//jquery show upload image preview
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            //selector của ảnh preview sẽ đc gán src
            $('#img-preview').attr('src', e.target.result);
            //hiển thị selector lên vì mặc định về mặt HTML
            //selector đang display:none
            $('#img-preview').show();
        }
        reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
}
$("input[type=file]").change(function () {
    readURL(this);
});
