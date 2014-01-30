<?php
/**********************************************************************
Copyright (C) Grameen Solutions Ltd.(www.grameensolutions.com)
***********************************************************************/
$page_security = 'SA_SOFTWAREUPGRADE';
$path_to_root="..";

include($path_to_root . "/includes/session.inc");

page(_($help_context = "System Diagnostics"));

include($path_to_root . "/includes/ui.inc");
include($path_to_root . "/includes/system_tests.inc");
//-------------------------------------------------------------------------------------------------

display_system_tests();

end_page();

?>
