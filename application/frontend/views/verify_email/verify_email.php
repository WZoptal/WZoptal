<div class="container" style="padding: 20px 0 50px;">
	<div class="row"> 
		<div class="col-sm-12" style="border: 1px solid #ddd;margin-bottom: 20px;">
		  <fieldset>
		<?php if($err_status == 0){ $style = 'style="color:green"'; ?>
	       <legend> Success </legend>
		<?php } else { $style = 'style="color:red"'; ?>
	       <legend> Error </legend>
		<?php }	?>						 
			<div class="row">
				<div class="form-group col-sm-12">
					<label <?= $style; ?> > <?= $verifymessage; ?> </label>						
				</div>					
			</div>
		   </fieldset>
		</div> 
 	</div>
</div>

 