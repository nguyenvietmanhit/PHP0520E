<!--footer-->
<div class="footer">
    <div class="container">
        <div class="row">
            <div class="image-footer-wrap col-md-3">
                LOGO
            </div>
            <div class="address-footer-wrap col-md-6">
                <strong>Thông tin liên hệ</strong>
                Tòa nhà CMC, Số 11, Phố Duy Tân, Phường Dịch Vọng Hậu, Cầu Giấy, Hà Nội <br/>
                Hotline: 0999999999 <br/>
                Email: abc@gmail.com
            </div>
            <div class="social-footer-wrap col-md-3">
                <strong>Kết nối với chúng tôi</strong>
                <ul>
                    <li>
                        <a href="#">
                            <i class="color fab fa-facebook" aria-hidden="true"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="color fab fa-youtube" aria-hidden="true"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="color fab fa-google-plus-g"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <p class="footer-copyright">
            Copyright 2020 by nvmanh. All rights reserved
        </p>
    </div>
</div>


<div class="overlay"></div>

<ul class="icon-service-wrap">
    <li data-toggle="tooltip" data-placement="left" title="Gọi ngay cho chúng tôi">
        <a href="tel:0999999999">
            <img src="assets/images/icon-phone.png" class="icon-service-img"/>
        </a>
    </li>
    <li data-toggle="tooltip" data-placement="left" title="Chat với chúng tôi qua Zalo">
        <a href="//zalo.me/0999999999" target="_blank">
            <img src="assets/images/icon-zalo.png" class="icon-service-img"/>
        </a>
    </li>
    <li data-toggle="tooltip" data-placement="left" title="Gửi mail cho chúng tôi">
        <a href="mailto:abc@gmail.com">
            <img src="assets/images/icon-mail.png" class="icon-service-img"/>
        </a>
    </li>
    <li data-toggle="tooltip" data-placement="left" title="Liên hệ với chúng tôi">
        <a href="/lien-he.html" target="_blank">
            <img src="assets/images/icon-map.png" class="icon-service-img"/>
        </a>
    </li>
</ul>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

<!-- Tooltip plugin (zebra) js file -->
<script src="assets/js/zebra_tooltips.min.js"></script>


<!-- Owl Carousel plugin js file -->
<script src="assets/js/owl.carousel.min.js"></script>

<!-- Ideabox theme js file. you have to add all pages. -->
<script src="assets/js/jquery.show-more.js"></script>
<script src="assets/js/script.js"></script>
<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
<script>
  window.fbAsyncInit = function () {
    FB.init({
      xfbml: true,
      version: 'v7.0'
    });
  };

  (function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s);
    js.id = id;
    js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));
</script>