var form_obj = document.getElementById('form');
form_obj.addEventListener('submit', function () {
    var number1_obj = document.getElementById('number1');
    var number1 = number1_obj.value;

    var error = '';
    var result_obj = document.getElementById('result');

    if (number1 == '') {
        error = 'Không được phép bỏ trống dữ liệu';
    }
    else if (isNaN(number1) == true) {
        error = 'Phải nhâp số';
    }
    else {
        var boolean = true;
        number1 = parseInt(number1);
        if (number1 < 2) {
            boolean = false;
        }
        else {
            for (var i = 2; i < number1 / 2; i++) {
                if (number1 % i == 0) {
                    boolean = false;
                    break;
                }
            }
        }
        if (boolean == false) {
            result_obj.innerHTML = number1 + " không phải là số nguyên tố";
        }
        else {
            result_obj.innerHTML = number1 + " là số nguyên tố";
        }
    }

    var error_obj = document.getElementById('error');
    error_obj.innerHTML = error;


    event.preventDefault();
});





