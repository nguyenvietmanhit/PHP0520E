//crud_ajax/js/main.js
// Code JS để xử lý ajax thêm mới danh mục
//luôn viết code trong hàm ready, để đảm bảo code js luôn chạy
//sau cùng (chờ HTML tải xong hết r JS mới chạy)
$(document).ready(function() {
    //code JS
    //xử lý lưu dữ liệu khi user submit form
    $('#form').submit(function () {
        //ngăn ngừa hành vi submit form
        //đối tượng event đc sinh mặc định khi gọi sự kiện
        event.preventDefault();
        // alert("submitted!");
        //lấy tất cả dữ liệu gửi từ form sử dụng JS
        //hàm serialize ko lấy đc dữ liệu dạng file
        var form_data = $(this).serialize();
        console.log(form_data);
        //khai báo 1 đối tượng ajax
        var obj_ajax = {
            //đường dẫn file sẽ xử lý dữ liệu truyền lên từ ajax
            url: 'ajax_create.php',
            //phương thức gửi dữ liệu url khai báo trên
            method: 'post',
            data: form_data,
            success: function(data) {
                //biến data chính là dữ liệu trả về sau khi xử lý
                //từ url khai báo ở trên
                console.log(data);
                if (data == 1) {
                    $('#form').before('Insert thành công');
                } else {
                    $('#form').before('Insert thất bại');
                }
            }
        };
        //gọi ajax
        $.ajax(obj_ajax);
        //cách debug ajax đang chạy trên trang, dựa vào Inspect HTML
        //, tab Network, phần XHR chứa tất cả các url liên quan
        //đến Ajax nếu có
    });
});
