<?php
/**********************************************************************
Copyright (C) Grameen Solutions Ltd.(www.grameensolutions.com)
***********************************************************************/
class hr_app extends application
{
	function hr_app()
	{
		$this->application("SS_HR", _($this->help_context = "&Human Resource"));

		$this->add_module(_("Employee"));
		$this->add_lapp_function(0, _("&Employee List"),
			"hr/hr_employee.php?List=Yes", 'SA_PAYMENT', MENU_TRANSACTION);
		$this->add_lapp_function(0, _("&Deposits"),
			"hr/gl_bank.php?NewDeposit=Yes", 'SA_DEPOSIT', MENU_TRANSACTION);
		$this->add_lapp_function(0, _("Bank Account &Transfers"),
			"hr/bank_transfer.php?", 'SA_BANKTRANSFER', MENU_TRANSACTION);
		$this->add_rapp_function(0, _("&Journal Entry"),
			"hr/gl_journal.php?NewJournal=Yes", 'SA_JOURNALENTRY', MENU_TRANSACTION);
		$this->add_rapp_function(0, _("&Budget Entry"),
			"hr/gl_budget.php?", 'SA_BUDGETENTRY', MENU_TRANSACTION);
		$this->add_rapp_function(0, _("&Reconcile Bank Account"),
			"hr/bank_account_reconcile.php?", 'SA_RECONCILE', MENU_TRANSACTION);
		$this->add_rapp_function(0, _("Revenue / &Costs Accruals"),
			"hr/accruals.php?", 'SA_ACCRUALS', MENU_TRANSACTION);

		$this->add_module(_("Time"));
		$this->add_lapp_function(1, _("&Attendance"),
			"attendence/attendence.php?", 'HR_ATTENDANCE', MENU_INQUIRY);
		$this->add_lapp_function(1, _("GL &Inquiry"),
			"hr/inquiry/gl_account_inquiry.php?", 'SA_GLTRANSVIEW', MENU_INQUIRY);
		$this->add_lapp_function(1, _("Bank Account &Inquiry"),
			"hr/inquiry/bank_inquiry.php?", 'SA_BANKTRANSVIEW', MENU_INQUIRY);
		$this->add_lapp_function(1, _("Ta&x Inquiry"),
			"hr/inquiry/tax_inquiry.php?", 'SA_TAXREP', MENU_INQUIRY);

		$this->add_rapp_function(1, _("Trial &Balance"),
			"hr/inquiry/gl_trial_balance.php?", 'SA_GLANALYTIC', MENU_INQUIRY);
		$this->add_rapp_function(1, _("Balance &Sheet Drilldown"),
			"hr/inquiry/balance_sheet.php?", 'SA_GLANALYTIC', MENU_INQUIRY);
		$this->add_rapp_function(1, _("&Profit and Loss Drilldown"),
			"hr/inquiry/profit_loss.php?", 'SA_GLANALYTIC', MENU_INQUIRY);
		$this->add_rapp_function(1, _("Banking &Reports"),
			"reporting/reports_main.php?Class=5", 'SA_BANKREP', MENU_REPORT);
		$this->add_rapp_function(1, _("General Ledger &Reports"),
			"reporting/reports_main.php?Class=6", 'SA_GLREP', MENU_REPORT);

		$this->add_module(_("Maintenance"));
		$this->add_lapp_function(2, _("Bank &Accounts"),
			"hr/manage/bank_accounts.php?", 'SA_BANKACCOUNT', MENU_MAINTENANCE);
		$this->add_lapp_function(2, _("&Quick Entries"),
			"hr/manage/gl_quick_entries.php?", 'SA_QUICKENTRY', MENU_MAINTENANCE);
		$this->add_lapp_function(2, _("Account &Tags"),
			"admin/tags.php?type=account", 'SA_GLACCOUNTTAGS', MENU_MAINTENANCE);
		$this->add_lapp_function(2, "","");
		$this->add_lapp_function(2, _("&Currencies"),
			"hr/manage/currencies.php?", 'SA_CURRENCY', MENU_MAINTENANCE);
		$this->add_lapp_function(2, _("&Exchange Rates"),
			"hr/manage/exchange_rates.php?", 'SA_EXCHANGERATE', MENU_MAINTENANCE);

		$this->add_rapp_function(2, _("&GL Accounts"),
			"hr/manage/gl_accounts.php?", 'SA_GLACCOUNT', MENU_ENTRY);
		$this->add_rapp_function(2, _("GL Account &Groups"),
			"hr/manage/gl_account_types.php?", 'SA_GLACCOUNTGROUP', MENU_MAINTENANCE);
		$this->add_rapp_function(2, _("GL Account &Classes"),
			"hr/manage/gl_account_classes.php?", 'SA_GLACCOUNTCLASS', MENU_MAINTENANCE);
		$this->add_rapp_function(2, "","");
		$this->add_rapp_function(2, _("&Revaluation of Currency Accounts"),
			"hr/manage/revaluate_currencies.php?", 'SA_EXCHANGERATE', MENU_MAINTENANCE);

		$this->add_extensions();
	}
}


?>