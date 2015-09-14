
var form = document.querySelector('form');
console.log(form);
form.addEventListener('submit', checkForm);


//Set regexValidation for each field being passed from add_contact.php
var regexValidations = {
    "company": /^[a-zA-Z ]*$/,
    "address_one": /^\d{1,6}\040([A-Z]{1}[a-z]{1,}\040[A-Z]{1}[a-z]{1,})$|^\d{1,6}\040([A-Z]{1}[a-z]{1,}\040[A-Z]{1}[a-z]{1,}\040[A-Z]{1}[a-z]{1,})$|^\d{1,6}\040([A-Z]{1}[a-z]{1,}\040[A-Z]{1}[a-z]{1,}\040[A-Z]{1}[a-z]{1,}\040[A-Z]{1}[a-z]{1,})$/,
    "address_two": /[a-z0-9]/i,
    "city": /.*/,
    "state": /^[A-Z]{2}$/,
    "zip": /^\d{5}(?:[-\s]\d{4})?$/,
    "primary_contact": /^[a-zA-Z ]*$/,
    "primary_contact_phone": /^\(?([2-9]{1}[0-9]{2})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/,
    "primary_contact_email": /^[a-zA-Z0-9$]+[@]{1}[a-zA-Z]+[\.]{1}[a-zA-Z]{2,3}$/,
    "secondary_contact": /^[a-zA-Z ]*$/,
    "secondary_contact_phone": /^\(?([2-9]{1}[0-9]{2})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/,
    "secondary_contact_email": /^[a-zA-Z0-9$]+[@]{1}[a-zA-Z]+[\.]{1}[a-zA-Z]{2,3}$/
};

//Run this function on submit
function checkForm(e) {
    e.preventDefault();

    //set flag to help check validation
    var isValid = true;

   //if address two has a value, add the validator class, if not, remove the validator class
    if ($.trim($("input[name=address_two]").val()) != "") {
        $("input[name=address_two]").addClass('validate');
    }
    else{
        $("input[name=address_two]").removeClass('validate');
    }
    
    //if secondary contact has a value, add the validator class, if not, remove the validator class
    if ($.trim($("input[name=secondary_contact]").val()) != "") {
        $("input[name=secondary_contact]").addClass('validate');
    }
    else{
        $("input[name=secondary_contact]").removeClass('validate');
    }
    
    //if secondary contact phone has a value, add the validator class, if not, remove the validator class
    if ($.trim($("input[name=secondary_contact_phone]").val()) != "") {
        $("input[name=secondary_contact_phone]").addClass('validate');
    }
    else{
        $("input[name=secondary_contact_phone]").removeClass('validate');
    }
    
    //if secondary contact email has a value, add the validator class, if not, remove the validator class
    if ($.trim($("input[name=secondary_contact_email]").val()) != "") {
        $("input[name=secondary_contact_email]").addClass('validate');
    }
    else{
        $("input[name=secondary_contact_email]").removeClass('validate');
    }

    //for each field in the add contacts form on the add_contacts.php page with the validate class, see if the field is empty or fails regex validation
    //if so set the isValid flag to false and add the error class to signify an error to the user else remove the error class
    $('#add_contact .validate').each(function () {
        //$(this).length <= 0) ||          
        if ($(this).val() == "" || !regexValidations[this.name].test(this.value)) {
            $(this).parent().addClass('error');
            isValid = false;
        }
        else {
            $(this).parent().removeClass('error');
        }
    })

    //if the isValid flag gets set to false, alert the user else, send to php via ajax
    if (isValid == false) {
        alert("Please correct the missing fields.")
    }
    else {
        $.ajax({
            url: "tools/contacts/add_contact_db.php",
            type: "POST",
            dataType: "JSON",
            data: {company: $("input[name=company]").val(),
                address_one: $("input[name=address_one]").val(),
                address_two: $("input[name=address_two]").val(),
                city: $("input[name=city]").val(),
                states: $("select[name=states] option:selected").val(),
                zip: $("input[name=zip]").val(),
                primary_contact: $("input[name=primary_contact]").val(),
                primary_contact_phone: $("input[name=primary_contact_phone]").val(),
                primary_contact_email: $("input[name=primary_contact_email]").val(),
                secondary_contact: $("input[name=secondary_contact]").val(),
                secondary_contact_phone: $("input[name=secondary_contact_phone]").val(),
                secondary_contact_email: $("input[name=secondary_contact_email]").val()
            },
            //if ajax is successful, return to contacts main page and alert the user
            success: function (data) {
                console.log("success " + data);
                //window.open("http://www.google.com","_self");
                $("#content").load("tools/contacts/index.php", function () {
                    alert("Contact successfull added");
                });
            },
            //if ajax is unsuccessful, show response text in console
            error: function (data) {
                console.log(data.responseText);
            }
        });
    }

}





