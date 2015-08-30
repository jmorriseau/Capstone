<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="tools/invoices/main.css" />
        <link rel="stylesheet" type="text/css" href="images/css/font-awesome.css" />
    </head>
    <body>

        <div id="add_invoice_header">
            <h2>Please enter the new invoice information below.</h2>
        </div>

        <form id="add_invoice" action="#" method="post">

            <p>
                <label>Company</label>
                <?php
                $company_selected = filter_input(INPUT_POST, 'companies');
                //$selected = 'selected="selected"';
                $pdo = new PDO("mysql:host=localhost;dbname=the_doors; port=3307;", "root", "");
               
                $dbs = $pdo->prepare('select * from contact_table');
                $companies = array();
                $dbs->execute();
                $companies = $dbs->fetchAll(PDO::FETCH_ASSOC);
                echo '<select name="company_name">';
                echo '<option value=" ">Select a Company</option>';
                foreach ($companies as $value) {
                    if ($company_selected == $value) {
                        echo '<option value="'. $value['company_name']. '" selected="selected">'. $value['company_name']. '</option>';
                    } else {
                        echo '<option value="'. $value['company_name']. '">'. $value['company_name']. '</option>';
                    }
                }
                echo '</select>';
                ?>
            </p>

            <p>	
                <label>Invoice Number:</label>
                <input name="invoice_num" class="validate" type="text" value="" placeholder="123" maxlength="10" />
                <span class="hide">*</span>
            </p>
<!--
            <p>				
                <label>Address Line Two</label>
                <input name="address_two" type="text" value="" placeholder="Suite 200" maxlength="40" />
                <span class="hide">*</span>
            </p>
            <p>
                <label>City</label>
                <input name="city" class="validate" type="text" value="" placeholder="North Attleboro" maxlength="150" />
                <span class="hide">*</span>
            </p>
            <p>
                <label>State</label>
                <?php
                $state_selected = filter_input(INPUT_POST, 'states');
                //$selected = 'selected="selected"';
                include 'states.php';
                echo '<select name="states">';
                foreach ($states as $key => $value) {
                    if ($state_selected == $key) {
                        echo '<option value="', $key, '" selected="selected">', $value, '</option>';
                    } else {
                        echo '<option value="', $key, '">', $value, '</option>';
                    }
                }
                echo '</select>';
                ?>	
            </p>-->

<!--            <p>
                <label>ZIP Code</label>
                <input name="zip" class="validate" type="text" value="" placeholder="02903" maxlength="10" />
                <span class="hide">*</span>
            </p>
            <p>	
                <label>Primary Contact</label>
                <input name="primary_contact" class="validate" type="text" value="" placeholder="Mary May" maxlength="150" />
                <span class="hide">*</span>
            </p>
            <p>	
                <label>Phone</label>
                <input name="primary_contact_phone" class="validate" type="text" value="" placeholder="508.555.5555" maxlength="13" />
                <span class="hide">*</span>
            </p>
            <p>	
                <label>Email</label>
                <input name="primary_contact_email" class="validate" type="text" value="" placeholder="marymay@gmail.com" maxlength="150" />
                <span class="hide">*</span>
            </p>
            <p>	
                <label>Secondary Contact</label>
                <input name="secondary_contact" type="text" value="" placeholder="Maggie May" maxlength="150" />
                <span class="hide">*</span>
            </p>
            <p>	
                <label>Phone</label>
                <input name="secondary_contact_phone" type="text" value="" placeholder="508.555.5554" maxlength="13" />
                <span class="hide">*</span>
            </p>
            <p>		
                <label>Email</label>
                <input name="secondary_contact_email" type="text" value="" placeholder="maggiemay@gmail.com" maxlength="150" />
                <span class="hide">*</span>		
            </p>-->

            <input type="submit" name="submit" value="Save" />


        </form>

        <!--<script type="text/javascript" src="tools/invoices/contacts.js"></script>-->

    </body>

</html>