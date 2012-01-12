<?php if(CONFIG::enable_account_email_activation) return; ?>
  <div id="login-background" style="display: none;">&nbsp;</div>
  <div id="login-container" style="display: none;">
    <div id="login-container-inner">
      <div id="login-container-with-tabs">
        <div>
          <ul class="flat-list login-tabs" id="login-tabs">
          <li id="tab-login"><a href="">Login</a></li>
          <li id="tab-reset"><a href="">Reset password</a></li>
          </ul>
        </div>
        <div id="login" style="position: relative;">
          <p id="tab-login-text" class="tab-header-text">
            Please log in.  To create a new account, enter the name and password you
            want to use.
          </p>
          <p id="tab-reset-text" class="tab-header-text">
            If you supplied an email address when you signed up, you can have your password reset.
          </p>

          <form action="login" id="login-popup" method="post" onsubmit="alert('x')">
            <div style="position: absolute; top: 0; right: 0;">
              <a href="" id="login-popup-cancel" style="font-size: 1.2em; padding: 2px;">ⓧ</a>
            </div>

            <table class="form" style="width: 80%; max-width: 30em; margin-bottom: .5em; margin-left: auto; margin-right: auto;">
              <tr>
                <th style="width: 8em"><label class="block" for="login-popup-username">Name</label></th>
                <td style="width: 10em" align=left><input id="login-popup-username" name="username" type="text" style="width: 100%;"></td>
              </tr>
              <tr id="login-popup-email-box">
                <th><label class="block" for="login-popup-email">Email</label></th>
                <td align=left><input id="login-popup-email" name="email" type="text" style="width: 100%;"></td>
              </tr>
              <tr id="login-popup-password-box">
                <th><label class="block" for="login-popup-password">Password</label></th>
                <td align=left><input id="login-popup-password" name="password" type="password" style="width: 100%;"></td>
              </tr>
              <tr id="login-popup-password-confirm-box" style="display: none;">
                <th><label class="block" for="login-popup-password-confirm">Confirm Password</label></th>
                <td align=left><input id="login-popup-password-confirm" name="password-confirm" type="password" style="width: 100%;"></td>
              </tr>
              <tr>
                <th style="background: none;"></th>
                <td align=left>
                </td>
              </tr>
            </table>
            <a href="" id="login-popup-submit" style="margin-bottom: 1em; margin-left: auto; margin-right: auto;">Login</a>
          </form>

          <div id="login-popup-notices" class="login-popup-notice">
            <span id="login-popup-login-confirm-password">
              This user name doesn't exist.  If you want to create a new account, just
              verify your password and log in.
            </span>
            <span id="login-popup-login-user-exists">
              This user name exists.  If you want to create a new account, please choose
              a different name.
            </span>
            <span id="login-popup-reset-user-exists">
              Enter the email address you have registered in your profile.  You'll get an email containing your new password.
            </span>
            <span id="login-popup-reset-user-has-no-email">
              You have no email address in your profile, so you can't have your password reset.
            </span>
            <span id="login-popup-reset-successful">
              Password reset. Check your email in a few minutes.
            </span>
            <span id="login-popup-reset-unknown-user">
              That account does not exist.
            </span>
            <span id="login-popup-reset-blank">
            </span>
            <span id="login-popup-reset-user-email-incorrect">
              The email address specified is not registered with this account.
            </span>
            <span id="login-popup-reset-user-email-invalid">
              Delivery to this email address has failed.
            </span>
            <span id="login-popup-message">
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <script type="text/javascript">document.observe("dom:loaded", function() { User.init(); });</script>

