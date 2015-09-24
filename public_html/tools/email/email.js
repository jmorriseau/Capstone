
var form = document.querySelector('form');
//add event listen to the forms submit button
form.addEventListener('submit', checkForm);


//set regex validation
var regexValidations = {
    "email_subject": /[a-z0-9]/i,
    "email_message": /[a-z0-9]/i
};

//check the form
function checkForm(e) {
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
            data: {
                contact_id: $("select[name=company_name] option:selected").val(),
                email_subject: $("input[name=email_subject]").val(),
                email_message: $("textarea[name=email_message]").val()
            },
            success: function (data) {
                if (data !== "") {
                    alert(data);
                }

                else {
                    $("#content").load("tools/email/index.php", function () {
                        alert("Email successfully added");
                    });
                }
            },
            error: function (data) {
                console.log(data.responseText);
            }
        })
    }

}





