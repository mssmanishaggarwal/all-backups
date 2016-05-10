<?php

return [


	/*
   |--------------------------------------------------------------------------
   | Password Reminder Language Lines
   |--------------------------------------------------------------------------
   |
   | The following language lines are the default lines which match reasons
   | that are given by the password broker for a password update attempt
   | has failed, such as for an invalid token or invalid new password.
   |
   */

		'invalidlogin' => 'Invalid Email or Password!',

	// common Caption Name
		'actions' => 'Actions',
		'delete' => 'Delete',
		'cancel' => 'Cancel',
		'save' => 'Save',
		'edit' => 'Edit',
		'saving' => 'Saving',
		'saved' => 'Saved',
		'deleted' => 'Data Successfully Deleted',
		'assign' => 'Assign',
		'close' => 'Close',

	//paging
		'prev' =>'Previous',
		'next' =>'Next',
		'page' => 'Page',
		'of' => 'Of',

		'territory_title' => 'System Setting : Territory Codes',
		'territory_code' => 'Territory Code',
		'territory_name' => 'Territory Name',
		'territory_delete' => 'Delete',
		'territory_Edit' => 'Edit',
		'territory_add' => 'Add Territory',

	// System Setting industry
		'industry_title' => 'System Setting : Industry Codes',
		'industry_code' => 'Industry Code',
		'industry_name' => 'Industry Name',
		'industry_delete' => 'Delete',
		'industry_Edit' => 'Edit',
		'industry_add' => 'Add Industry',

	// System Setting Source
		'source_title' => 'System Setting : Source Codes',
		'source_code' => 'Source Code',
		'source_name' => 'Source Name',
		'source_delete' => 'Delete',
		'source_Edit' => 'Edit',
		'source_add' => 'Add Source',

	// System Setting Classification
		'classification_title' => 'System Setting : Client Classification',
		'classification_code' => 'Classification Code',
		'classification_name' => 'Classification Name',
		'classification_desc' => 'Classification Description',
		'classification_delete' => 'Delete',
		'classification_Edit' => 'Edit',
		'classification_add' => 'Add Classification',
		'classification_call_cycle' => 'Call Cycle',
		'classification_followup' => 'Follow Up Method',

	// System Setting Followup Method
		'followup_title' => 'System Setting : Follow-up Methods',
		'followup_icon_file_name' => 'Icon',
		'followup_name' => 'Name',
		'followup_desc' => 'Description',
		'followup_delete' => 'Delete',
		'followup_edit' => 'Edit',
		'followup_add' => 'Add Follow-up Method',
		'followup_save_msg' => 'Saved',
		'followup_image_type_error' => 'Only png,jpeg,gif files are allowed.',
		'followup_delete_msg' => 'Deleted',
		'followup_error_delete' => 'Unable to delete. This follow-up method is referenced by other data records.',


	// System Setting Barometer
		'barometer_title' => 'System Setting : Barometer Codes',
		'barometer_code' => 'Barometer Code',
		'barometer_name' => 'Barometer Name',
		'barometer_delete' => 'Delete',
		'barometer_Edit' => 'Edit',
		'barometer_add' => 'Add Barometer',

	// System Setting Call Cycle
		'call-cycle_title' => 'System Setting : Call Cycle',
		'call-cycle_name' => 'Call Cycle Name',
		'call-cycle_delete' => 'Delete',
		'call-cycle_edit' => 'Edit',
		'call-cycle_add' => 'Add Call Cycle',

	// System Setting Page
		'system-setting_title' => 'System Settings',

	// System Setting Staff Type
		'staff-type_title' => 'System Setting : Staff Type',
		'staff-type_name' => 'Staff Type Name',
		'staff-type_desc' => 'Staff Type Description',
		'staff-type_delete' => 'Delete',
		'staff-type_edit' => 'Edit',
		'staff-type_add' => 'Add Staff Type',

	// System Setting Daily Activity
		'daily-activity_title' => 'System Setting : Daily Activity',
		'daily-activity_daysper_timesheet' => 'Days Per Timesheet',
		'daily-activity_timesheet_statuses_label' => 'Timesheet Statuses',
		'daily-activity_timesheet_statuse_label' => 'Timesheet Statuse',
		'daily-activity_edit' => 'Edit',
		'daily-activity_save_msg' => 'Saved',
		'daily-activity_err_msg_days' => 'Days per Timesheet must be between 1 and 365, inclusive',
		'daily-activity_err_msg_status' => 'Status must be less than 20 characters long',


	// System Setting Task Type
		'task-type_title' => 'System Setting : Task Type',
		'task-type_name' => 'Task Type Name',
		'task-type_desc' => 'Task Type Description',
		'task-type_delete' => 'Delete',
		'task-type_edit' => 'Edit',
		'task-type_add' => 'Add Task Type',

	// System Setting Staff Task Type
		'staff-task-type_title' => 'System Setting : Staff Task Type',
		'staff-task-type_assign' => 'Assign',
		'staff-task-type_task' => 'Task Type',
		'staff-task-type_filter' => 'Type to filter...',
		'staff-task-type_save' => 'Save',
		'staff-task-type_save_msg' => 'Saved',
		'staff-task-type_previous' => 'Previous',
		'staff-task-type_next' => 'Next',
		'staff-task-type_page' => 'Page Number : ',
		'staff-task-type_of' => ' of ',

	//user management
		'user_title' =>'User Management',
		'user_table' =>'User',
		'user_select' =>'Select',
		'user_staff_type' =>'Staff Type:',
		'user_close' =>'Close',
		'user_save' =>'Save',
		'user_save_msg' =>'Saved',
		'user_filter' =>'Type to filter ...',
		'lblAST' => 'Approver for Staff Type:',
		'user_tab_details' => 'Basic Details',
		'user_tab_approvals' => 'Approvals',
		'user_tab_groups' => 'Groups',
		'user_tab_territory' => 'Territories',
		'user_tab_role' => 'Roles',
		'user_role_description' => 'Roles determine the system permissions for the user',

	//group
		'group_title' => 'System Setting : Group',
		'group_name' => 'Group Name',
		'group_desc' => 'Group Description',
		'group_add' => 'Add Group',

	//report
		'report_title' => 'System Setting : Report',
		'report_name' => 'Report Name',

	//report group
		'' => '',
		'report-group_title' => 'System Setting : Report Group',

		'email' => 'Email',
		'password' => 'Password',
		'login' => 'Login',
		'rememberme' => 'Remember Me',

	// error handling
		'error404_title' => 'Page Not Found',
		'error404_message' => 'The page you have requested could not be found',
		'error500_title' => 'System Error',
		'error500_message' => 'We\'re sorry - a system error has occurred. The system administrator has been notified',
		'error403_title' => 'Invalid Access',
		'error403_message' => 'Only System Administrator has rights to access this page',

	//daily activity summary mail
		'tsc1' => 'Your Daily Activities for',
		'tsc2' => 'have been',
		'tsc3' => 'The following message was included :',
		'tsc4' => 'Sent from',
		'tsc5' => 'This is a system-generated message, please do not reply to this email.',
		'tsc6' => 'Message sent at:',
		'tsc7' => 'Build Number:',
		'tsc-link' => 'Click here to view this Timesheet',

	//master file maintenance
		'mfm_title' => 'Master File Maintenance',
		'mfm_save' => 'Save',
		'mfm_saved' => 'Saved',
		'mfm_update' => 'Update',
		'mfm_th1' => 'Client Code',
		'mfm_th2' => 'Stage',
		'mfm_th3' => 'Territory Code',
		'mfm_th4' => 'Barometer',
		'mfm_th5' => 'Client Classification',
		'mfm_c1' => 'Contact',
		'mfm_c2' => 'Contact',

	//system setting contract info
		'contract_id' => 'Contract ID',
		'contract_name' => 'Contract Name',
		'contract_add' => 'Add Contract',
		'contract_page_title' => 'System Setting : Contract Information',

	//JSON API Messages
		'general_exception' => 'An error occurred while processing the request',
		'query_exception' => 'An error occurred while accessing the database',
		'success_msg_json' => 'All went well, and (usually) some data was returned',
		'response_json_required' => 'Only JSON responses are supported',
		'response_error_db' => 'Database Error',
        'delete_error'  => 'This item cannot be deleted because other system data depends on it.'


];
