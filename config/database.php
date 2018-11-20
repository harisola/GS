<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
| This file will contain the settings needed to access your database.
|
| For complete instructions please consult the 'Database Connection'
| page of the User Guide.
|
| -------------------------------------------------------------------
| EXPLANATION OF VARIABLES
| -------------------------------------------------------------------
|
|	['hostname'] The hostname of your database server.
|	['username'] The username used to connect to the database
|	['password'] The password used to connect to the database
|	['database'] The name of the database you want to connect to
|	['dbdriver'] The database type. ie: mysql.  Currently supported:
				 mysql, mysqli, postgre, odbc, mssql, sqlite, oci8
|	['dbprefix'] You can add an optional prefix, which will be added
|				 to the table name when using the  Active Record class
|	['pconnect'] TRUE/FALSE - Whether to use a persistent connection
|	['db_debug'] TRUE/FALSE - Whether database errors should be displayed.
|	['cache_on'] TRUE/FALSE - Enables/disables query caching
|	['cachedir'] The path to the folder where cache files should be stored
|	['char_set'] The character set used in communicating with the database
|	['dbcollat'] The character collation used in communicating with the database
|				 NOTE: For MySQL and MySQLi databases, this setting is only used
| 				 as a backup if your server is running PHP < 5.2.3 or MySQL < 5.0.7
|				 (and in table creation queries made with DB Forge).
| 				 There is an incompatibility in PHP with mysql_real_escape_string() which
| 				 can make your site vulnerable to SQL injection if you are using a
| 				 multi-byte character set and are running versions lower than these.
| 				 Sites using Latin-1 or UTF-8 database character set and collation are unaffected.
|	['swap_pre'] A default table prefix that should be swapped with the dbprefix
|	['autoinit'] Whether or not to automatically initialize the database.
|	['stricton'] TRUE/FALSE - forces 'Strict Mode' connections
|							- good for ensuring strict SQL while developing
|
| The $active_group variable lets you choose which connection group to
| make active.  By default there is only one group (the 'default' group).
|
| The $active_record variables lets you determine whether or not to load
| the active record class
*/

$active_group = 'default';
$active_record = TRUE;

$db['default']['hostname'] = 'localhost';
$db['default']['username'] = 'root';
$db['default']['password'] = 'nasa';
$db['default']['database'] = 'atif';
$db['default']['dbdriver'] = 'mysql';
$db['default']['dbprefix'] = '';
$db['default']['pconnect'] = TRUE;
$db['default']['db_debug'] = TRUE;
$db['default']['cache_on'] = FALSE;
$db['default']['cachedir'] = '';
$db['default']['char_set'] = 'utf8';
$db['default']['dbcollat'] = 'utf8_general_ci';
$db['default']['swap_pre'] = '';
$db['default']['autoinit'] = TRUE;
$db['default']['stricton'] = FALSE;

$db['career']['hostname'] = 'localhost';
$db['career']['username'] = 'root';
$db['career']['password'] = 'nasa';
$db['career']['database'] = 'atif_career';
$db['career']['dbdriver'] = 'mysql';
$db['career']['dbprefix'] = '';
$db['career']['pconnect'] = TRUE;
$db['career']['db_debug'] = TRUE;
$db['career']['cache_on'] = FALSE;
$db['career']['cachedir'] = '';
$db['career']['char_set'] = 'utf8';
$db['career']['dbcollat'] = 'utf8_general_ci';
$db['career']['swap_pre'] = '';
$db['career']['autoinit'] = TRUE;
$db['career']['stricton'] = FALSE;

$db['attendance_students']['hostname'] = 'localhost';
$db['attendance_students']['username'] = 'root';
$db['attendance_students']['password'] = 'nasa';
$db['attendance_students']['database'] = 'atif_attendance';
$db['attendance_students']['dbdriver'] = 'mysql';
$db['attendance_students']['dbprefix'] = '';
$db['attendance_students']['pconnect'] = TRUE;
$db['attendance_students']['db_debug'] = TRUE;
$db['attendance_students']['cache_on'] = FALSE;
$db['attendance_students']['cachedir'] = '';
$db['attendance_students']['char_set'] = 'utf8';
$db['attendance_students']['dbcollat'] = 'utf8_general_ci';
$db['attendance_students']['swap_pre'] = '';
$db['attendance_students']['autoinit'] = TRUE;
$db['attendance_students']['stricton'] = FALSE;


