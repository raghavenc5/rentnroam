/****
 * Funtion to remove the error class of the input box
 **/
function remove_error_class(input_id) {
	$("#"+input_id).parents('div.control-group').removeClass('error');			
}

/***
 * Function to display the dashboard when user click on the cancel button from any view
 **/
function go_to_dashboard() {	
	window.location = SITE_URL + 'admin/dashboard';
}

function get_value(e)
{
	alert(e.val);
}