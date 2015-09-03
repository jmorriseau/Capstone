

var insert = document.querySelector('#add_row');
insert.addEventListener('click',insertRow);

var del = document.querySelector('#delete_row');
del.addEventListener('click',deleteRow);



function insertRow() {
var table = document.getElementById("table_data");

var row = table.insertRow(-1);

var cell1 = row.insertCell(0);
var cell2 = row.insertCell(1);
var cell3 = row.insertCell(2);
var cell4 = row.insertCell(3);

cell1.innerHTML = "<input type='text'/>";
cell2.innerHTML = "<input type='text'/>";
cell3.innerHTML = "<input type='text'/>";
cell4.innerHTML = "<input type='text'/>";

};

function deleteRow() {

     document.getElementById("table_data").deleteRow(-1);




}




