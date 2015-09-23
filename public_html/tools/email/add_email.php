<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="tools/contacts/main.css" />
        <link rel="stylesheet" type="text/css" href="images/css/font-awesome.css" />
    </head>
    <body>

        <div id="add_contact_header">
            <h2>Please enter the new email information below.</h2>
        </div>
        
        <div class="form_style">
        <form id="add_email" action="#" method="post">

            <p>
                <label>Company</label>
                <?php
                $company_selected = filter_input(INPUT_POST, 'companies');
                //$selected = 'selected="selected"';
                $pdo = new PDO("mysql:host=localhost;dbname=ab78751_the_doors;", "ab78751", "qIaz0~rjZ2xe");

                $dbs = $pdo->prepare('select * from contact_table');
                $companies = array();
                $dbs->execute();
                $companies = $dbs->fetchAll(PDO::FETCH_ASSOC);
                echo '<select name="company_name" class="validate">';
                echo '<option value="">Select a Company</option>';
                foreach ($companies as $value) {
                    if ($company_selected == $value) {
                        echo '<option value="' . $value['company_name'] . '" selected="selected">' . $value['company_name'] . '</option>';
                    } else {
                        echo '<option value="' . $value['company_name'] . '">' . $value['company_name'] . '</option>';
                    }
                }
                echo '</select>';
                ?>
                <span class="hide">*</span>
            </p>

            <p>	
                <label>Subject</label>
                <input name="email_subject" class="validate input" type="text" value="" placeholder="Invoice #12345" maxlength="150" />
                <span class="hide">*</span>
            </p>
            
            <p>	
                <label>Message</label>
                <textarea name="email_message" rows="20" cols="100" class="validate" placeholder="Hello"></textarea>
                <span class="hide">*</span>
            </p>


            <input type="submit" name="submit" value="Save" />


        </form>
        </div>    

        <script type="text/javascript" src="tools/email/email.js"></script>

    </body>

</html>