$db['attendance_students2']['hostname'] = 'localhost';
$db['attendance_students2']['username'] = 'root';
$db['attendance_students2']['password'] = 'nasa';
$db['attendance_students2']['database'] = 'atif_attendance';
$db['attendance_students2']['dbdriver'] = 'mysqli';
$db['attendance_students2']['dbprefix'] = '';
$db['attendance_students2']['pconnect'] = TRUE;
$db['attendance_students2']['db_debug'] = TRUE;
$db['attendance_students2']['cache_on'] = FALSE;
$db['attendance_students2']['cachedir'] = '';
$db['attendance_students2']['char_set'] = 'utf8';
$db['attendance_students2']['dbcollat'] = 'utf8_general_ci';
$db['attendance_students2']['swap_pre'] = '';
$db['attendance_students2']['autoinit'] = TRUE;
$db['attendance_students2']['stricton'] = FALSE;


$db['attendance_staff']['hostname'] = 'localhost';
$db['attendance_staff']['username'] = 'root';
$db['attendance_staff']['password'] = 'nasa';
$db['attendance_staff']['database'] = 'atif_attendance_staff';
$db['attendance_staff']['dbdriver'] = 'mysql';
$db['attendance_staff']['dbprefix'] = '';
$db['attendance_staff']['pconnect'] = TRUE;
$db['attendance_staff']['db_debug'] = TRUE;
$db['attendance_staff']['cache_on'] = FALSE;
$db['attendance_staff']['cachedir'] = '';
$db['attendance_staff']['char_set'] = 'utf8';
$db['attendance_staff']['dbcollat'] = 'utf8_general_ci';
$db['attendance_staff']['swap_pre'] = '';
$db['attendance_staff']['autoinit'] = TRUE;
$db['attendance_staff']['stricton'] = FALSE;

$db['attendance_vehicle']['hostname'] = 'localhost';
$db['attendance_vehicle']['username'] = 'root';
$db['attendance_vehicle']['password'] = 'nasa';
$db['attendance_vehicle']['database'] = 'atif_attendance_vehicle';
$db['attendance_vehicle']['dbdriver'] = 'mysql';
$db['attendance_vehicle']['dbprefix'] = '';
$db['attendance_vehicle']['pconnect'] = TRUE;
$db['attendance_vehicle']['db_debug'] = TRUE;
$db['attendance_vehicle']['cache_on'] = FALSE;
$db['attendance_vehicle']['cachedir'] = '';
$db['attendance_vehicle']['char_set'] = 'utf8';
$db['attendance_vehicle']['dbcollat'] = 'utf8_general_ci';
$db['attendance_vehicle']['swap_pre'] = '';
$db['attendance_vehicle']['autoinit'] = TRUE;
$db['attendance_vehicle']['stricton'] = FALSE;

$db['sms']['hostname'] = 'localhost';
$db['sms']['username'] = 'root';
$db['sms']['password'] = 'nasa';
$db['sms']['database'] = 'atif_sms';
$db['sms']['dbdriver'] = 'mysql';
$db['sms']['dbprefix'] = '';
$db['sms']['pconnect'] = TRUE;
$db['sms']['db_debug'] = TRUE;
$db['sms']['cache_on'] = FALSE;
$db['sms']['cachedir'] = '';
$db['sms']['char_set'] = 'utf8';
$db['sms']['dbcollat'] = 'utf8_general_ci';
$db['sms']['swap_pre'] = '';
$db['sms']['autoinit'] = TRUE;
$db['sms']['stricton'] = FALSE;


