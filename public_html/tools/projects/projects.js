$(function(){
    $(".delete_project").on('click',function(e){
        e.stopPropagation();
        e.preventDefault();
        var project_id = $(this).data("delete");
        $.ajax({
            url: "tools/projects/delete_project_db.php?pid=" + project_id,
            dataType: "JSON",
            method: "GET",
            success: function (data) {
                console.log("success " + data);
                $("#content").load("tools/projects/index.php", function () {
                    alert("Project successfully deleted");
                });
            }
        });
    });
});


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

    var isValid = true;

    if ($.trim($("input[name=invoice_number]").val()) !== "") {
        $("input[name=invoice_number]").addClass('validate');
    }
    else {
        $("input[name=invoice_number]").removeClass('validate');
    }

    //Do we need to validate the notes?
//    if ($.trim($("input[name=project_notes]").val()) !== "") {
//        $("input[name=project_notes]").addClass('validate');
//    }
//    else {
//        $("input[name=project_notes]").removeClass('validate');
//    }

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

    }
}


function prepareUpload(event)
{
    uploads = event.target.files;
    console.log(uploads);
}

//fileToUpload bombs when there is no index
function submitForm() {
    console.log(uploads);
    var file;
    if (uploads !== undefined) {
        file = uploads[0].name;
        console.log(uploads[0].name);
    }
    else {
        file = null;
    }

    var url;
    var company_name;
    var action;
    if ($(".submit_form").hasClass("Add")) {
        url = "tools/projects/add_project_db.php";
        company_name = $("select[name=company_name] option:selected").val();
        action= "Add";
    }
    else {
        url = "tools/projects/edit_project_db.php";
        company_name = $("input[name=company_selected]").val();
        action = "Edit";
    }
    $.ajax({
        url: url,
        type: "POST",
        dataType: "JSON",
        data: {company_name: company_name,
            project_name: $("input[name=project_name]").val(),
            invoice_number: $("input[name=invoice_number]").val(),
            project_notes: $("textarea[name=project_notes]").val(),
            fileToUpload: file,
            project_id: $("input[name=project_id]").val()
        },
        success: function (data) {
            console.log("success " + data);
            $("#content").load("tools/projects/index.php", function () {
                if(action == "Add"){
                    alert("Project successfully added");
                }
                else if (action == "Edit"){
                    alert("Project successfully edited");
                }
            });
        },
        error: function (data) {
            console.log(data.responseText);
        }
    });
}







