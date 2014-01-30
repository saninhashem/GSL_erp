<?php
/**********************************************************************
Copyright (C) Grameen Solutions Ltd.(www.grameensolutions.com)
***********************************************************************/
class manufacturing_app extends application
{
	function manufacturing_app()
	{
		$this->application("manuf", _($this->help_context = "&Manufacturing"));

		$this->add_module(_("Transactions"));
		$this->add_lapp_function(0, _("Work &Order Entry"),
			"manufacturing/work_order_entry.php?", 'SA_WORKORDERENTRY', MENU_TRANSACTION);
		$this->add_lapp_function(0, _("&Outstanding Work Orders"),
			"manufacturing/search_work_orders.php?outstanding_only=1", 'SA_MANUFTRANSVIEW', MENU_TRANSACTION);

		$this->add_module(_("Inquiries and Reports"));
		$this->add_lapp_function(1, _("Costed Bill Of Material Inquiry"),
			"manufacturing/inquiry/bom_cost_inquiry.php?", 'SA_WORKORDERCOST', MENU_INQUIRY);
		$this->add_lapp_function(1, _("Inventory Item Where Used &Inquiry"),
			"manufacturing/inquiry/where_used_inquiry.php?", 'SA_WORKORDERANALYTIC', MENU_INQUIRY);
		$this->add_lapp_function(1, _("Work Order &Inquiry"),
			"manufacturing/search_work_orders.php?", 'SA_MANUFTRANSVIEW', MENU_INQUIRY);
		$this->add_rapp_function(1, _("Manufacturing &Reports"),
			"reporting/reports_main.php?Class=3", 'SA_MANUFTRANSVIEW', MENU_REPORT);

		$this->add_module(_("Maintenance"));
		$this->add_lapp_function(2, _("&Bills Of Material"),
			"manufacturing/manage/bom_edit.php?", 'SA_BOM', MENU_ENTRY);
		$this->add_lapp_function(2, _("&Work Centres"),
			"manufacturing/manage/work_centres.php?", 'SA_WORKCENTRES', MENU_MAINTENANCE);

		$this->add_extensions();
	}
}


?>