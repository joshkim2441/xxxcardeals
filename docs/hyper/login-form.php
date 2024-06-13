
<div id="login-dialog" title="xXx Car Dealers Login" style="display: none;">
    <form id="login-form" action="" method="post" role="form">
        <div class="input-field">
            <span id="email-info"></span> <input type="email"
                name="login-email-id" id="login-email-id" autocomplete="email_id"
                class="input-field" placeholder="Email ID">
        </div>
        <div class="input-field">
            <span id="password-info"></span> <input type="password"
                name="login-password" id="login-password"
                class="input-field" placeholder="Password">
        </div>
        <input type="button" class="btn-submit" value="Log In"
            onclick="ajaxLogin()"><br />
      </form>
    <div class="success-message" id="login-success-message"
        style="display: none"></div>
    <div class="error-message" id="login-error-message"
        style="display: none"></div>
    <div id="ajaxloader" style="display: none">
        <img src="../images/LoaderIcon.gif" id="loaderId" />
    </div>
    <div class="image" id="logo">
        <img src="../images/logoxxx.png" id="logoimage" />
    </div>
</div>
