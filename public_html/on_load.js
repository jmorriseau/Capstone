//load these events 

$(document).ready(function(){
	
	$("[id*='link_']").click(function(){
		var page = "";
		
                //handle all links to main pages
		switch(this.id){
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
		
	})
	
	
	
	
	
	
	
})