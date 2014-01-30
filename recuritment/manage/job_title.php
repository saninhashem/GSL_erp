<?php
/**********************************************************************
Copyright (C) Grameen Solutions Ltd.(www.grameensolutions.com)
***********************************************************************/
$page_security = 'RECURITMENT_JOB_TITLE';
$path_to_root = "../..";
include($path_to_root . "/includes/session.inc");

page(_($help_context = "Job Title"));

include($path_to_root . "/recuritment/includes/recuritment_db.inc");

include($path_to_root . "/includes/ui.inc");

simple_page_mode(false);
//-----------------------------------------------------------------------------------

if ($Mode=='ADD_ITEM' || $Mode=='UPDATE_ITEM')
{

	$input_error = 0;

	if (strlen(trim($_POST['job_category_name'])) == ""){
		$input_error = 1;
		display_error( _("Job Category Name can not be empty."));
		set_focus('job_category_name');
	}

	////////////////Dublicate check///////
	if ($input_error != 1){

		if ($selected_id != "")
		{
			if (update_recuritment_job_category($_POST,$selected_id))
			display_notification(_('Selected job category has been updated'));
		}
		else
		{
			if (add_recuritment_job_category($_POST)) {
				display_notification(_('New job category has been added'));
			}
		}
		$Mode = 'RESET';

	}
}
if ($Mode == 'Delete')
{
	delete_recuritment_job_category($selected_id);
	display_notification(_('Selected job category has been deleted'));
	$Mode = 'RESET';
}
if ($Mode == 'RESET')
{
	$selected_id = "";
	$_POST['id']  = $_POST['name']  = '';
	unset($_POST['parent']);
	unset($_POST['class_id']);
}
//-----------------------------------------------------------------------------------

$result = get_recuritment_job_titles();
start_form();
start_table(TABLESTYLE);
$th = array(_("Job Title"), _("Job Description"), _("Job Category ID"), _("Note"), _("Is Active"), "", "");
table_header($th);

$k = 0;
while ($myrow = db_fetch($result))
{
	alt_table_row_color($k);
	label_cell($myrow["job_title"]);
	label_cell($myrow["job_description"]);
	label_cell($myrow["job_category_id"]);
	label_cell($myrow["note"]);
	label_cell($myrow["is_active"]);
	edit_button_cell("Edit".$myrow["id"], _("Edit"));
	delete_button_cell("Delete".$myrow["id"], _("Delete"));
	end_row();
}
end_table(1);
//-----------------------------------------------------------------------------------
start_table(TABLESTYLE2);
if ($selected_id != "")
{
	if ($Mode == 'Edit')
	{
		$_POST = get_recuritment_job_category($selected_id);
		hidden('selected_id', $_POST['id']);
	}
	else
	{
		hidden('selected_id', $selected_id);
		hidden('old_id', $_POST["old_id"]);
	}
}

text_row_ex(_("Job Title Name:"), 'job_title_name', 30,100);
textarea_row(_("Job Description:"), 'job_description',null, 30,3);
text_row_ex(_("Category ID:"), 'job_category_id', 30,100);
textarea_row(_("Note:"), 'note',null,30,3);
text_row_ex(_("Is Active:"), 'is_active', 30,100);
yesno_list_row(_("Default"), 'is_active', null, "", "", false);
end_table(1);

submit_add_or_update_center($selected_id == "", '', 'both');

end_form();
//------------------------------------------------------------------------------------
end_page();
?>