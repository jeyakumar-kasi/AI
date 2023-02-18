<?php

/* 
 * Author       : Jai K
 * Purpose      : Password Settings page
 * Created On   : 2021-08-09 21:32
 */
?>
<div id="change-password" class="row col-md-6 offset-md-3 dialog active">
    <form action="" method="post">
    <div class="form ">
        <div class="form-title">
            <h1>Change Password</h1>
        </div>

        <div class="row form-content">
            <div class="form-row">
                  <label>Current Password</label>
                  <input type="password" name="change_password" id="change-password" class="inp" autofocus/>
            </div>

            <div class="form-row">
                  <label>New Password</label>
                  <input type="password" name="new_password" id="new-password" class="inp"/>
            </div>

            <div class="form-row">
                  <label>Confirm Password</label>
                  <input type="password" name="confirm_password" id="confirm-password" class="inp"/>
            </div>

            <div class="form-row ctrls text-center">
                <a href="javascript: formValidate();" value="Login" class="col-md-2 btn active"><i class="fa fa-save"></i> Update</a>
                <input type="reset" value="Clear" class="col-md-2 btn" />
            </div>
        </div>
    </div>
  </form>
</div>

