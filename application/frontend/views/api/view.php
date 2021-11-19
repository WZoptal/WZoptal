<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.js"></script>
<div class="container" style="padding: 20px 0 50px;">
	<div class="row">
		<div class="col-sm-12" style="border: 1px solid #ddd;margin-bottom: 20px;">
			<h3>Socket Events Emit:</h3>
			<form onsubmit="emitSocket(); return false;" method="post" target="_blank" id="event_form">
 				<div class="row">
					<div class="form-group col-sm-12">
						<select name="socket_events" id="socket_events" form="event_form">
						  <option value="welcome_screen_emitter">welcome_screen</option>
						  <option value="gallery_permission_screen_emitter">gallery_permission_screen</option>
						  <option value="camera_permission_screen_emitter">camera_permission_screen</option>
						  <option value="complete_setup_category_emitter">complete_setup_category</option>
						  <option value="storage_permission_screen_emitter">storage_permission_screen</option>
						  <option value="push_notification_screen_emitter">push_notification_screen</option>
						  <option value="app_drawer_permission_emitter">app_drawer_permission</option>
						  <option value="get_ladder_screen_emitter">get_ladder_screen</option>
						  <option value="selected_category_questions_emitter">selected_category_questions</option>
						  <option value="complete_setup_questions_emitter">complete_setup_questions</option>
						  <option value="tutorial_screen_emitter">tutorial_screen</option>
						  <option value="get_quick_setup_emitter">get_quick_setup</option>
						  <option value="choose_set_up_emitter">choose_set_up</option>
						  <option value="signup_signin_selection_emitter">signup_signin_selection</option>
						</select>
						<input type="submit" value="Emit Socket" class="btn btn-warning">
 					</div>
				</div>
			</form>
		</div>
 		<div class="col-sm-12" style="border: 1px solid #ddd;margin-bottom: 20px;">
			<h3>Register:</h3>
			<form action="<?= base_url(); ?>home/register" method="post" target="_blank">
 				<div class="row">
					<div class="form-group col-sm-3">
						<label for="email">Email:</label>
						<input type="email" class="form-control" name="email" required="required">
					</div>
					<div class="form-group col-sm-3">
						<label for="username">Username:</label>
						<input type="text" class="form-control" name="username" required="required">
					</div>
					<div class="form-group col-sm-3">
						<label for="password">Password:</label>
						<input type="password" class="form-control" name="password" required="required"> 
					</div>
  					<div class="form-group col-sm-3">
						<label for="device_type">Device Type:</label>
						<input type="text" class="form-control" name="device_type">
					</div>
					<div class="form-group col-sm-3">
						<label for="device_token">Device Token:</label>
						<input type="text" class="form-control" name="device_token">
					</div>
                  </div>
				<div class="row">
					<div class="form-group col-sm-12">
						<input type="submit" value="Submit" class="btn btn-warning">
						<input type="reset" value="Reset" class="btn btn-primary">
					</div>
				</div>
			</form>
		</div>
 		<div class="col-sm-6" style="border: 1px solid #ddd;margin-bottom: 20px;">
			<h3>Login:</h3>
			<form action="<?= base_url();?>home/login" method="post" target="_blank">
 				<div class="row">
					<div class="form-group col-sm-6">
						<label for="username">Email:</label>
						<input type="text" class="form-control" name="email" required="required">
					</div>
					<div class="form-group col-sm-6">
						<label for="password">Password:</label>
						<input type="password" class="form-control" name="password" required="required">
					</div>
 					<div class="form-group col-sm-3">
						<label for="device_type">Device Type:</label>
						<input type="text" class="form-control" name="device_type" required="required">
					</div>
					<div class="form-group col-sm-3">
						<label for="device_token">Device Token:</label>
						<input type="text" class="form-control" name="device_token" required="required">
					</div>
				</div>
				<div class="row">
					<div class="form-group col-sm-6">
						<input type="submit" value="Submit" class="btn btn-warning">
						<input type="reset" value="Reset" class="btn btn-primary">
					</div>
				</div>
			</form>
		</div>
		<!--<div class="col-sm-3" style="border: 1px solid #ddd;margin-bottom: 20px;">
			<h3>Logout:</h3>
			<form action="<?= base_url();?>home/logout" method="post" target="_blank">
				<div class="row">
					<div class="form-group col-sm-12">
						<label for="access_token">Access Token:</label>
						<input type="text" class="form-control" name="access_token" required="required">
					</div>
				</div>
				<div class="row">
					<div class="form-group col-sm-12">
						<input type="submit" value="Submit" class="btn btn-warning">
						<input type="reset" value="Reset" class="btn btn-primary">
					</div>
				</div>
			</form>
		</div>-->
		<div class="col-sm-3" style="border: 1px solid #ddd;margin-bottom: 20px;">
			<h3>Forgot Password:</h3>
			<form action="<?= base_url();?>home/forgot_password" method="post" target="_blank">
				<div class="row">
					<div class="form-group col-sm-12">
						<label for="email">Email:</label>
						<input type="email" class="form-control" name="email" required="required">
					</div>
				</div>
				<div class="row">
					<div class="form-group col-sm-12">
						<input type="submit" value="Submit" class="btn btn-warning">
						<input type="reset" value="Reset" class="btn btn-primary">
					</div>
				</div>
			</form>
		</div>
        
		 <div class="col-sm-12" style="border: 1px solid #ddd;margin-bottom: 20px;">
			<h3>Update Profile:</h3>
			<form action="<?= base_url();?>home/update_profile" method="post" target="_blank"  enctype="multipart/form-data">
 				<div class="row">
                    <div class="form-group col-sm-3">
						<label for="access_token">Access Token:</label>
						<input type="text" class="form-control" name="access_token">
					</div>					
					<div class="form-group col-sm-3">
						<label for="username">Username:</label>
						<input type="text" class="form-control" name="username">
					</div>
 					<div class="form-group col-sm-3">
						<label for="email">Email:</label>
						<input type="text" class="form-control" name="email">
					</div>
                    <div class="form-group col-sm-3">
						<label for="profile_pic">Profile Pic:</label>
						<input type="file"  name="profile_pic" accept="image/*" capture="camera" >
					</div>
                    
				</div>
 				<div class="row">
					<div class="form-group col-sm-12">
						<input type="submit" value="Submit" class="btn btn-warning">
						<input type="reset" value="Reset" class="btn btn-primary">
					</div>
				</div>
			</form>
			 
		</div>
        <!--<div class="col-sm-12" style="border: 1px solid #ddd;margin-bottom: 20px;">
			<h3>Profile:</h3>
			<form action="<?= base_url();?>home/profile_data" method="post" target="_blank" >
 				<div class="row">
                    <div class="form-group col-sm-3">
						<label for="access_token">Access Token:</label>
						<input type="text" class="form-control" name="access_token" required="required">
					</div>					
 				</div>
  				<div class="row">
					<div class="form-group col-sm-12">
						<input type="submit" value="Submit" class="btn btn-warning">
						<input type="reset" value="Reset" class="btn btn-primary">
					</div>
				</div>
			</form>
			 
		</div>-->
		<div class="col-sm-12" style="border: 1px solid #ddd;margin-bottom: 20px;">
			<h3>Change Password:</h3>
			<form action="<?= base_url();?>home/change_password" method="post" target="_blank">
				<div class="row">
					<div class="form-group col-sm-3">
						<label for="access_token">Access Token:</label>
						<input type="text" class="form-control" name="access_token">
					</div>
					<div class="form-group col-sm-3">
						<label for="old_password">Old Password:</label>
						<input type="password" class="form-control" name="old_password">
					</div>
					<div class="form-group col-sm-3">
						<label for="password">New Password:</label>
						<input type="password" class="form-control" name="password">
					</div>
 				</div>
				<div class="row">
					<div class="form-group col-sm-12">
						<input type="submit" value="Submit" class="btn btn-warning">
						<input type="reset" value="Reset" class="btn btn-primary">
					</div>
				</div>
			</form>
		</div>
		<div class="col-sm-12" style="border: 1px solid #ddd;margin-bottom: 20px;">
			<h3>Get Categories:</h3>
			<form action="<?= base_url();?>home/categories_list" method="post" target="_blank">
 				<div class="row">
					<div class="form-group col-sm-12">
						<input type="submit" value="Submit" class="btn btn-warning">
 					</div>
				</div>
			</form>
		</div>
 	</div>
</div>

<script type="text/javascript">
	var locationFields = ['autocomplete1','autocomplete2','autocomplete3','autocomplete4','autocomplete5'];
	function initialize() {
		for (i=0;i<locationFields.length; i++){
	        autocomplete = new google.maps.places.Autocomplete(
	            (document.getElementById(locationFields[i])),
	            {types: ['geocode']}
	        );
	    }
  	}
</script>

<script>
        var socket = io('https://nodeapi.happego.app');
        function emitSocket(){
        	var socket_event = jQuery('#socket_events').val();
		    var dataToSend = {};
			socket.emit(socket_event, dataToSend, function (data) {
				console.log(data);
		    })

		    socket.once('welcome_screen',function (data) {
		    	alert(data);
				console.log(data);
		    })

		    socket.once('tutorial_screen',function (data) {
		    	alert(data);
				console.log(data);
		    })
		    alert("Event Emitted ===" + socket_event);
        	return false;
        }

    </script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBsUm67BedCehI6va-1pkchfpmJeM3zExM&libraries=places&callback=initialize" async defer></script>