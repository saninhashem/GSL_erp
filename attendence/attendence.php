<?php
/**********************************************************************
Copyright (C) Grameen Solutions Ltd.(www.grameensolutions.com)
***********************************************************************/

$page_security = 'HR_ATTENDANCE';
$path_to_root="..";
date_default_timezone_set('UTC');

//include($path_to_root . "/includes/db_pager.inc");
include_once($path_to_root . "/includes/session.inc");

include_once($path_to_root . "/includes/date_functions.inc");
include_once($path_to_root . "/includes/ui.inc");
include($path_to_root . "/attendence/includes/attendance_db.inc");
add_js_file('jquery-1.10.2.js');
add_js_file("protoplasm/protoplasm.js");
$js = "";
//print_r($_POST);exit;
//if ($use_popup_windows)
//	$js .= get_js_open_window(800, 500);
if ($use_date_picker)
    $js .= get_js_date_picker();

$js .= protoplasm_time();
add_js_file('attendance.js');
page(_($help_context = "Attendence"), false, false, "", $js);
simple_page_mode();
//-----------------------------------------------------------------------------------
// Ajax updates
//
//if (get_post('Search')){
//    $Ajax->activate('journal_tbl');
//}
//--------------------------------------------------------------------------------------
//if (!isset($_POST['filterType']))
//    $_POST['filterType'] = -1;

if(isset($_POST['save'])){
    $insertExploded = array();
    foreach ($_POST['emp_id'] as $id){
        $str = '(';
        $insertValues = array();
        db_query('delete from '.TB_PREF.'attendance_record where `employee_id` = "'.$id.'" and `punch_in_date` = "'.$_POST['punch_date'].'"');
        
        $insertValues[] = $id;
        $insertValues[] = '"'.$_POST['punch_date'].'"';
        $insertValues[] = '"'.$_POST['in_time_'.$id].'"';
        $insertValues[] = '"'.$_POST['punch_date'].'"';
        $insertValues[] = '"'.$_POST['out_time_'.$id].'"';
        $insertValues[] = '"'.$_POST['status_'.$id].'"';
        $insertValues[] = $_SESSION["wa_current_user"]->user;
        $insertValues[] = '"'.date('Y-m-d H:i:s', time()).'"';
        
        $str .= implode(',', $insertValues);
        $str .= ')';
        $insertExploded[] = $str;
    }
    $insertFinal = implode(',', $insertExploded);
    $query = 'insert into '.TB_PREF.'attendance_record (`employee_id`, `punch_in_date`, `punch_in_time`, `punch_out_date`, `punch_out_time`, `state`, `created_by`, `created_time`) values'.$insertFinal;
    db_query($query);
}

start_form();

start_table(TABLESTYLE_NOBORDER);
start_row();

date_cells(_("Date:"), 'ToDate');

submit_cells('submit', _("Submit"), '', '', 'default');
end_row();
start_row();
file_cells('File', 'file');
submit_cells('upload', _("Upload"), '', '', 'default');
end_row();
end_table();
end_form();


function view_inout($row, $attendanceTime){
    return getInOut($row, $attendanceTime);
}
function get_duration($row, $attendanceTime){
    return getDuration($row, $attendanceTime);
}
function get_status($row, $attendanceTime){
    return getStatus($row, $attendanceTime);
}

function convertDate($rawDate){
    $dateStr = date("Y-m-d", strtotime($rawDate));
    
    return $dateStr;
}


$result = get_employee_list();
$attendanceTime = get_attendance(convertDate(get_post('ToDate')));
//$file_info = get_file(get_post('file'));

$timeSheet = array();
while($data = db_fetch($attendanceTime)){
    $timeSheet[] = $data;
}

start_form();
start_table(TABLESTYLE, "width='80%'");

$th = array(_("Employee ID"), _("Employee Name"), _("Working Hours"), _("IN Out"), 
	_("Status"));

table_header($th);	

$k = 0;

while ($myrow = db_fetch($result)){	
    alt_table_row_color($k);

    label_cell($myrow["employee_id"], "nowrap");
    label_cell($myrow["name"], "nowrap");
    label_cell(get_duration($myrow['id'], $timeSheet), "nowrap");
    label_cell(view_inout($myrow["id"], $timeSheet), "nowrap");
    label_cell(get_status($myrow["id"], $timeSheet), "nowrap");
    hidden('emp_id[]', $myrow['id']);
    end_row(); 
}
hidden('punch_date', convertDate(get_post('ToDate')));
submit_center_first('save', 'Save');
end_table(1);
end_form();
end_page();
?>
