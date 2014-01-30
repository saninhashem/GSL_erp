<?php
/**********************************************************************
Copyright (C) Grameen Solutions Ltd.(www.grameensolutions.com)
***********************************************************************/
class dimensions_app extends application
{
	function dimensions_app()
	{
		$dim = get_company_pref('use_dimension');
		$this->application("proj", _($this->help_context = "&Dimensions"), $dim);

		if ($dim > 0)
		{
			$this->add_module(_("Transactions"));
			$this->add_lapp_function(0, _("Dimension &Entry"),
				"dimensions/dimension_entry.php?", 'SA_DIMENSION', MENU_ENTRY);
			$this->add_lapp_function(0, _("&Outstanding Dimensions"),
				"dimensions/inquiry/search_dimensions.php?outstanding_only=1", 'SA_DIMTRANSVIEW', MENU_TRANSACTION);

			$this->add_module(_("Inquiries and Reports"));
			$this->add_lapp_function(1, _("Dimension &Inquiry"),
				"dimensions/inquiry/search_dimensions.php?", 'SA_DIMTRANSVIEW', MENU_INQUIRY);

			$this->add_rapp_function(1, _("Dimension &Reports"),
				"reporting/reports_main.php?Class=4", 'SA_DIMENSIONREP', MENU_REPORT);
			
			$this->add_module(_("Maintenance"));
			$this->add_lapp_function(2, _("Dimension &Tags"),
				"admin/tags.php?type=dimension", 'SA_DIMTAGS', MENU_MAINTENANCE);

			$this->add_extensions();
		}
	}
}

?>