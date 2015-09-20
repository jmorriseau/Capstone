<?php
if (isset($_GET['pid'])) {
    $project_id = $_GET['pid'];
}
//echo $project_id;

$action;
if (isset($project_id)) {
    $action = "Edit";

    $pdo = new PDO("mysql:host=localhost;dbname=the_doors; port=3306;", "root", "");
    $dbs = $pdo->prepare('select * from project_table join contact_table on project_table.contact_id WHERE project_id = :project_id');
    $dbs->bindParam(':project_id', $project_id, PDO::PARAM_STR);
    $edit_project = array();

    if ($dbs->execute() && $dbs->rowCount() > 0) {
        $edit_project = $dbs->fetch(PDO::FETCH_ASSOC);
    }
} else {
    $action = "Add";
}
?>
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

        <div class="form_style">
            <form id="add_project" action="#" method="post" enctype="multipart/form-data">

                <p>
                    <label>Company</label>
                    <?php
                    if (isset($project_id )) {
                        $company_selected = $edit_project['company_name'];
                        echo $company_selected;
                    } else {
                        $pdo = new PDO("mysql:host=localhost;dbname=the_doors; port=3306;", "root", "");
                        $dbs = $pdo->prepare('select company_name from contact_table');
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
                    }
                    ?>
                    <span class="hide">*</span>
                </p>

                <p>	
                    <label>Project Name</label>
                    <input name="project_name" class="validate input" type="text" value="<?php
                    if (isset($edit_project['project_name'])) {
                        echo $edit_project['project_name'];
                    }
                    ?>" placeholder="Dock Leveler Project" maxlength="40" />
                    <span class="hide">*</span>
                </p>

                <p>				
                    <label>Invoice Number</label>
                    <input name="invoice_number" class="input" type="text" value="<?php
                    if (isset($edit_project['invoice_number'])) {
                        echo $edit_project['invoice_number'];
                    }
                    ?>" placeholder="12345" maxlength="40" />
                    <span class="hide">*</span>
                </p>


                <div id="photo_content">
                    <div id="link_add_photos">
                        <h3>Add Photos</h3>                   
                        <i class="fa fa-plus fa-5x"><input type="file" name="fileToUpload" id="fileToUpload"></i>
                        <!--<input type="submit" value="Upload Image" name="submit">-->
                    </div>
                </div>

                <p>				
                    <label>Notes</label>
                    <textarea name="project_notes" rows="10" cols="50" placeholder="Add some notes"><?php
                    if (isset($edit_project['note_blob'])) {
                        echo $edit_project['note_blob'];
                    }
                    ?></textarea>
                    <span class="hide">*</span>
                </p>

                <input type="hidden" name="project_id" value="<?php
                        if (isset($project_id)) {
                            echo $project_id;
                        }
                    ?> "/>   
                <input type="hidden" name="company_selected" value="<?php
                        if (isset($company_selected)) {
                            echo $company_selected;
                        }
                    ?> "/>   
                <input class="submit_form <?php echo $action ?>" type="submit" name="submit" value="<?php echo $action ?>" />
                
                <?php 
                if($action == "Edit"){
                    echo '<button class="delete_project" data-delete="' . $project_id . '" >Delete</button>';
                }
                ?>

            </form>
        </div>

        <script type="text/javascript" src="tools/projects/projects.js"></script>

    </body>

</html>