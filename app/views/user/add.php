<?php 
HtmlHelper::formOpen('post', _WEB_ROOT.'/user/postuser/');
HtmlHelper::input('<div>', '<br>'.form_error('fullname').'</div>', 'text','fullname', '', '', 'Họ tên', old('fullname'));
HtmlHelper::input('<div>', '<br>'.form_error('email').'</div>', 'email','email', '', '', 'Email', old('email'));
HtmlHelper::input('<div>', '<br>'.form_error('age').'</div>', 'number','age', '', '', 'Tuoi', old('age'));
HtmlHelper::input('<div>', '<br>'.form_error('password').'</div>', 'password','password', '', '', 'Mat khau');
HtmlHelper::input('<div>', '<br>'.form_error('confirm_password').'</div>', 'password','confirm_password', '', '', 'Xac nhan mat khau');
HtmlHelper::submit('Xac nhan');
HtmlHelper::formClose();
?>