<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="tools/invoices/main.css" />
		<link rel="stylesheet" type="text/css" href="images/css/font-awesome.css" />
	</head>
<body>

	<div class="tool_header">
		<h2>Please select an invoice below to begin.</h2>
	</div>
	
	<div class="tool_content">		
		<div id="link_add_invoice">
                    <a href="#">
                        <div class="tool_name">Add Invoice</div>
                        <div class="tool_body"><div class="icon"><i class="fa fa-plus fa-5x"></i></div></div>
                    </a>
		</div>
	</div>
    
            <?php
            //pull back all invoices 
            $pdo = new PDO("mysql:host=localhost;dbname=ab78751_the_doors;", "ab78751", "qIaz0~rjZ2xe");
            $dbs = $pdo->prepare('SELECT invoice_table.*, contact_table.* FROM invoice_table INNER JOIN contact_table on invoice_table.contact_id = contact_table.contact_id');
            $invoices = array();

            if ($dbs->execute() && $dbs->rowCount() > 0) {
                $invoices = $dbs->fetchAll(PDO::FETCH_ASSOC);
                foreach($invoices as $invoice){
                    echo '<div class="tool_content">';                   
                    echo '<h2 class="tool_name">'. $invoice["company_name"] . '</h2>';
                    echo '<div class="tool_body">';
                    
                    echo '<p>' . $invoice["number"] . '<br />';
                    echo $invoice["invoice_date_created"] . '<br />';
                    echo $invoice["inovice_blob"] . '</p>';
                     
                    echo '</div>';
                    echo '</div>';
                }
                
            }else {
                echo 'No invoices found';
            }
            ?>

<script type="text/javascript" src="on_load.js"></script>

</body>

</html>