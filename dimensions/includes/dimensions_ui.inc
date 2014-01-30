<?php
/**********************************************************************
Copyright (C) Grameen Solutions Ltd.(www.grameensolutions.com)
***********************************************************************/
include_once($path_to_root . "/includes/ui.inc");

//--------------------------------------------------------------------------------------

function display_dimension_balance($id, $from, $to)
{
	global $path_to_root;

	$result = get_dimension_balance_all($id, $from, $to);

    if (db_num_rows($result) == 0)
    {
    	display_note(_("There are no transactions for this dimension for the selected period."));
    }
    else
    {
		display_heading2(_("Balance for this Dimension"));
		br();
		start_table(TABLESTYLE);
		$th = array(_("Account"), _("Debit"), _("Credit"));
		table_header($th);

        $total = $k = 0;
        while ($myrow = db_fetch($result))
        {
			alt_table_row_color($k);

			label_cell($myrow["account"]." ".$myrow['account_name']);
			display_debit_or_credit_cells($myrow["amt"]);
			$total += $myrow["amt"];
			end_row();
		}
		start_row();
		label_cell("<b>"._("Balance")."</b>");
		if ($total >= 0)
		{
			amount_cell($total, true);
			label_cell("");
		}
		else
		{
			label_cell("");
			amount_cell(abs($total), true);
		}
		end_row();

		end_table();
    }
}

//--------------------------------------------------------------------------------------

?>