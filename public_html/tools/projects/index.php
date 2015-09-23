<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="tools/projects/main.css" />
        <link rel="stylesheet" type="text/css" href="images/css/font-awesome.css" />
        <script>
            $(function(){
                $(".edit_project").on("click",function(){
                    var id = $(this).data("project");
                    $("#content").load("tools/projects/add_project.php?pid=" + id);
                });
            });
        </script>
    </head>
    <body>

        <div class="tool_header">
            <h2>Please select a project below to begin.</h2>
        </div>

        <div class="tool_content">
            <div id="link_add_project">
                <a href="#">
                    <div class="tool_name">Add Project</div>
                    <div class="tool_body"><div class="icon"><i class="fa fa-plus fa-5x"></i></div></div>
                </a>
            </div>
        </div>
        
            <!--Why is this running 4 times-->
            <?php
            $pdo = new PDO("mysql:host=localhost;dbname=ab78751_the_doors;", "ab78751", "qIaz0~rjZ2xe");
            $dbs = $pdo->prepare('SELECT project_table.*, contact_table.* FROM project_table INNER JOIN contact_table on project_table.contact_id = contact_table.contact_id');
            $projects = array();

            if ($dbs->execute() && $dbs->rowCount() > 0) {
                $projects = $dbs->fetchAll(PDO::FETCH_ASSOC);

                foreach ($projects as $project) {
                    echo '<div class="tool_content edit_project" data-project="'.$project["project_id"].'"">';
                    echo '<h2 class="tool_name">'. $project["company_name"] . '</h2>';
                    echo '<div class="tool_body">';
                    
                    echo '<p>' . $project["project_name"] .'<br/>';
                    echo $project["company_address_line_one"] .'<br/>';
                    echo $project["company_address_line_two"] . '<br/>';
                    echo $project["company_city"] . ', ' . $project["company_state"] . " " . $project["company_zip"] . '</p>';

                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo 'No projects found';
            }
            ?>

        <script type="text/javascript" src="on_load.js"></script>

    </body>

</html>