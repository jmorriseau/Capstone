//load these events 

$(document).ready(function () {

    //run search company function when search icon is clicked
    $("#search_icon").on("click", function () {
        searchCompany($("#search_input").val());
    });

    //run seack company function when alphabet letter is clicked
    $("#alphabet_search li").on("click", function () {
        searchCompany($(this).html());
    });


    $("[id*='link_']").click(function () {
        var page = "";

        //handle all links to main pages
        switch (this.id) {
            case "link_index":
                page = "index.php #content";
                break;
                
            case "link_contacts":
                page = "tools/contacts/index.php";
                break;
            case "link_add_contact":
                page = "tools/contacts/add_contact.php";
                break;

            case "link_projects":
                page = "tools/projects/index.php";
                break;
            case "link_add_project":
                page = "tools/projects/add_project.php";
                break;
            case "link_add_photos":
                page = "#";
                break;
            case "link_add_photo_notes":
                page = "#";
                break;


            case "link_invoices":
                page = "tools/invoices/index.php";
                break;
            case "link_add_invoice":
                page = "tools/invoices/add_invoice.php";
                break;

            case "link_email":
                page = "tools/email/index.php";
                break;
            case "link_add_email":
                page = "tools/email/add_email.php";
                break;
            case "link_browse_emails":
                page = "tools/email/browse_emails.php?$company_name";
                break;

        }
        $("#content").load(page);



    });

    function searchCompany(name) {
        // test to make sure not empty
        if (name !== "") {

            $.ajax({
                url: "php/search_company_db.php",
                type: "POST",
                dataType: "JSON",
                data: {
                    company_name: name
                },
                //if ajax is successful, return to contacts main page and alert the user
                success: function (data) {

                    var display_results;
                    $(data).each(function () {
                        display_results += '<div class="tool_content edit_contact" data-contact="' + this.contact_id + '">' +
                                '<h2 class="tool_name">' + this.company_name + '</h2>' +
                                '<div class="tool_body">' +
                                '<p>' + this.company_address_line_one + '<br/>' +
                                this.company_address_line_two + '<br/>' +
                                this.company_city + ', ' + this.company_state + " " + this.company_zip + '</p>' +
                                '<p>' + this.primary_contact + '<br />' +
                                this.primary_contact_phone + '<br />' +
                                this.primary_contact_email + '</p>' +
                                '<p>' + this.secondary_contact + '<br />' +
                                this.secondary_contact_phone + '<br />' +
                                this.secondary_contact_email + '</p>' +
                                '</div>' +
                                '</div>';
                        $(document).on("click", ".edit_contact", function () {
                            var contact_id = $(this).data("contact");
                            $("#content").load("tools/contacts/add_contact.php?cid=" + contact_id);
                        });

                    });

                    $("#content").html("" + display_results);
                },
                //if ajax is unsuccessful, show response text in console
                error: function (data) {
                    console.log(data.responseText);
                }
            });

        }

    }

});