$db['visitors']['hostname'] = 'localhost';
$db['visitors']['username'] = 'root';
$db['visitors']['password'] = 'nasa';
$db['visitors']['database'] = 'atif_visitors';
$db['visitors']['dbdriver'] = 'mysql';
$db['visitors']['dbprefix'] = '';
$db['visitors']['pconnect'] = TRUE;
$db['visitors']['db_debug'] = TRUE;
$db['visitors']['cache_on'] = FALSE;
$db['visitors']['cachedir'] = '';
$db['visitors']['char_set'] = 'utf8';
$db['visitors']['dbcollat'] = 'utf8_general_ci';
$db['visitors']['swap_pre'] = '';
$db['visitors']['autoinit'] = TRUE;
$db['visitors']['stricton'] = FALSE;


$db['role']['hostname'] = 'localhost';
$db['role']['username'] = 'root';
$db['role']['password'] = 'nasa';
$db['role']['database'] = 'atif_role';
$db['role']['dbdriver'] = 'mysql';
$db['role']['dbprefix'] = '';
$db['role']['pconnect'] = TRUE;
$db['role']['db_debug'] = TRUE;
$db['role']['cache_on'] = FALSE;
$db['role']['cachedir'] = '';
$db['role']['char_set'] = 'utf8';
$db['role']['dbcollat'] = 'utf8_general_ci';
$db['role']['swap_pre'] = '';
$db['role']['autoinit'] = TRUE;
$db['role']['stricton'] = FALSE;

$db['assessment']['hostname'] = 'localhost';
$db['assessment']['username'] = 'root';
$db['assessment']['password'] = 'nasa';
$db['assessment']['database'] = 'atif_assessment';
$db['assessment']['dbdriver'] = 'mysql';
$db['assessment']['dbprefix'] = '';
$db['assessment']['pconnect'] = TRUE;
$db['assessment']['db_debug'] = TRUE;
$db['assessment']['cache_on'] = FALSE;
$db['assessment']['cachedir'] = '';
$db['assessment']['char_set'] = 'utf8';
$db['assessment']['dbcollat'] = 'utf8_general_ci';
$db['assessment']['swap_pre'] = '';
$db['assessment']['autoinit'] = TRUE;
$db['assessment']['stricton'] = FALSE;

$db['atif_assessment']['hostname'] = 'localhost';
$db['atif_assessment']['username'] = 'root';
$db['atif_assessment']['password'] = 'nasa';
$db['atif_assessment']['database'] = 'atif_assessment';
$db['atif_assessment']['dbdriver'] = 'mysql';
$db['atif_assessment']['dbprefix'] = '';
$db['atif_assessment']['pconnect'] = TRUE;
$db['atif_assessment']['db_debug'] = TRUE;
$db['atif_assessment']['cache_on'] = FALSE;
$db['atif_assessment']['cachedir'] = '';
$db['atif_assessment']['char_set'] = 'utf8';
$db['atif_assessment']['dbcollat'] = 'utf8_general_ci';
$db['atif_assessment']['swap_pre'] = '';
$db['atif_assessment']['autoinit'] = TRUE;
$db['atif_assessment']['stricton'] = FALSE;


$db['fee_bill_db']['hostname'] = 'localhost';
$db['fee_bill_db']['username'] = 'root';
$db['fee_bill_db']['password'] = 'nasa';
$db['fee_bill_db']['database'] = 'atif_fee';
$db['fee_bill_db']['dbdriver'] = 'mysql';
$db['fee_bill_db']['dbprefix'] = '';
$db['fee_bill_db']['pconnect'] = TRUE;
$db['fee_bill_db']['db_debug'] = TRUE;
$db['fee_bill_db']['cache_on'] = FALSE;
$db['fee_bill_db']['cachedir'] = '';
$db['fee_bill_db']['char_set'] = 'utf8';
$db['fee_bill_db']['dbcollat'] = 'utf8_general_ci';
$db['fee_bill_db']['swap_pre'] = '';
$db['fee_bill_db']['autoinit'] = TRUE;
$db['fee_bill_db']['stricton'] = FALSE;


