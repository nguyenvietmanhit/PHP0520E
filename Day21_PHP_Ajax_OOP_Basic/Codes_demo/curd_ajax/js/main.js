//crud_ajax/js/main.js
// Code JS để xử lý ajax thêm mới danh mục
//luôn viết code trong hàm ready, để đảm bảo code js luôn chạy
//sau cùng (chờ HTML tải xong hết r JS mới chạy)
$(document).ready(function() {
    //code JS
    //Code xử lý click link thì gọi ajax để lấy danh sách category
    //Các trình duyệt có cơ chế lưu cache CSS và JS, cần có bước
    //cache trình duyệt để nó hiểu đc các thay đổi của bạn, có 1
    // phím tắt trong Chrome: Ctrl + Shift + R
    $('#ajax-link').click(function() {
       // alert('clicked!');
        //khai báo 1 đối tượng chứa các thông tin về ajax
        var obj_ajax = {
          url: 'get_category_ajax.php',
          method: 'get',
            //kiểu dữ liệu mong muốn sẽ trả về từ PHP: text, json
          dataType: 'text',
          data: {
              //với chức năng liệt kê thì ko cần gửi dữ liệu gì lên,
              //với chức năng như cập nhật/xóa cần phải id nên sẽ
              //phải truyền tham số lên
          },
            //tham số data trong hàm chính là dữ liệu trả về
            //từ PHP
          success: function(data) {
              //biến data chính là kết quả trả về trong tab Response
              //của tab Network
              // console.log(data);
              //hiển thị data ngay phía sau của link hiện tại
              // $('#ajax-link').after(data);

              $('#result-ajax').html(data);
          }
        };
        //gọi ajax
        $.ajax(obj_ajax);
    });


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
