<?php
$a=$this->_ci_view_paths;
print_r($a);

?><div class="container" style="padding: 20px 0 50px;">
	<div class="row">
 		<div class="col-sm-12" style="border: 1px solid #ddd;margin-bottom: 20px;">
			<h3>Register:</h3>
			<form action="<?= base_url(); ?>home/signup" method="post" target="_blank">
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
						<label for="phone">Phone:</label>
						<input type="text" class="form-control" name="phone" required="required">
					</div>
 				</div>
                 <div class="row">
					<div class="form-group col-sm-3">
						<label for="name" required="required">Name:</label>
						<input type="text" class="form-control" name="name"  required="required" />
					</div>
					<div class="form-group col-sm-3">
						<label for="name" required="required">User Type :</label>
						<input type="text" class="form-control" name="name"  required="required" placeholder="1 -> Visitor/Owner, 2 -> Guard" />
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
		<div class="col-sm-3" style="border: 1px solid #ddd;margin-bottom: 20px;">
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
		</div>
		<div class="col-sm-3" style="border: 1px solid #ddd;margin-bottom: 20px;">
			<h3>Forget Password:</h3>
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
						<label for="first_name">name:</label>
						<input type="text" class="form-control" name="name">
					</div>
 					<div class="form-group col-sm-3">
						<label for="email">Email:</label>
						<input type="text" class="form-control" name="email">
					</div>
					<div class="form-group col-sm-3">
						<label for="phone">Phone Number:</label>
						<input type="text" class="form-control" name="phone">
					</div>
                     <div class="form-group col-sm-3">
						<label for="dob">Date of Birth:</label>
						<input type="text" class="form-control" name="dob">
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
        <div class="col-sm-12" style="border: 1px solid #ddd;margin-bottom: 20px;">
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
			 
		</div>
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
					<div class="form-group col-sm-3">
						<label for="cpassword">Confirm Password:</label>
						<input type="password" class="form-control" name="cpassword">
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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBsUm67BedCehI6va-1pkchfpmJeM3zExM&libraries=places&callback=initialize" async defer></script>