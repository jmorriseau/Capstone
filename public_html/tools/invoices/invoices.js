$(function () {
    for (var i = 0; i < 5; i++) {
        insertRow();
    }

    $(document).on("keyup", ".line_item_price", function () {
        calculateLineTotal();
    });

    $(document).on("keyup", ".line_item_quantity", function () {
        calculateLineTotal();
    });
});



var insert = document.querySelector('#add_row');
insert.addEventListener('click', insertRow);

var del = document.querySelector('#delete_row');
del.addEventListener('click', deleteRow);

var table = document.getElementById("table_data");

//insert a row at the bottom of the table
function insertRow(e) {
    if(e !== undefined){
    e.stopPropagation();
    e.preventDefault();
}

    $("#table_data tbody").append('<tr class="line_item">\n\
<td><input type="text" value="" class="create_invoice_input" /></td> \n\
<td><input type="text" value="" class="create_invoice_input line_item_price" /></td>\n\
<td><input class="line_item_quantity" type="text"/></td> \n\
<td><input class="line_item_total" type="text"/></td></tr>');

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

}

 function calculateLineTotal() {
     console.log($(".line_item").length);
     
            var subtotal = parseFloat(0);
            $(".line_item").each(function() {
                
                console.log($(this).find(".line_item_price").val());
     console.log($(this).find(".line_item_quantity").val());
                
                if($(this).find(".line_item_price").val() !== "" && $(this).find(".line_item_quantity").val() !== "") {
                    subtotal = parseFloat(subtotal) + (parseFloat($(this).find(".line_item_price").val()) * parseFloat($(this).find(".line_item_quantity").val()));
                    $(this).find(".line_item_total").val(subtotal.toFixed(2));
                    subtotal=parseFloat(0);
                }
                
            });
            
            // CalculateSubtotal function gets called and displays subtotal even if the conditions are not met
            // Do not display a subtotal of zero
//            if(subtotal != 0) {
//                $(".line_item_total",this).val(subtotal.toFixed(2));
////                calculateTotalTax();               
//            }
//            
        }