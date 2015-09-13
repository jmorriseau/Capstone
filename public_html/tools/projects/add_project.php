<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="tools/projects/main.css" />
        <link rel="stylesheet" type="text/css" href="images/css/font-awesome.css" />
    </head>
    <body>

        <div id="add_project_header">
            <h2>Please enter the new project information below.</h2>
        </div>

        <form id="add_project" action="#" method="post" enctype="multipart/form-data">

            <p>
                <label>Company</label>
                <?php
                $company_selected = filter_input(INPUT_POST, 'companies');
                //$selected = 'selected="selected"';
                $pdo = new PDO("mysql:host=localhost;dbname=the_doors; port=3306;", "root", "");

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
                    <h2>Add Photos</h2>                   
                    <i class="fa fa-plus fa-5x"><input type="file" name="fileToUpload" id="fileToUpload"></i>
                    <!--<input type="submit" value="Upload Image" name="submit">-->
                </div>
            </div>

<!--            <div id="note_content">
                <div id="link_add_photo_notes">
                    <h2>Add Notes</h2>
                    <i class="fa fa-plus fa-5x"><input type="file" name="fileToUpload" id="fileToUpload"></i>
                    <input type="submit" value="Upload Image" name="submit">
                </div>
            </div>-->



            <input type="submit" name="submit" value="Save" />


        </form>

        <script type="text/javascript" src="tools/projects/projects.js"></script>

    </body>

</html>