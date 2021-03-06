<?php
/**********************************************************************
Copyright (C) Grameen Solutions Ltd.(www.grameensolutions.com)
***********************************************************************/
/*
	Update main or gl company setup.
*/
function update_company_prefs( $params, $pref = TB_PREF )
{
	$sql = "UPDATE {$pref}sys_prefs SET value = ";
	foreach($params as $name => $value) {
		if (!db_query($sql. db_escape($value). " WHERE name=".db_escape($name),
			 "The company prefferences could not be updated "))
			return false;
		// update cached value
		$_SESSION['SysPrefs']->prefs[$name] = $value;
	}
	return true;
}
/*
	Get company preferences. Returns cached values from global variable SysPrefs
	or retrieved from database if SysPrefs values are not set.
	$prefs can be preference name, array of names, or null for all preferences.
	
*/
function get_company_pref($prefs = null, $tbpref = null)
{
	global $SysPrefs, $db_version;
	
	static $cached; // retrieve values from db once a request. Some values can't be cached between requests
					// to ensure prefs integrity for all usrs (e.g. gl_close_date).
	
 	if (!$cached || !isset($_SESSION['SysPrefs'])) { // cached preferences

		$_SESSION['SysPrefs'] = new sys_prefs();

		if (!isset($tbpref))
			$tbpref = TB_PREF;

		$sql = "SELECT name, value FROM {$tbpref}sys_prefs";
		$result = @db_query($sql); // supress errors before 2.3 db structure upgrade

		if(!$result)
			return null;

		while($pref = db_fetch_assoc($result)) {
			$_SESSION['SysPrefs']->prefs[$pref['name']] = $pref['value'];
		}

		$SysPrefs = &$_SESSION['SysPrefs'];

		// update current db status for info in log file
		$SysPrefs->db_ok = $SysPrefs->prefs['version_id'] == $db_version;
		$cached = true;
	}

	$all = $_SESSION['SysPrefs']->prefs;

	if (!$prefs)
		return $all;
	elseif (is_string($prefs))
		return @$all[$prefs];

	$ret = array();
	foreach($prefs as $name)
		$ret[$name] = $all[$name];

		return $ret;
}

function get_company_prefs($tbpref = TB_PREF)
{
	return get_company_pref(null, $tbpref);
}

function set_company_pref($pref, $category, $type, $length, $value)
{
	$sql = "REPLACE ".TB_PREF."sys_prefs SET name=".db_escape($pref).", category=".db_escape($category)
		.", type=".db_escape($type).", length=".db_escape($length).", value=".db_escape($value);
	return db_query($sql, "cannot set company pref");
}

function refresh_sys_prefs()
{
	flush_dir(company_path().'/js_cache'); // clear cache
	unset($_SESSION['SysPrefs']);
	get_company_prefs();
}

function get_base_sales_type()
{
	return get_company_pref('base_sales');
}

function get_company_extensions($id = -1) {
	global $path_to_root;

	$file = $path_to_root.($id == -1 ? '' : '/company/'.(int)$id).'/installed_extensions.php';
	$installed_extensions = array();
	if (is_file($file)) {
		include($file);
	}
	return $installed_extensions;
}

function add_payment_terms($daysOrFoll, $terms, $dayNumber)
{
	if ($daysOrFoll) 
	{
		$sql = "INSERT INTO ".TB_PREF."payment_terms (terms,
			days_before_due, day_in_following_month)
			VALUES (" .
			db_escape($terms) . ", " . db_escape($dayNumber) . ", 0)";
	} 
	else 
	{
		$sql = "INSERT INTO ".TB_PREF."payment_terms (terms,
			days_before_due, day_in_following_month)
			VALUES (" . db_escape($terms) . ",
			0, " . db_escape($dayNumber) . ")";
	}
   	db_query($sql,"The payment term could not be added");
}

function update_payment_terms($selected_id, $daysOrFoll, $terms, $dayNumber)
{
	if ($daysOrFoll) 
	{
		$sql = "UPDATE ".TB_PREF."payment_terms SET terms=" . db_escape($terms) . ",
			day_in_following_month=0,
			days_before_due=" . db_escape($dayNumber) . "
			WHERE terms_indicator = " .db_escape($selected_id);
	} 
	else 
	{
		$sql = "UPDATE ".TB_PREF."payment_terms SET terms=" . db_escape($terms) . ",
			day_in_following_month=" . db_escape($dayNumber) . ",
			days_before_due=0
			WHERE terms_indicator = " .db_escape($selected_id);
	}
   	db_query($sql,"The payment term could not be updated");
}

function delete_payment_terms($selected_id)
{
	$sql="DELETE FROM ".TB_PREF."payment_terms WHERE terms_indicator=".db_escape($selected_id);
	db_query($sql,"could not delete a payment terms");
}

function get_payment_terms($selected_id)
{
	$sql = "SELECT *, (t.days_before_due=0) AND (t.day_in_following_month=0) as cash_sale
	 FROM ".TB_PREF."payment_terms t WHERE terms_indicator=".db_escape($selected_id);

	$result = db_query($sql,"could not get payment term");

	return db_fetch($result);
}

function get_payment_terms_all($show_inactive)
{
	$sql = "SELECT * FROM ".TB_PREF."payment_terms";
	if (!$show_inactive) $sql .= " WHERE !inactive";
	return db_query($sql,"could not get payment terms");
}
/*
	Return number of records in tables, where some foreign key $id is used.
	$id - searched key value
	$tables - array of table names (without prefix); when table name is used as a key, then
		value is name of foreign key field. For numeric keys $stdkey field name is used.
	$stdkey - standard name of foreign key.
*/
function key_in_foreign_table($id, $tables, $stdkey)
{

	if (!is_array($tables))
		$tables = array($tables);

	$sqls = array();
	foreach ($tables as $tbl => $key) {
		if (is_numeric($tbl)) {
			$tbl = $key;
			$key = $stdkey;
		}
		$sqls[] = "(SELECT COUNT(*) as cnt FROM `".TB_PREF."$tbl` WHERE `$key`=".db_escape($id).")\n";
	}

	$sql = "SELECT sum(cnt) FROM (". implode(' UNION ', $sqls).") as counts";

	$result = db_query($sql, "check relations for ".implode(',',$tables)." failed");
	$count =  db_fetch($result);

	return $count[0];
}

?>