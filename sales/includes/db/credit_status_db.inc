<?php
/**********************************************************************
Copyright (C) Grameen Solutions Ltd.(www.grameensolutions.com)
***********************************************************************/
function add_credit_status($description, $disallow_invoicing)
{
	$sql = "INSERT INTO ".TB_PREF."credit_status (reason_description, dissallow_invoices) 
		VALUES (".db_escape($description).",".db_escape($disallow_invoicing).")";
		
	db_query($sql, "could not add credit status");		
}

function update_credit_status($status_id, $description, $disallow_invoicing)
{
	$sql = "UPDATE ".TB_PREF."credit_status SET reason_description=".db_escape($description).",
		dissallow_invoices=".db_escape($disallow_invoicing)." WHERE id=".db_escape($status_id);
	
	db_query($sql, "could not update credit status");			
}

function get_all_credit_status($all=false)
{
	$sql = "SELECT * FROM ".TB_PREF."credit_status";
	if (!$all) $sql .= " WHERE !inactive";

	return db_query($sql, "could not get all credit status");
} 

function get_credit_status($status_id)
{
	$sql = "SELECT * FROM ".TB_PREF."credit_status WHERE id=".db_escape($status_id);
	
	$result = db_query($sql, "could not get credit status");
	
	return db_fetch($result);
}

function delete_credit_status($status_id)
{
	$sql="DELETE FROM ".TB_PREF."credit_status WHERE id=".db_escape($status_id);
		
	db_query($sql, "could not delete credit status");	
}

?>