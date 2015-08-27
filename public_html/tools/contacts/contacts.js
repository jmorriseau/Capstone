
var form = document.querySelector('form');
console.log(form);
form.addEventListener('submit', checkForm);

var regexValidations = {
    "company": /^[a-zA-Z ]*$/,
    "address_one": /[0-9 a-zA-Z]+/,
    "address_two": /[0-9 a-zA-Z]+/,
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

function checkForm(e) {
    e.preventDefault();

    var isValid = true;

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
            success: function (data) {
                console.log("success " + data);
            },
            error: function (data) {
                console.log(data.responseText);
            }
        })
    }

}





