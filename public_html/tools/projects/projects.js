
var form = document.querySelector('form');
console.log(form);
form.addEventListener('submit', checkForm);



var regexValidations = {
    "company_name": /^[a-zA-Z ]*$/,
    "project_name": /^[a-zA-Z ]*$/,
    "invoice_number": /^[0-9]*$/
};


function checkForm(e) {
    
    console.log($("select[name=company_name] option:selected").val());
    e.preventDefault();

    var isValid = true;

   
    if ($.trim($("input[name=invoice_number]").val()) != "") {
        $("input[name=invoice_number]").addClass('validate');
    }
    else{
        $("input[name=invoice_number]").removeClass('validate');
    }
    
    

    $('#add_project .validate').each(function () {
        //$(this).length <= 0) ||          
        if ($(this).val() == "" || !regexValidations[this.name].test(this.value)) {
            $(this).parent().addClass('error');
            isValid = false;
        }
        else {
            $(this).parent().removeClass('error');
        }
    })

    if (isValid == false) {
        alert("Please correct the missing fields.")
    }
    else {
        $.ajax({
            url: "tools/projects/add_project_db.php",
            type: "POST",
            dataType: "JSON",
            data: {company_name: $("select[name=company_name] option:selected").val(),
                project_name: $("input[name=project_name]").val(),
                invoice_number: $("input[name=invoice_number").val()                          
            },
            success: function (data) {
                console.log("success " + data);
                //window.open("http://www.google.com","_self");
                $("#content").load("tools/projects/index.php", function () {
                    alert("Project successfull added");
                });
            },
            error: function (data) {
                console.log(data.responseText);
            }
        })
    }

}





