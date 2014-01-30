<?php
function get_attendance($search_time){
    $sql = 'select * from '.TB_PREF.'attendance_record where punch_in_date = "'.$search_time.'" and punch_out_date = "'.$search_time.'"';
    $result = db_query($sql, "The Record could not found of this date");
    //$dataSet = db_fetch($result);
    return $result;
}
function get_employee_list(){
     $sql = "select
                   id,
                   employee_id, 
                   concat(emp_firstname,' ',emp_lastname) as name
           from 
                   ".TB_PREF."employee 
           order by
                   emp_firstname";

    $result = db_query($sql, "The Employee table empty.");
    //$dataSet = db_fetch($result);
    return $result;
}
?>