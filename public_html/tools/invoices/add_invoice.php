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
<!--pull all companies from contacts, set up table for invoice-->
            <p>
                <label>Company</label>
                <?php
                $company_selected = filter_input(INPUT_POST, 'companies');
                $pdo = new PDO("mysql:host=localhost;dbname=ab78751_the_doors;", "ab78751", "qIaz0~rjZ2xe");
                $dbs = $pdo->prepare('select * from contact_table');
                $companies = array();
                $dbs->execute();
                $companies = $dbs->fetchAll(PDO::FETCH_ASSOC);
                echo '<select name="company_name">';
                echo '<option value=" ">Select a Company</option>';
                foreach ($companies as $value) {
                    if ($company_selected == $value) {
                        echo '<option value="' . $value['contact_id'] . '" selected="selected">' . $value['company_name'] . '</option>';
                    } else {
                        echo '<option value="' . $value['contact_id'] . '">' . $value['company_name'] . '</option>';
                    }
                }
                echo '</select>';
                ?>
            </p>

            <p>	
                <label>Invoice Number:</label>
                <input name="invoice_number" class="validate" type="text" value="" placeholder="123" maxlength="10" />
                <span class="hide">*</span>
            </p>

            <p>
                <label>Date</label>
                <input type="date" id="date" name="date">
                <span class="hide">*</span>
            </p>

            <p>
            <table id="table_data">
                <thead>
                    <tr>
                        <th>Description</th>
                        <th>Price</th> 
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>

                <tbody>
                </tbody>

                <tfoot>
                    <tr>
                        <td>
                            <button id="add_row">
                                <i class="fa fa-plus">Add Additional Items</i>
                            </button>
                        </td>
                        <td>
                            <button id="delete_row">
                                <i class="fa fa-plus">Delete Last Item</i>
                            </button>
                        </td>
                        <td>Subtotal</td>                         
                        <td>
                            <div class="input_group">
                                <div class="input_group_addon">
                                    <i class="fa fa-usd"></i>                                                          
                                </div>
                                <input type="text" id="invoice_subtotal" name="sub_total" readonly="readonly" value="" />

                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>Tax Rate</td>
                        <td>
                            <div class="input_group">
                                <div class="input_group_addon"><strong>%</strong></div>
                                <input type="text" id="tax_rate" name="tax_rate" value="7.00" />
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>Total Tax</td>
                        <td>
                            <div class="input_group">
                                <div class="input_group_addon">
                                    <i class="fa fa-usd"></i>
                                </div>
                                <input type="text" id="total_tax"name="total_tax" readonly="readonly" value=""/>
                            </div>
                        </td>                    
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>Grand Total</td>
                        <td>
                            <div class="input_group">
                                <div class="input_group_addon">
                                    <i class="fa fa-usd"></i>
                                </div>
                                <input type="text" id="grand_total" name="grand_total" readonly="readonly" value=""/>
                            </div>
                        </td>                    
                    </tr>
                    <tr style="text-align:right">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <input type="button" id="save_invoice" value="Save Invoice" />
                        </td>                    
                    </tr>
                </tfoot>
            </table>

        <p>
            <input type="checkbox" name="tax_exempt" value=""  />Tax Exempt<br/>    
        </p>

        <input type="submit" name="submit_send" value="Save and Send" />


    </form>

    <script type="text/javascript" src="tools/invoices/invoices.js"></script>

</body>

</html>