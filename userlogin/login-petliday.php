<?php include __DIR__ . '/../parts/html-script.php' ?>
<link rel="stylesheet" href="user-login.css">

<!-- Model -->
<div class="modal fade" id="register_show" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">

    <div class="modal-content">
      <div class="login">

        <form class="login-form" name="apply_form" onsubmit="checkFormRegister(); return false;">
          <!-- return false避免預設的行為 -->
        <div id="apply_info_bar" class="alert alert-danger" role="alert" style="display: none"></div>
        <button data-dismiss="modal" class="close" style="position:absolute;top:14px;right:0;">
          <span aria-hidden="true">×</span>
        </button>
                                                                                                               
          <h2 class="t-xl">使用社群平台帳戶登入</h2>
          <h2 class="t-m">立即登入，隨時給毛孩獨家優惠</h2>
          <div class="login-social d-flex justify-content-center">
            <div class="login-facebook m-4"><img src="/PETLIDAY/userlogin/imgs/facebook.svg" alt=""></div>
            <div class="login-line m-4"><img src="/PETLIDAY/userlogin/imgs/LINE.svg" alt=""></div>
            <div class="login-google m-4"><img src="/PETLIDAY/userlogin/imgs/Google.svg" alt=""></div>
            <div class="login-apple m-4"><img src="/PETLIDAY/userlogin/imgs/apple.svg" alt=""></div>
          </div>

          <div class="login-border">
            <div class="text-or">或</div>
          </div>

          <h2 class="t-xl">免費註冊</h2>

          <div class="login-group input-icon">
            <!-- <label for="account">帳號</label> -->
            <input type="email" class="form-control" id="apply_email" name="apply_email" placeholder="電子信箱">
            <img class="icon-msg" src="/PETLIDAY/userlogin/imgs/mail.svg">
            <i class="fas fa-exclamation-circle"></i>
            <i class="fas fa-check-circle"></i>
            <small class="form-text">請輸入您的電子信箱</small>
          </div>

          <div class="login-group input-icon">
            <!-- <label for="password">密碼</label> -->
            <input type="password" class="form-control" id="apply_password" name="apply_password" placeholder="密碼（至少六位數字）">
            <img class="icon-psd" src="/PETLIDAY/userlogin/imgs/password.svg">
            <i class="fas fa-exclamation-circle"></i>
            <i class="fas fa-check-circle"></i>
            <small class="form-text">請輸入密碼</small>
          </div>

          <div class="login-group-2">
            <button class="login-btn btn">註冊</button>
          </div>

          <div class="login-other d-flex justify-content-center">
            <a data-toggle="modal" data-target="#exampleModalCenter" data-dismiss="modal">Petliday會員登入</a>
            <span>｜</span>
            <a data-toggle="modal" data-target="#noVerifiedEmail" data-dismiss="modal">尚未收到驗證信？</a>
          </div>

          <!-- 一鍵輸入 -->
          <div class="auto-input">
            <button class="input-correct"></button>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>

<!-- ---------------js/jq 開始 ------------------ -->

<script>
  const email_re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;


    function checkFormRegister() { 
      const email = $('#apply_email'),
      password = $('#apply_password'),
      info_bar = $('#apply_info_bar');

      // 如果電子信箱為"空值"，就出現「請輸入您的電子信箱」
      let isPass = true;
      if(email.val()==''){
        isPass = false;
         $('.form-text').eq(0).text('請輸入您的電子信箱')
         email.closest('.login-group').removeClass('success')
         email.closest('.login-group').addClass('error')
      }

      // 此外如果電子信箱為"格式錯誤"，就出現「請輸入有效的電子信箱」
      else if (!email_re.test(email.val())) {
         isPass = false;
         $('.form-text').eq(0).text('請輸入有效的電子信箱')
         email.closest('.login-group').removeClass('success')
         email.closest('.login-group').addClass('error')
      } else {
        email.closest('.login-group').removeClass('error')
        email.closest('.login-group').addClass('success');
      }

      // 如果密碼值小於6
      if (password.val().length < 6) {
         isPass = false;
         password.closest('.login-group').removeClass('success')
         password.closest('.login-group').addClass('error')
      } else {
        password.closest('.login-group').removeClass('error')
        password.closest('.login-group').addClass('success');
      }


      if (isPass) {
        $.post('/PETLIDAY/userlogin/login-petliday-api.php', $(document.apply_form).serialize(), function(data) {
          console.log(data);
          if (data.success) {
            info_bar
              .removeClass('alert-danger')
              .addClass('alert-success')
              .text('註冊成功');
          } else {
            info_bar
              .removeClass('alert-success')
              .addClass('alert-danger')
              .text(data.error || '註冊失敗');
          }
          info_bar.slideDown();

          setTimeout(function() {
            info_bar.slideUp();
            location.reload();
          }, 1000);
        }, 'json')
      }

    }


  // 一鍵輸入：正確登入
  $('.input-correct').click(function(event) {
    event.preventDefault();
    $('#apply_email').val('boy123@petliday.com');
    $('#apply_password').val('test123');
  })
</script>