//load these events

$(document).ready(function(){
	
	$("[id*='link_']").click(function(){
		var page = "";
		
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
                                
				
			case "link_invoices":
				page = "tools/invoices/index.html";
				break;

			case "link_email":
				page = "tools/email/index.html";
				break;
			
		}
		$("#content").load(page);
		
	})
	
	
	
	
	
	
	
})