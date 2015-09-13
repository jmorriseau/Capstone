var insert = document.querySelector('#add_row');
insert.addEventListener('click',insertRow);

var del = document.querySelector('#delete_row');
del.addEventListener('click',deleteRow);

var table = document.getElementById("table_data");

function insertRow() {
//insert a row at the bottom of the table
var row = table.insertRow(-1);
//create the columns of the table
var cell1 = row.insertCell(0);
var cell2 = row.insertCell(1);
var cell3 = row.insertCell(2);
var cell4 = row.insertCell(3);
//insert text fields into the HTML
cell1.innerHTML = "<input type='text'/>";
cell2.innerHTML = "<input class='invoice_price' type='text'/>";
cell3.innerHTML = "<input class='invoice_quantity' type='text'/>";
cell4.innerHTML = "<input class='invoice_total' type='text'/>";


};

function deleteRow() {
    //if there is more than one row in the table then delete the last row
    if ($("#table_data tbody tr").length > 1) {
        $("#table_data tbody tr:last-child").remove();
    }

};