<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="tools/contacts/main.css" />
		<link rel="stylesheet" type="text/css" href="images/css/font-awesome.css" />
	</head>
<body>

	<div id="add_contact_header">
		<h2>Please enter the new contact information below.</h2>
	</div>
                
                <!--Form to add a new contact-->
                <div class="form_style">
		<form id="add_contact" action="#" method="post">
		
			<p>
			<label class="label">Company</label>
				<input name="company" class="validate input" type="text" value="" placeholder="ABC Company" maxlength="40" />
					<span class="hide">*</span>
			</p>
			
			<p>	
			<label class="label">Address Line One</label>
				<input name="address_one" class="validate input" type="text" value="" placeholder="15 Main St" maxlength="40" />
					<span class="hide">*</span>
			</p>
			
			<p>				
			<label class="label">Address Line Two</label>
				<input name="address_two" class="input" type="text" value="" placeholder="Suite 200" maxlength="40" />
					<span class="hide">*</span>
			</p>
			
			<p>
			<label>City</label>
				<input name="city" class="validate input" type="text" value="" placeholder="North Attleboro" maxlength="150" />
					<span class="hide">*</span>
			</p>
			
                        <!--Pull list of states for address drop down-->
			<p>
			<label>State</label>
				<?php
					$state_selected = filter_input(INPUT_POST,'states');
					
					include 'states.php';
					
					echo '<select name="state" class="validate">';
                                        echo '<option value="">Select a state</option>';
					foreach($states as $key => $value){
						if($state_selected == $key){
						echo '<option value="',$key,'" selected="selected">',$value,'</option>';      
						} else {
						   echo '<option value="',$key,'">',$value,'</option>';  
						}
						
					}  
					echo '</select>';
				?>	
			</p>
			
			<p>
			<label>ZIP Code</label>
				<input name="zip" class="validate input" type="text" value="" placeholder="02903" maxlength="10" />
					<span class="hide">*</span>
			</p>

			<p>	
			<label>Primary Contact</label>
				<input name="primary_contact" class="validate input" type="text" value="" placeholder="Mary May" maxlength="150" />
					<span class="hide">*</span>
			</p>

			<p>	
			<label>Phone</label>
				<input name="primary_contact_phone" class="validate input" type="text" value="" placeholder="508.555.5555" maxlength="10" />
					<span class="hide">*</span>
			</p>

			<p>	
			<label>Email</label>
				<input name="primary_contact_email" class="validate input" type="text" value="" placeholder="marymay@gmail.com" maxlength="150" />
					<span class="hide">*</span>
			</p>

			<p>	
			<label>Secondary Contact</label>
				<input name="secondary_contact" class="input" type="text" value="" placeholder="Maggie May" maxlength="150" />
					<span class="hide">*</span>
			</p>

			<p>	
			<label>Phone</label>
				<input name="secondary_contact_phone" class="input" type="text" value="" placeholder="508.555.5554" maxlength="10" />
					<span class="hide">*</span>
			</p>
			
			<p>		
			<label>Email</label>
				<input name="secondary_contact_email" class="input" type="text" value="" placeholder="maggiemay@gmail.com" maxlength="150" />
					<span class="hide">*</span>		
			</p>
			
			<input type="submit" name="submit" value="Save" />

			
		</form>
                </div>
	
<script type="text/javascript" src="tools/contacts/contacts.js"></script>
	
</body>

</html>