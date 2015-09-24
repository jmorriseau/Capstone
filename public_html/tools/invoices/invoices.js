// when the page loads, add 3 rows to the invoice table
$(function () {
    for (var i = 0; i < 3; i++) {
        insertRow();
    }

//    on key up run calc line total function
    $(document).on("keyup", ".line_item_price", function () {
        calculateLineTotal();
    });
//    on key up run cal line total function
    $(document).on("keyup", ".line_item_quantity", function () {
        calculateLineTotal();
    });
});


//set even listeners for add row and delete row
var insert = document.querySelector('#add_row');
insert.addEventListener('click', insertRow);

var del = document.querySelector('#delete_row');
del.addEventListener('click', deleteRow);

var table = document.getElementById("table_data");

//insert a row at the bottom of the table
function insertRow(e) {
    if (e !== undefined) {
        e.stopPropagation();
        e.preventDefault();
    }
    $("#table_data tbody").append('<tr class="line_item">\n\
<td><input type="text" value="" class="create_invoice_input" name="description" /></td> \n\
<td><input type="text" value="" class="create_invoice_input line_item_price" name="prince" /></td>\n\
<td><input class="line_item_quantity" type="text" name="quantity"/></td> \n\
<td><input class="line_item_total" type="text" readonly="readonly" name="line_total"/></td></tr>');
}
;

function deleteRow(e) {
    e.stopPropagation();
    e.preventDefault();
    console.log("pickles");
    console.log($("#table_data tbody tr").length);

    //if there is more than one row in the table then delete the last row
    if ($("#table_data tbody tr").length > 1) {
        $("#table_data tbody tr:last-child", document).remove();
    }

    calculateSubTotal();

}

function calculateLineTotal() {
    var lineTotal = parseFloat(0);
//            var subTotal = parseFloat(0);
    $(".line_item").each(function () {

        if ($(this).find(".line_item_price").val() !== "" && $(this).find(".line_item_quantity").val() !== "") {
            lineTotal = parseFloat(lineTotal) + (parseFloat($(this).find(".line_item_price").val()) * parseFloat($(this).find(".line_item_quantity").val()));
            $(this).find(".line_item_total").val(lineTotal.toFixed(2));
            lineTotal = parseFloat(0);
        }
        calculateSubTotal();
    });

}
function calculateSubTotal() {
    var sub_total = parseFloat(0);
    $(".line_item").each(function () {

        if ($(this).find(".line_item_total").val() !== "") {
            sub_total = parseFloat(sub_total) + (parseFloat($(this).find(".line_item_total").val()));
            $("#invoice_subtotal").val(sub_total.toFixed(2));
        }
        calculateTotalTax();
    });

}
function calculateTotalTax() {
    state_tax = parseFloat($("#tax_rate").val()) * 0.01;
    var total_tax = parseFloat(0);
    total_tax = total_tax + (parseFloat($("#invoice_subtotal").val()) * parseFloat(state_tax));
    $("#total_tax").val(parseFloat(total_tax).toFixed(2));
    calculateGrandTotal();
}
function calculateGrandTotal() {
    var grand_total = parseFloat(0);
    grand_total = grand_total + parseFloat($("#invoice_subtotal").val()) + parseFloat($("#total_tax").val());
    $("#grand_total").val(grand_total.toFixed(2));
}

$(function () {
    $("input[name=tax_exempt").on("click", function () {
        console.log($(this).is(":checked"));
    });

//when save invoice button is clicked send to db
    $("#save_invoice").on("click", function () {


        $.ajax({
            url: "tools/invoices/create_invoice_db.php",
            type: "POST",
            data: {
                date: $("input[name=date]").val(),
                contact_id: $("select[name=company_name]").val(),
                sub_total: $("input[name=sub_total]").val(),
                tax_rate: $("input[name=tax_rate]").val(),
                total_tax: $("input[name=total_tax]").val(),
                grand_total: $("input[name=grand_total]").val(),
                tax_exempt: $("input[name=tax_exempt]").attr("checked"),
                invoice_number: $("input[name=invoice_number]").val()
                        //paid: $("input[name=paid]").val()                              
            },
            dataType: "JSON",
            success: function (results) {
                console.log(results);
                $(".line_item").each(function() {
                    $.ajax({
                        url: "tools/invoices/create_line_item_db.php",
                        data: {
                            invoice_id: results,
                            decription: $("input[name=description]",this).val(),
                            price: $("input[name=price]",this).val(),
                            quantity: $("input[name=quantity]",this).val(),
                            line_total: $("input[name=line_total]",this).val()
                        },
                        type: "POST",
                        dataType: "JSON",
                        success: function (data) {
                            console.log(data);
//                            alert("Invoice successfully saved");
                        }
                    });
                });
            }
        });
    });
});


