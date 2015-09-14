
var form = document.querySelector('form');
console.log(form);
form.addEventListener('submit', checkForm);



var regexValidations = {
    "company_name": /^[a-zA-Z ]*$/,
    "email_subject": /[a-z0-9]/i,
    "email_message": /[a-z0-9]/i
};


function checkForm(e) {
     console.log($("select[name=company_name] option:selected").val());
     console.log($("input[name=email_subject]").val());
     console.log($("textarea[name=email_message]").val());
    e.preventDefault();

    var isValid = true;

    $('#add_email .validate').each(function () {
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
            url: "tools/email/add_email_db.php",
            type: "POST",
            dataType: "JSON",
            data: {company_name: $("select[name=company_name] option:selected").val(),
                email_subject: $("input[name=email_subject]").val(),
                email_message: $("textarea[name=email_message]").val()
            },
            success: function (data) {
                console.log("success " + data);
                //window.open("http://www.google.com","_self");
                $("#content").load("tools/email/index.php", function () {
                    alert("Email successfully added");
                });
            },
            error: function (data) {
                console.log(data.responseText);
            }
        })
    }

}





