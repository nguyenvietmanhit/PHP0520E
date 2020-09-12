// frontend/assets/js/script.js
//Xử lý ajax cho chúc năng Thêm vào giỏ hàng
$(document).ready(function () {
    //Xử lý sự kiện click trên class add-to-cart
    $('.add-to-cart').click(function () {
       //Cần xử lý để lấy ra đc đúng id của sản phẩm vừa
        //click, để khi gọi ajax sẽ truyền id này lên
        //Thêm 1 thuộc tính gì đó chứa id của sản phẩm ngay
        //tại đối tượng đang click, đặt thuộc tính đó = data-id
        var product_id = $(this).attr('data-id');
        //Gọi ajax sử dụng jQuery
        $.ajax({
            //đường dẫn mvc xử lý ajax
            url: 'index.php?controller=cart&action=add',
            // phương thức gửi dữ liệu
            method: 'GET',
            // dữ liệu gửi lên
            data: {
                product_id: product_id
            },
            // nơi nhận kết quả trả về từ url, tất cả dữ liệu
            //đó đc lưu trong tham số data của hàm
            success: function(data) {
                console.log(data);
                //Sử dụng tab Network của trình duyệt để debug
                //các thông tin liên quan đến gọi ajax
                //Đã có sẵn 1 class = ajax-message đang ẩn để
                //chứa các message Thêm giỏ hàng thành công
                $('.ajax-message')
                .html('Thêm vào giỏ thành công')
                .addClass('ajax-message-active');
                //Sử dụng hàm setTimeout để set thời gian chuyển
                //đổi cho 1 selector
                //Chờ 3s sẽ ẩn message đi
                setTimeout(function(){
                    $('.ajax-message').removeClass('ajax-message-active')
                }, 3000);
                //Xử lý update số lượng trong giỏ
                //Lấy nội dung của class cart-amount
                var cart_total = $('.cart-amount').html();
                cart_total++;
                //Set lại nội dung mới cho class cart-amount
                $('.cart-amount').html(cart_total);
            }
        });
    });
});