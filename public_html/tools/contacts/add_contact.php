<?php
if (isset($_GET['cid'])) {
    $contact_id = $_GET['cid'];
}
//echo $contact_id;

$action;
if (isset($contact_id)) {
    $action = "Edit";

    $pdo = new PDO("mysql:host=localhost;dbname=ab78751_the_doors;", "ab78751", "qIaz0~rjZ2xe");
    $dbs = $pdo->prepare('select * from contact_table where contact_id = :contact_id');
    $dbs->bindParam(':contact_id', $contact_id, PDO::PARAM_STR);
    $edit_contact = array();

    if ($dbs->execute() && $dbs->rowCount() > 0) {
        $edit_contact = $dbs->fetch(PDO::FETCH_ASSOC);
    }
} else {
    $action = "Add";
}
?>
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
                    <input name="company" class="validate input" type="text" value="<?php
                    if (isset($edit_contact['company_name'])) {
                        echo $edit_contact['company_name'];
                    }
                    ?>" placeholder="ABC Company" maxlength="40" />
                    <span class="hide">*</span>
                </p>

                <p>	
                    <label class="label">Address Line One</label>
                    <input name="address_one" class="validate input" type="text" value="<?php
                    if (isset($edit_contact['company_address_line_one'])) {
                        echo $edit_contact['company_address_line_one'];
                    }
                    ?>" placeholder="15 Main St" maxlength="40" />
                    <span class="hide">*</span>
                </p>

                <p>				
                    <label class="label">Address Line Two</label>
                    <input name="address_two" class="input" type="text" value="<?php
                    if (isset($edit_contact['company_address_line_two'])) {
                        echo $edit_contact['company_address_line_two'];
                    }
                    ?>" placeholder="Suite 200" maxlength="40" />
                    <span class="hide">*</span>
                </p>

                <p>
                    <label>City</label>
                    <input name="city" class="validate input" type="text" value="<?php
                    if (isset($edit_contact['company_city'])) {
                        echo $edit_contact['company_city'];
                    }
                    ?>" placeholder="North Attleboro" maxlength="150" />
                    <span class="hide">*</span>
                </p>

                <!--Pull list of states for address drop down-->
                <p>
                    <label>State</label>
                    <?php
                    if (isset($edit_contact['company_state'])) {
                        $state_selected = $edit_contact['company_state'];
                    }

                    include 'states.php';

                    echo '<select name="state" class="validate">';
                    echo '<option value="">Select a state</option>';
                    foreach ($states as $key => $value) {
                        if ($state_selected == $key) {
                            echo '<option value="', $key, '" selected="selected">', $value, '</option>';
                        } else {
                            echo '<option value="', $key, '">', $value, '</option>';
                        }
                    }
                    echo '</select>';
                    ?>	
                </p>

                <p>
                    <label>ZIP Code</label>
                    <input name="zip" class="validate input" type="text" value="<?php
                    if (isset($edit_contact['company_zip'])) {
                        echo $edit_contact['company_zip'];
                    }
                    ?>" placeholder="02903" maxlength="10" />
                    <span class="hide">*</span>
                </p>

                <p>	
                    <label>Primary Contact</label>
                    <input name="primary_contact" class="validate input" type="text" value="<?php
                    if (isset($edit_contact['primary_contact'])) {
                        echo $edit_contact['primary_contact'];
                    }
                    ?>" placeholder="Mary May" maxlength="150" />
                    <span class="hide">*</span>
                </p>

                <p>	
                    <label>Phone</label>
                    <input name="primary_contact_phone" class="validate input" type="text" value="<?php
                    if (isset($edit_contact['primary_contact_phone'])) {
                        echo $edit_contact['primary_contact_phone'];
                    }
                    ?>" placeholder="508.555.5555" maxlength="10" />
                    <span class="hide">*</span>
                </p>

                <p>	
                    <label>Email</label>
                    <input name="primary_contact_email" class="validate input" type="text" value="<?php
                    if (isset($edit_contact['primary_contact_email'])) {
                        echo $edit_contact['primary_contact_email'];
                    }
                    ?>" placeholder="marymay@gmail.com" maxlength="150" />
                    <span class="hide">*</span>
                </p>

                <p>	
                    <label>Secondary Contact</label>
                    <input name="secondary_contact" class="input" type="text" value="<?php
                    if (isset($edit_contact['secondary_contact'])) {
                        echo $edit_contact['secondary_contact'];
                    }
                    ?>" placeholder="Maggie May" maxlength="150" />
                    <span class="hide">*</span>
                </p>

                <p>	
                    <label>Phone</label>
                    <input name="secondary_contact_phone" class="input" type="text" value="<?php
                    if (isset($edit_contact['secondary_contact_phone'])) {
                        echo $edit_contact['secondary_contact_phone'];
                    }
                    ?>" placeholder="508.555.5554" maxlength="10" />
                    <span class="hide">*</span>
                </p>

                <p>		
                    <label>Email</label>
                    <input name="secondary_contact_email" class="input" type="text" value="<?php
                    if (isset($edit_contact['secondary_contact_email'])) {
                        echo $edit_contact['secondary_contact_email'];
                    }
                    ?>" placeholder="maggiemay@gmail.com" maxlength="150" />
                    <span class="hide">*</span>		
                </p>

                <input type="hidden" name="contact_id" value="<?php if (isset($contact_id)) {
                               echo $contact_id;
                           } ?> "/>                
                <input class="submit_form <?php echo $action ?>" type="submit" name="submit" value="<?php echo $action ?>" />
                
                <?php 
                if($action == "Edit"){
                    echo '<button class="delete_contact" data-delete="' . $contact_id . '" >Delete</button>';
                }
                ?>


            </form>
        </div>

        <script type="text/javascript" src="tools/contacts/contacts.js"></script>

    </body>

</html>