$db['process']['hostname'] = 'localhost';
$db['process']['username'] = 'root';
$db['process']['password'] = 'nasa';
$db['process']['database'] = 'atif_process';
$db['process']['dbdriver'] = 'mysql';
$db['process']['dbprefix'] = '';
$db['process']['pconnect'] = TRUE;
$db['process']['db_debug'] = TRUE;
$db['process']['cache_on'] = FALSE;
$db['process']['cachedir'] = '';
$db['process']['char_set'] = 'utf8';
$db['process']['dbcollat'] = 'utf8_general_ci';
$db['process']['swap_pre'] = '';
$db['process']['autoinit'] = TRUE;
$db['process']['stricton'] = FALSE;



$db['subject']['hostname'] = 'localhost';
$db['subject']['username'] = 'root';
$db['subject']['password'] = 'nasa';
$db['subject']['database'] = 'atif_subject';
$db['subject']['dbdriver'] = 'mysql';
$db['subject']['dbprefix'] = '';
$db['subject']['pconnect'] = TRUE;
$db['subject']['db_debug'] = TRUE;
$db['subject']['cache_on'] = FALSE;
$db['subject']['cachedir'] = '';
$db['subject']['char_set'] = 'utf8';
$db['subject']['dbcollat'] = 'utf8_general_ci';
$db['subject']['swap_pre'] = '';
$db['subject']['autoinit'] = TRUE;
$db['subject']['stricton'] = FALSE;


$db['role_org']['hostname'] = 'localhost';
$db['role_org']['username'] = 'root';
$db['role_org']['password'] = 'nasa';
$db['role_org']['database'] = 'atif_role_org';
$db['role_org']['dbdriver'] = 'mysql';
$db['role_org']['dbprefix'] = '';
$db['role_org']['pconnect'] = TRUE;
$db['role_org']['db_debug'] = TRUE;
$db['role_org']['cache_on'] = FALSE;
$db['role_org']['cachedir'] = '';
$db['role_org']['char_set'] = 'utf8';
$db['role_org']['dbcollat'] = 'utf8_general_ci';
$db['role_org']['swap_pre'] = '';
$db['role_org']['autoinit'] = TRUE;
$db['role_org']['stricton'] = FALSE;


$db['role_matrix']['hostname'] = 'localhost';
$db['role_matrix']['username'] = 'root';
$db['role_matrix']['password'] = 'nasa';
$db['role_matrix']['database'] = 'atif_role_matrix';
$db['role_matrix']['dbdriver'] = 'mysql';
$db['role_matrix']['dbprefix'] = '';
$db['role_matrix']['pconnect'] = TRUE;
$db['role_matrix']['db_debug'] = TRUE;
$db['role_matrix']['cache_on'] = FALSE;
$db['role_matrix']['cachedir'] = '';
$db['role_matrix']['char_set'] = 'utf8';
$db['role_matrix']['dbcollat'] = 'utf8_general_ci';
$db['role_matrix']['swap_pre'] = '';
$db['role_matrix']['autoinit'] = TRUE;
$db['role_matrix']['stricton'] = FALSE;

$db['process']['hostname'] = 'localhost';
$db['process']['username'] = 'root';
$db['process']['password'] = 'nasa';
$db['process']['database'] = 'atif_process';
$db['process']['dbdriver'] = 'mysql';
$db['process']['dbprefix'] = '';
$db['process']['pconnect'] = TRUE;
$db['process']['db_debug'] = TRUE;
$db['process']['cache_on'] = FALSE;
$db['process']['cachedir'] = '';
$db['process']['char_set'] = 'utf8';
$db['process']['dbcollat'] = 'utf8_general_ci';
$db['process']['swap_pre'] = '';
$db['process']['autoinit'] = TRUE;
$db['process']['stricton'] = FALSE;

$db['subject_grade']['hostname'] = 'localhost';
$db['subject_grade']['username'] = 'root';
$db['subject_grade']['password'] = 'nasa';
$db['subject_grade']['database'] = 'atif_subject_grade';
$db['subject_grade']['dbdriver'] = 'mysql';
$db['subject_grade']['dbprefix'] = '';
$db['subject_grade']['pconnect'] = TRUE;
$db['subject_grade']['db_debug'] = TRUE;
$db['subject_grade']['cache_on'] = FALSE;
$db['subject_grade']['cachedir'] = '';
$db['subject_grade']['char_set'] = 'utf8';
$db['subject_grade']['dbcollat'] = 'utf8_general_ci';
$db['subject_grade']['swap_pre'] = '';
$db['subject_grade']['autoinit'] = TRUE;
$db['subject_grade']['stricton'] = FALSE;



