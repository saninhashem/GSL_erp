<?php
/**********************************************************************
 Copyright (C) Grameen Solutions Ltd.(www.grameensolutions.com)
***********************************************************************/
function page_footer($no_menu=false, $is_index=false)
{
	global $path_to_root, $js_lib, $Validate, $Editors, $Ajax, $sql_queries;

	$page_header_args = func_get_args();
	hook_invoke_all('pre_footer', $page_header_args);

	include_once($path_to_root."/themes/".user_theme()."/renderer.php");
	$rend = new renderer();
	$rend->menu_footer($no_menu, $is_index);

	$edits = "editors = ".$Ajax->php2js($Editors).";";
	$Ajax->addScript('editors', $edits);

	echo "<script>
		_focus = '" . get_post('_focus') . "';
		_validate = " . $Ajax->php2js($Validate).";
		var $edits
	</script>";

   	add_user_js_data();
	echo "\n<script type=\"text/javascript\"><!--\n";

	foreach($js_lib as $text)
	  	echo $text;
	echo "\n--></script>\n";

	if ($sql_queries) {
		div_start('footer_debug');
		 echo "<div class='note_msg'>$sql_queries</div>";
		div_end();
	}
    echo "</body></html>\n";
}

?>