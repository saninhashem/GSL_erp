<?php
/**********************************************************************
Copyright (C) Grameen Solutions Ltd.(www.grameensolutions.com)
***********************************************************************/
//--------------------------------------------------------------------------------------------------

function get_security_role($id)
{
	$sql = "SELECT * FROM ".TB_PREF."security_roles WHERE id=".(int)$id;
	$ret = db_query($sql, "could not retrieve security roles");
	$row = db_fetch($ret);
	if ($row != false) {
		$row['areas'] = explode(';', $row['areas']);
		$row['sections'] = explode(';', $row['sections']);
	}
	return $row;
}

//--------------------------------------------------------------------------------------------------

function add_security_role($name, $description, $sections, $areas)
{
	$sql = "INSERT INTO ".TB_PREF."security_roles (role, description, sections, areas)
	VALUES ("
	.db_escape($name).","
	.db_escape($description).","
	.db_escape(implode(';', $sections)).","
	.db_escape(implode(';', $areas)).")";

	db_query($sql, "could not add new security role");
}

//--------------------------------------------------------------------------------------------------

function update_security_role($id, $name, $description, $sections, $areas)
{
    	$sql = "UPDATE ".TB_PREF."security_roles SET role=".db_escape($name)
    	.",description=".db_escape($description)
    	.",sections=".db_escape(implode(';', $sections))
    	.",areas=".db_escape(implode(';', $areas))
    	." WHERE id=".(int)$id;
    	db_query($sql, "could not update role");
}
//--------------------------------------------------------------------------------------------------

function delete_security_role($id)
{
	$sql = "DELETE FROM ".TB_PREF."security_roles WHERE id=".(int)$id;

	db_query($sql, "could not delete role");
}
//--------------------------------------------------------------------------------------------------

function check_role_used($id) {
	$sql = "SELECT count(*) FROM ".TB_PREF."users WHERE role_id=".(int)$id;
	$ret = db_query($sql, 'cannot check role usage');
	$row = db_fetch($ret);
	return $row[0];
}
?>