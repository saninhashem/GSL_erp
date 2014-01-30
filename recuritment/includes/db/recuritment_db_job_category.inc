<?php
/**********************************************************************
Copyright (C) Grameen Solutions Ltd.(www.grameensolutions.com)
***********************************************************************/

function add_recuritment_job_category($dataArr)
{
	$sql = "INSERT INTO ".TB_PREF."job_category (job_category_name)
		VALUES (".db_escape($dataArr['job_category_name']).")";
	return db_query($sql);
}

function update_recuritment_job_category($dataArr,$id)
{
	begin_transaction();


	$sql = "UPDATE ".TB_PREF."job_category SET job_category_name=".db_escape($dataArr['job_category_name'])
	." WHERE id = ".db_escape($id);
	$ret = db_query($sql, "could not update job category");
	commit_transaction();
	return $ret;
}

function get_recuritment_job_categorys()
{
	$sql = "SELECT * FROM ".TB_PREF."job_category";
	$sql .= " ORDER BY job_category_name ASC";

	return db_query($sql, "could not get job category");
}

function get_recuritment_job_category($id)
{
	$sql = "SELECT * FROM ".TB_PREF."job_category WHERE id = ".db_escape($id);
	$result = db_query($sql, "could not get job category");
	return db_fetch($result);
}

function delete_recuritment_job_category($id)
{
	$sql = "DELETE FROM ".TB_PREF."job_category WHERE id = ".db_escape($id);

	db_query($sql, "could not get job category");
}
?>