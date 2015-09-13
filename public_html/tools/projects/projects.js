var regexValidations = {
    "company_name": /^[a-zA-Z ]*$/,
    "project_name": /^[a-zA-Z ]*$/,
    "invoice_number": /^[0-9]*$/
};

var uploads;

$(function () {
    $('input[type=file]').on('change', prepareUpload);
    $('form').on('submit', checkForm);
});

function checkForm(event) {
    event.stopPropagation();
    event.preventDefault();
    //console.log($("select[name=company_name] option:selected").val()); 

    var isValid = true;

    if ($.trim($("input[name=invoice_number]").val()) !== "") {
        $("input[name=invoice_number]").addClass('validate');
    }
    else {
        $("input[name=invoice_number]").removeClass('validate');
    }

    $('#add_project .validate').each(function () {
        //$(this).length <= 0) ||          
        if ($(this).val() === "" || !regexValidations[this.name].test(this.value)) {
            $(this).parent().addClass('error');
            isValid = false;
        }
        else {
            $(this).parent().removeClass('error');
        }
    });

    if (isValid === false) {
        alert("Please correct the missing fields.");
    }
    else {


        // Create a formdata object and add the files
        var data = new FormData();
        if (uploads) {
         
            $.each(uploads, function (key, value)
            {
                data.append(key, value);
            });
            console.log("big bubbles");
            $.ajax({
            url: "tools/projects/upload_photo.php?uploads",
            type: 'POST',
            data: data,
            cache: false,
            dataType: 'json',
            processData: false, // Don't process the files
            contentType: false,
            success: function (data, textStatus, jqXHR) {
                console.log("data");
                if (typeof data.error === 'undefined')
                {
                    // Success so call function to process the form
                    // submitForm(event, data);
                 submitForm();
                }
                else
                {
                    // Handle errors here
                    console.log('ERRORS: ' + data.error);
                }
            }
        });
            
        }
        else {
            submitForm();
        }



//        data.append("company_name", $("select[name=company_name] option:selected").val());
//        data.append("project_name", $("input[name=project_name]").val());
//        data.append("invoice_number", $("input[name=invoice_number").val());
        
        

        
    }
}


function prepareUpload(event)
{
    uploads = event.target.files;
    console.log(uploads);
}


function submitForm() {
console.log("here");
        $.ajax({
            url: "tools/projects/add_project_db.php",
            type: "POST",
            dataType: "JSON",
            data: {company_name: $("select[name=company_name] option:selected").val(),
                project_name: $("input[name=project_name]").val(),
                invoice_number: $("input[name=invoice_number").val(),
                fileToUpload: uploads[0].name
            },
            success: function (data) {
                console.log("success " + data);
                //window.open("http://www.google.com","_self");
//                $("#content").load("tools/projects/index.php", function () {
//                    alert("Project successfully added");
//                });
            },
            error: function (data) {
                console.log(data.responseText);
            }
        });
    }







