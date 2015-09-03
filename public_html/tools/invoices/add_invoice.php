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

                $pdo = new PDO("mysql:host=localhost;dbname=the_doors; port=3306;", "root", "");

                $dbs = $pdo->prepare('select * from contact_table');
                $companies = array();
                $dbs->execute();
                $companies = $dbs->fetchAll(PDO::FETCH_ASSOC);

                echo '<select name="company_name">';
                echo '<option value=" ">Select a Company</option>';
                foreach ($companies as $value) {
                    if ($company_selected == $value) {
                        echo '<option value="' . $value['company_name'] . '" selected="selected">' . $value['company_name'] . '</option>';
                    } else {
                        echo '<option value="' . $value['company_name'] . '">' . $value['company_name'] . '</option>';
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

            <p>
                <label>Date</label>
                <input type="date" id="date">
                <span class="hide">*</span>
            </p>

            <p>
            <table id="table_data">
                <tr id="header_row">
                    <th>Description</th>
                    <th>Price</th> 
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
                <tr id="main_row">
                    <td><input name="description_1" class="validate" value="" type="text" maxlength="150"</td>
                    <td><input name="price_1" class="validate" value="" type="number" maxlength="99"</td> 
                    <td><input name="quantity_1" class="validate" value="" type="number" maxlength="99"</td>
                    <td><input name="total_1" class="validate" value="" type="number" maxlength="99"</td>
                
                </tr>
                
            </table>
            <input type="button" id="add_row" value="Add Additional Items"/>
            <input type="button" id="delete_row" value="Delete Last Item"/>
        </p>

        <p>
            <input type="checkbox" name="tax_exempt" value="">Tax Exempt<br/>    
        </p>


        <input type="submit" name="submit_save" value="Update/Save" />
        <input type="submit" name="submit_send" value="Save and Send" />


    </form>

    <script type="text/javascript" src="tools/invoices/invoices.js"></script>

</body>

</html>