$db['subject_marks']['hostname'] = 'localhost';
$db['subject_marks']['username'] = 'root';
$db['subject_marks']['password'] = 'nasa';
$db['subject_marks']['database'] = 'atif_subject_marks';
$db['subject_marks']['dbdriver'] = 'mysql';
$db['subject_marks']['dbprefix'] = '';
$db['subject_marks']['pconnect'] = TRUE;
$db['subject_marks']['db_debug'] = TRUE;
$db['subject_marks']['cache_on'] = FALSE;
$db['subject_marks']['cachedir'] = '';
$db['subject_marks']['char_set'] = 'utf8';
$db['subject_marks']['dbcollat'] = 'utf8_general_ci';
$db['subject_marks']['swap_pre'] = '';
$db['subject_marks']['autoinit'] = TRUE;
$db['subject_marks']['stricton'] = FALSE;



$db['student_log']['hostname'] = 'localhost';
$db['student_log']['username'] = 'root';
$db['student_log']['password'] = 'nasa';
$db['student_log']['database'] = 'atif_student_log';
$db['student_log']['dbdriver'] = 'mysql';
$db['student_log']['dbprefix'] = '';
$db['student_log']['pconnect'] = TRUE;
$db['student_log']['db_debug'] = TRUE;
$db['student_log']['cache_on'] = FALSE;
$db['student_log']['cachedir'] = '';
$db['student_log']['char_set'] = 'utf8';
$db['student_log']['dbcollat'] = 'utf8_general_ci';
$db['student_log']['swap_pre'] = '';
$db['student_log']['autoinit'] = TRUE;
$db['student_log']['stricton'] = FALSE;



$db['fee_bill_student_db']['hostname'] = 'localhost';
$db['fee_bill_student_db']['username'] = 'root';
$db['fee_bill_student_db']['password'] = 'nasa';
$db['fee_bill_student_db']['database'] = 'atif_fee_student';
$db['fee_bill_student_db']['dbdriver'] = 'mysqli';
$db['fee_bill_student_db']['dbprefix'] = '';
$db['fee_bill_student_db']['pconnect'] = TRUE;
$db['fee_bill_student_db']['db_debug'] = TRUE;
$db['fee_bill_student_db']['cache_on'] = FALSE;
$db['fee_bill_student_db']['cachedir'] = '';
$db['fee_bill_student_db']['char_set'] = 'utf8';
$db['fee_bill_student_db']['dbcollat'] = 'utf8_general_ci';
$db['fee_bill_student_db']['swap_pre'] = '';
$db['fee_bill_student_db']['autoinit'] = TRUE;
$db['fee_bill_student_db']['stricton'] = FALSE;



$db['atif_sp']['hostname'] = 'localhost';
$db['atif_sp']['username'] = 'root';
$db['atif_sp']['password'] = 'nasa';
$db['atif_sp']['database'] = 'atif_sp';
$db['atif_sp']['dbdriver'] = 'mysqli';
$db['atif_sp']['dbprefix'] = '';
$db['atif_sp']['pconnect'] = TRUE;
$db['atif_sp']['db_debug'] = TRUE;
$db['atif_sp']['cache_on'] = FALSE;
$db['atif_sp']['cachedir'] = '';
$db['atif_sp']['char_set'] = 'utf8';
$db['atif_sp']['dbcollat'] = 'utf8_general_ci';
$db['atif_sp']['swap_pre'] = '';
$db['atif_sp']['autoinit'] = TRUE;
$db['atif_sp']['stricton'] = FALSE;




