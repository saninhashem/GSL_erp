<?php
/**********************************************************************
    Copyright (C) Grameen Solutions Ltd.(www.grameensolutions.com)
***********************************************************************/
$page_security = 'SA_WORKORDERCOST';
$path_to_root = "../..";
include_once($path_to_root . "/includes/session.inc");

page(_($help_context = "Costed Bill Of Material Inquiry"));

include_once($path_to_root . "/manufacturing/includes/manufacturing_ui.inc");
include_once($path_to_root . "/includes/manufacturing.inc");
include_once($path_to_root . "/includes/ui.inc");
include_once($path_to_root . "/includes/banking.inc");
include_once($path_to_root . "/includes/data_checks.inc");

check_db_has_bom_stock_items(_("There are no manufactured or kit items defined in the system."));

if (isset($_GET['stock_id']))
{
	$_POST['stock_id'] = $_GET['stock_id'];
} 
if (list_updated('stock_id'))
		$Ajax->activate('_page_body');

start_form(false, true);
start_table(TABLESTYLE_NOBORDER);
stock_manufactured_items_list_row(_("Select a manufacturable item:"), 'stock_id', null, false, true);
end_table();
br();
display_heading(_("All Costs Are In:") . " " . get_company_currency());
display_bom($_POST['stock_id']);

end_form();

end_page();
?>
