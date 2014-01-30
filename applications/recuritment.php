<?php

class recuritment_app extends application
{
	function recuritment_app()
	{
		$this->application("RECURITMENT", _($this->help_context = "&Recuritment"));

		$this->add_module(_("Transactions"));
		$this->add_lapp_function(0, _("&Create/Modify/Edit Payroll"),"hr/prlSelectPayroll.php", 'HR_CREATEPAYROLL', MENU_TRANSACTION);
		$this->add_lapp_function(0, _("&Employee Loan Deduction Entry"),"hr/prlSelectLoan.php", 'HR_LOANDEDUCIONENTRY', MENU_TRANSACTION);
		$this->add_lapp_function(0, _("&Regular Time Data Entry"),"hr/prlRegTimeEntry.php", 'HR_REGULARTIMEDATAENTRY', MENU_TRANSACTION);
		$this->add_lapp_function(0, _("&Overtime Data Entry"),"hr/prlOtFile.php", 'HR_OVERTIMEDATAENTRY', MENU_TRANSACTION);
		$this->add_lapp_function(0, _("&Lates and Absents Data Entry"),"hr/prlTardiness.php", 'HR_LATEABSENTDATAENTRY', MENU_TRANSACTION);
		$this->add_lapp_function(0, _("&Other Income Data Entry"),"hr/prlOthIncome.php", 'HR_OTHERINCOMEDATAENTRY', MENU_TRANSACTION);
		$this->add_rapp_function(0, _("&View Regular Time"),"hr/prlSelectRT.php", 'HR_VIEWREGULARTIME', MENU_TRANSACTION);
		$this->add_rapp_function(0, _("&View Overtime"),"hr/prlSelectOT.php", 'HR_VIEWOVERTIME', MENU_TRANSACTION);
		$this->add_rapp_function(0, _("&View Payroll Trans"),"hr/prlSelectPayTrans.php", 'HR_VIEWPAYROLLTRANS', MENU_TRANSACTION);
		$this->add_rapp_function(0, _("&View Payroll Deduction"),"hr/prlSelectDeduction.php", 'HR_VIEWPAYROLLDEDUCTION', MENU_TRANSACTION);
		$this->add_rapp_function(0, _("&View Lates and Absenses"),"hr/prlSelectTD.php", 'HR_VIEWLATEABSENT', MENU_TRANSACTION);
		$this->add_rapp_function(0, _("&View Other Income Data"),"hr/prlSelectOthIncome.php", 'HR_VIEWOTHERINCOMEDATA', MENU_TRANSACTION);
		
		
		
		
		

			
			
			
		$this->add_module(_("Inquiries and Reports"));
		$this->add_lapp_function(1, _("&Journal Inquiry"),
			"gl/inquiry/journal_inquiry.php?", 'SA_GLANALYTIC', MENU_INQUIRY);
		$this->add_lapp_function(1, _("GL &Inquiry"),
			"gl/inquiry/gl_account_inquiry.php?", 'SA_GLTRANSVIEW', MENU_INQUIRY);
		$this->add_lapp_function(1, _("Bank Account &Inquiry"),
			"gl/inquiry/bank_inquiry.php?", 'SA_BANKTRANSVIEW', MENU_INQUIRY);
		$this->add_lapp_function(1, _("Ta&x Inquiry"),
			"gl/inquiry/tax_inquiry.php?", 'SA_TAXREP', MENU_INQUIRY);

		$this->add_rapp_function(1, _("Trial &Balance"),
			"gl/inquiry/gl_trial_balance.php?", 'SA_GLANALYTIC', MENU_INQUIRY);
		$this->add_rapp_function(1, _("Balance &Sheet Drilldown"),
			"gl/inquiry/balance_sheet.php?", 'SA_GLANALYTIC', MENU_INQUIRY);
		$this->add_rapp_function(1, _("&Profit and Loss Drilldown"),
			"gl/inquiry/profit_loss.php?", 'SA_GLANALYTIC', MENU_INQUIRY);
		$this->add_rapp_function(1, _("Banking &Reports"),
			"reporting/reports_main.php?Class=5", 'SA_BANKREP', MENU_REPORT);
		$this->add_rapp_function(1, _("General Ledger &Reports"),
			"reporting/reports_main.php?Class=6", 'SA_GLREP', MENU_REPORT);

		$this->add_module(_("Maintenance"));
		$this->add_lapp_function(2, _("Job Category Information"),"recuritment/manage/job_category.php", 'RECURITMENT_JOB_CAT', MENU_MAINTENANCE);
		$this->add_lapp_function(2, _("Job Title Information"),"recuritment/manage/job_title.php", 'RECURITMENT_JOB_TITLE', MENU_MAINTENANCE);
			
		
		
		$this->add_extensions();
	}
}


?>