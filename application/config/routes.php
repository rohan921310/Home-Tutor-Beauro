<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'Login';
$route['admin_login'] = 'Login/admin_login';
$route['admin_login_check'] = 'Login/admin_login_check';
$route['admin_logout'] = 'Login/admin_logout';


//....admin...///
$route['admin-dashboard'] = 'Admin/dashboard';

//....admin subjects...///
$route['admin/view_subjects'] = 'Admin/view_subjects';
$route['admin/add_subject'] = 'Admin/add_subject';
$route['admin/delete_subject'] = 'Admin/delete_subject';



//....admin add teacher...///
$route['admin_add_teacher'] = 'Admin/admin_add_teacher';
$route['register_teacher'] = 'Admin/register_teacher';
$route['admin_view_teacher'] = 'Admin/admin_view_teacher';
$route['admin/change_teacher_status/(:any)/(:any)'] = 'Admin/change_teacher_status/$1/$2';

//....admin students...///
$route['admin/view_students'] = 'Admin/view_students';
$route['admin/fetch_subjects'] = 'Admin/fetch_subjects';
$route['admin/fetch_teacher'] = 'Admin/fetch_teacher';
$route['admin/add_student'] = 'Admin/add_student';
$route['admin/delete_student_subject'] = 'Admin/delete_student_subject';
$route['admin/change_student_subject_status'] = 'Admin/change_student_subject_status';
$route['admin/get_student_table_one'] = 'Admin/get_student_table_one';
$route['admin/apply_student_filters'] = 'Admin/apply_student_filters';



//....admin Student Fees...///
$route['admin/student_fees'] = 'Admin/student_fees';
$route['admin/teacher_salary'] = 'Admin/teacher_salary';
$route['admin/fetch_student_status_one'] = 'Admin/fetch_student_status_one';
$route['admin/add_student_payment'] = 'Admin/add_student_payment';
$route['admin/fetch_student_last_description'] = 'Admin/fetch_student_last_description';
$route['admin/get_fee_details'] = 'Admin/get_fee_details';
$route['admin/filter_student_fee'] = 'Admin/filter_student_fee';
$route['admin/change_student_fee_status'] = 'Admin/change_student_fee_status';
$route['admin/delete_student_fee'] = 'Admin/delete_student_fee';




//....admin Teacher Fees...///
$route['admin/teacher_salary'] = 'Admin/teacher_salary';
$route['admin/view_teacher_salary'] = 'Admin/view_teacher_salary';



///......Whatsappp......///
$route['whatsapp'] = 'Whatsapp';



///......Cron Job......///
$route['late_fee'] = 'Cron/late_fee';
$route['send_message'] = 'Cron/send_message';



$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