$db['db_studentAdmission']['hostname'] = 'localhost';
$db['db_studentAdmission']['username'] = 'root';
$db['db_studentAdmission']['password'] = 'nasa';
$db['db_studentAdmission']['database'] = 'atif_gs_admission';
$db['db_studentAdmission']['dbdriver'] = 'mysqli';
$db['db_studentAdmission']['dbprefix'] = '';
$db['db_studentAdmission']['pconnect'] = TRUE;
$db['db_studentAdmission']['db_debug'] = TRUE;
$db['db_studentAdmission']['cache_on'] = FALSE;
$db['db_studentAdmission']['cachedir'] = '';
$db['db_studentAdmission']['char_set'] = 'utf8';
$db['db_studentAdmission']['dbcollat'] = 'utf8_general_ci';
$db['db_studentAdmission']['swap_pre'] = '';
$db['db_studentAdmission']['autoinit'] = TRUE;
$db['db_studentAdmission']['stricton'] = FALSE;



$db['atif_notification']['hostname'] = 'localhost';
$db['atif_notification']['username'] = 'root';
$db['atif_notification']['password'] = 'nasa';
$db['atif_notification']['database'] = 'atif_notification';
$db['atif_notification']['dbdriver'] = 'mysql';
$db['atif_notification']['dbprefix'] = '';
$db['atif_notification']['pconnect'] = TRUE;
$db['atif_notification']['db_debug'] = TRUE;
$db['atif_notification']['cache_on'] = FALSE;
$db['atif_notification']['cachedir'] = '';
$db['atif_notification']['char_set'] = 'utf8';
$db['atif_notification']['dbcollat'] = 'utf8_general_ci';
$db['atif_notification']['swap_pre'] = '';
$db['atif_notification']['autoinit'] = TRUE;
$db['atif_notification']['stricton'] = FALSE;


$db['gs_admission']['hostname'] = 'localhost';
$db['gs_admission']['username'] = 'root';
$db['gs_admission']['password'] = 'nasa';
$db['gs_admission']['database'] = 'atif_gs_admission';
$db['gs_admission']['dbdriver'] = 'mysql';
$db['gs_admission']['dbprefix'] = '';
$db['gs_admission']['pconnect'] = TRUE;
$db['gs_admission']['db_debug'] = TRUE;
$db['gs_admission']['cache_on'] = FALSE;
$db['gs_admission']['cachedir'] = '';
$db['gs_admission']['char_set'] = 'utf8';
$db['gs_admission']['dbcollat'] = 'utf8_general_ci';
$db['gs_admission']['swap_pre'] = '';
$db['gs_admission']['autoinit'] = TRUE;
$db['gs_admission']['stricton'] = FALSE;



// Badges Database
$db['gs_badges']['hostname'] = 'localhost';
$db['gs_badges']['username'] = 'root';
$db['gs_badges']['password'] = 'nasa';
$db['gs_badges']['database'] = 'gs_badges';
$db['gs_badges']['dbdriver'] = 'mysql';
$db['gs_badges']['dbprefix'] = '';
$db['gs_badges']['pconnect'] = TRUE;
$db['gs_badges']['db_debug'] = TRUE;
$db['gs_badges']['cache_on'] = FALSE;
$db['gs_badges']['cachedir'] = '';
$db['gs_badges']['char_set'] = 'utf8';
$db['gs_badges']['dbcollat'] = 'utf8_general_ci';
$db['gs_badges']['swap_pre'] = '';
$db['gs_badges']['autoinit'] = TRUE;
$db['gs_badges']['stricton'] = FALSE;

// Event DATABASE

$db['events']['hostname'] = 'localhost';
$db['events']['username'] = 'root';
$db['events']['password'] = 'nasa';
$db['events']['database'] = 'atif_gs_events';
$db['events']['dbdriver'] = 'mysql';
$db['events']['dbprefix'] = '';
$db['events']['pconnect'] = TRUE;
$db['events']['db_debug'] = TRUE;
$db['events']['cache_on'] = FALSE;
$db['events']['cachedir'] = '';
$db['events']['char_set'] = 'utf8';
$db['events']['dbcollat'] = 'utf8_general_ci';
$db['events']['swap_pre'] = '';
$db['events']['autoinit'] = TRUE;
$db['events']['stricton'] = FALSE;

/* End of file database.php */
/* Location: ./application/config/database.php */