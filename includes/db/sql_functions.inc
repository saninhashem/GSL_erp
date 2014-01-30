<?php
/**********************************************************************
Copyright (C) Grameen Solutions Ltd.(www.grameensolutions.com)
***********************************************************************/
//
//	General database functions common for all modules.
//
//-------------------------------------------------------------------
// Multilevel transaction control.
//

function begin_transaction()
{
	global $transaction_level; // set in set_global_connection()

	if (!$transaction_level) {
		db_query("BEGIN", "could not start a transaction");
	}
	$transaction_level++;
}

function commit_transaction()
{
	global $transaction_level;

	$transaction_level--;

	if (!$transaction_level) {
		db_query("COMMIT", "could not commit a transaction");
	}
}

/*
	This function is called on end of script execution to cancel
	all aborted transactions (if any)
*/
function cancel_transaction()
{
	global $transaction_level;

	if ($transaction_level) {
		db_query("ROLLBACK", "could not cancel a transaction");	
	}
}

//-----------------------------------------------------------------------------
//	Update record activity status.
//
function update_record_status($id, $status, $table, $key) {
	$sql = "UPDATE ".TB_PREF.$table." SET inactive = "
		. ((int)$status)." WHERE $key=".db_escape($id);
		
  	db_query($sql, "Can't update record status");
}
?>
