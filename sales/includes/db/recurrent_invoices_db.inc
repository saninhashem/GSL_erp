<?php
/**********************************************************************
Copyright (C) Grameen Solutions Ltd.(www.grameensolutions.com)
***********************************************************************/

function add_recurrent_invoice($description, $order_no, $debtor_no, $group_no, $days, $monthly,
	$begin, $end)
{
	$sql = "INSERT INTO ".TB_PREF."recurrent_invoices (description, order_no, debtor_no,
		group_no, days, monthly, begin, end, last_sent) VALUES (".db_escape($description) . ", "
		.db_escape($order_no).", ".db_escape($debtor_no).", "
		.db_escape($group_no).", ".$days.", ".$monthly.", '"
		.date2sql($begin)."', '".date2sql($end)."', '0000-00-00')";
   	db_query($sql,"The recurrent invoice could not be added");
}

function update_recurrent_invoice($selected_id, $description, $order_no, $debtor_no, $group_no, $days, $monthly,
	$begin, $end)
{
	$sql = "UPDATE ".TB_PREF."recurrent_invoices SET 
		description=".db_escape($description).", 
		order_no=".db_escape($order_no).", 
		debtor_no=".db_escape($debtor_no).", 
		group_no=".db_escape($group_no).", 
		days=".$days.", 
		monthly=".$monthly.", 
		begin='".date2sql($begin)."', 
		end='".date2sql($end)."' 
		WHERE id = ".db_escape($selected_id);
   	db_query($sql,"The recurrent invoice could not be updated");
}

function update_last_sent_recurrent_invoice($id, $date)
{
	$date = date2sql($date);
	$sql = "UPDATE ".TB_PREF."recurrent_invoices SET last_sent='$date' WHERE id=".db_escape($id);
   	db_query($sql,"The recurrent invoice could not be updated");
}

function delete_recurrent_invoice($selected_id)
{
	$sql="DELETE FROM ".TB_PREF."recurrent_invoices WHERE id=".db_escape($selected_id);
	db_query($sql,"could not delete recurrent invoice");
}

function get_recurrent_invoices()
{
	$sql = "SELECT * FROM ".TB_PREF."recurrent_invoices ORDER BY description, group_no, debtor_no";
	return db_query($sql,"could not get recurrent invoices");
}

function get_recurrent_invoice($selected_id)
{
	$sql = "SELECT * FROM ".TB_PREF."recurrent_invoices WHERE id=".db_escape($selected_id);

	$result = db_query($sql,"could not get recurrent invoice");
	return db_fetch($result);
}
?>