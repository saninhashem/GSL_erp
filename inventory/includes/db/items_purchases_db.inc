<?php
/**********************************************************************
    Copyright (C) Grameen Solutions Ltd.(www.grameensolutions.com)
***********************************************************************/

function add_item_purchasing_data($supplier_id, $stock_id, $price,
	$suppliers_uom, $conversion_factor, $supplier_description)
{
	$sql = "INSERT INTO ".TB_PREF."purch_data (supplier_id, stock_id, price, suppliers_uom,
		conversion_factor, supplier_description) VALUES (";
	$sql .= db_escape($supplier_id).", ".db_escape($stock_id). ", "
		.$price . ", ".db_escape($suppliers_uom ). ", "
		.$conversion_factor . ", "
		.db_escape($supplier_description) . ")";

	db_query($sql,"The supplier purchasing details could not be added");
}

function update_item_purchasing_data($selected_id, $stock_id, $price,
	$suppliers_uom, $conversion_factor, $supplier_description)
{
	$sql = "UPDATE ".TB_PREF."purch_data SET price=" . $price . ",
		suppliers_uom=".db_escape($suppliers_uom) . ",
		conversion_factor=" . $conversion_factor . ",
		supplier_description=" . db_escape($supplier_description) . "
		WHERE stock_id=".db_escape($stock_id) . " AND
		supplier_id=".db_escape($selected_id);
	db_query($sql,"The supplier purchasing details could not be updated");
}

function delete_item_purchasing_data($selected_id, $stock_id)
{
	$sql = "DELETE FROM ".TB_PREF."purch_data WHERE supplier_id=".db_escape($selected_id)."
		AND stock_id=".db_escape($stock_id);
	db_query($sql,"could not delete purchasing data");
}

function get_items_purchasing_data($stock_id)
{
    $sql = "SELECT ".TB_PREF."purch_data.*,".TB_PREF."suppliers.supp_name,"
    	.TB_PREF."suppliers.curr_code
		FROM ".TB_PREF."purch_data INNER JOIN ".TB_PREF."suppliers
		ON ".TB_PREF."purch_data.supplier_id=".TB_PREF."suppliers.supplier_id
		WHERE stock_id = ".db_escape($stock_id);

    return db_query($sql, "The supplier purchasing details for the selected part could not be retrieved");
}

function get_item_purchasing_data($selected_id, $stock_id)
{
	$sql = "SELECT ".TB_PREF."purch_data.*,".TB_PREF."suppliers.supp_name FROM ".TB_PREF."purch_data
		INNER JOIN ".TB_PREF."suppliers ON ".TB_PREF."purch_data.supplier_id=".TB_PREF."suppliers.supplier_id
		WHERE ".TB_PREF."purch_data.supplier_id=".db_escape($selected_id)."
		AND ".TB_PREF."purch_data.stock_id=".db_escape($stock_id);

	$result = db_query($sql, "The supplier purchasing details for the selected supplier and item could not be retrieved");

	return db_fetch($result);
}


?>