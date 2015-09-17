<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="tools/projects/main.css" />
        <link rel="stylesheet" type="text/css" href="images/css/font-awesome.css" />
    </head>
    <body>

        <div id="project_header">
            <h2>Please select a project below to begin.</h2>
        </div>

        <div id="project_content">

            <div id="link_add_project">
                <a href="#"><h2>Add Project</h2>
                    <i class="fa fa-plus fa-5x"></i></a>
            </div>
        </div>

        <div id="project_content">
            <?php
            $pdo = new PDO("mysql:host=localhost;dbname=the_doors; port=3306;", "root", "");
            $dbs = $pdo->prepare('select * from project_table join contact_table on project_table.contact_id');
            $projects = array();

            if ($dbs->execute() && $dbs->rowCount() > 0) {
                $projects = $dbs->fetchAll(PDO::FETCH_ASSOC);

                foreach ($projects as $project) {
                    echo '<table><thead>';
                    echo '<tr><th>' . 'Project Information' . '</th></tr></thead>';

                    echo '<tbody><tr> <td>' . $project["company_name"] . '</td> </tr>';
                    echo '<tr> <td>' . $project["project_name"] . '</td> </tr>';
                    echo '<tr> <td>' . $project["project_date_created"] . '</td></tr>';
                    echo '<tr> <td>' . $project["invoice_number"] . '</td></tr>';                   
                    echo '<tr> <td>' . $project["photo_blob"] . '</td></tr></tbody>';

                    echo '</table>';
                }
            } else {
                echo 'No projects found';
            }
            ?>

        </div>

        <script type="text/javascript" src="on_load.js"></script>

    </body>

</html>