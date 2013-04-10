<?php
session_start();
include '../core/__load.php';

if(isset($_POST['ch_login_user'])):
    Login::do_login($_POST['ch_login_user'], $_POST['ch_login_pass']);
endif;

if(Login::ch_login_check()):
    
echo Template::render();

else:
    include APPPATH.'ch-login/index.php';
endif;