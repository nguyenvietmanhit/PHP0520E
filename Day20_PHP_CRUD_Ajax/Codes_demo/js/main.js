// js/main.js
//do đã tích hợp jquery, nên sẽ sử dụng các phương thức của
//jquery để thao tác
//document.ready đảm bảo code js của bạn đc chạy sau cùng, sau khi
//các HTML trên trang hiển thị hết, để đảm bảo ko bị lỗi
$(document).ready(function() {
   //luôn viết code js trong hàm ready
    //jQuery sử dụng selector giống hệt CSS
    //gọi sự kiện click trên nút Lưu đang có id=save
   $('#save').click(function() {
       //lấy các giá trị từ input tương ứng, để chuẩn bị
       //gửi vào Ajax
       //với các input sẽ dùng hàm val để lấy giá trị
       var name = $('#name').val();
       var description = $('#description').val();
       console.log(name);
       console.log(description);
       //goi ajax để nhờ PHP xử lý lưu thông tin vào CSDL
       //tạo đối tượng chứa các thông tin gọi ajax
       var obj_ajax = {
           //đường dẫn tới file php sẽ xử lý dữ liệu gửi từ ajax
           url: 'insert.php',
           //phương thức truyền dữ liệu: get/post
           method: 'post',
           //các dữ liệu sẽ gửi lên url
           data: {
               name: name,
               description: description
           },
           //nơi lưu trữ kết quả trả về từ url do PHP xử lý
           success: function(data) {
               console.log(data);
           }
       };
       //gọi ajax sử dụng jquery
       $.ajax(obj_ajax);
       //để debug xem ajax đang hoạt động trên trang web như thế
       //nào, sẽ sử dụng công cụ DevelopTool của trình duyệt,
       //thông qua tab Network
   });
});
