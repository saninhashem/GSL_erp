<?php
/**********************************************************************
Copyright (C) Grameen Solutions Ltd.(www.grameensolutions.com)
***********************************************************************/
/*
	User authentication page popped up after login timeout during ajax call.
*/
$path_to_root = '..';
$page_security = 'SA_OPEN';
include_once($path_to_root . "/includes/session.inc");

include($path_to_root .'/access/login.php');

if (get_post('SubmitUser') && $_SESSION['wa_current_user']->logged_in()) {
	// After successfull login repeat last ajax call.
	// Login form consists all post variables from last ajax call.
echo "<script>
	var o = opener;
	if (o) {
		o.JsHttpRequest.request(document.getElementsByName('SubmitUser')[0], o.document.forms[0]);
		close();
	}
</script>";
}
?>
