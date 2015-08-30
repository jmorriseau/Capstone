<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="tools/projects/main.css" />
        <link rel="stylesheet" type="text/css" href="images/css/font-awesome.css" />
    </head>
    <body>

        <div id="add_project_header">
            <h2>Please enter the new contact information below.</h2>
        </div>

        <form id="add_project" action="#" method="post">

            <p>
                <label>Company</label>
                <input name="company" class="validate" type="text" value="" placeholder="ABC Company" maxlength="40" />
                <span class="hide">*</span>
            </p>
            
            <p>
			<label>Company</label>
				<?php
					$company_selected = filter_input(INPUT_POST,'company');
					//$selected = 'selected="selected"';
						
					include 'states.php';
					
					echo '<select name="states">';
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
                <label>Project Name</label>
                <input name="project_name" class="validate" type="text" value="" placeholder="Dock Leveler Project" maxlength="40" />
                <span class="hide">*</span>
            </p>

            <p>				
                <label>Invoice Number</label>
                <input name="invoice_number" type="text" value="" placeholder="12345" maxlength="40" />
                <span class="hide">*</span>
            </p>

            <p>
            <div id="photo_content">
                <div id="link_add_photos">
                    <h2><a href="#">Add Photos</a></h2>
                    <i class="fa fa-plus fa-5x"></i>
                </div>
            </div>
            
            <div id="note_content">
                <div id="link_add_photo_notes">
                    <h2><a href="#">Add Notes</a></h2>
                    <i class="fa fa-plus fa-5x"></i>
                </div>
            </div>



            <input type="submit" name="submit" value="Save" />


        </form>

        <script type="text/javascript" src="tools/projects/projects.js"></script>

    </body>

</html>