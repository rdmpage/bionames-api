function display_reference(id, reference)
{
	var html = "";
	
	html += "<table class=\"table\">";
	html += "<tbody>";
	html += "<tr>";
	html += "<td style=\"text-align:center;width:100px;\">";
	if (reference.thumbnail)
	{
		html += "<img style=\"box-shadow:2px 2px 2px #ccc;width:64px;border:1px solid rgb(228,228,228);\" src=\"" + reference.thumbnail + "\">";
	}
	html += "</td>";
	
	html += "<td class=\"item-data\">";

	html += "<p>";
	html += "<a href=\"id/" + reference._id + "\">";
	html += reference.title;
	html += "</a>";
	html += "</p>";
	
	html += "<div>";
	
	if (reference.author)
	{
		var authors = [];
		
		for (var j in reference.author)
		{
			if (reference.author[j].name)
			{
				authors.push(reference.author[j].name);
			}
		}
		html += "by " + authors.join(", ") + "<br />";
		
	}
	
	if (reference.journal)
	{
		html += "Published in " + reference.journal.name;
		if (reference.journal.pages)
		{
			html += " pages <b>" + reference.journal.pages.replace(/--/, "-") + "</b>";
		}
		html += "<br />";
	}
	
	html += "</div>";
	
	html += "<span class=\"Z3988\" title=\"" + referenceToOpenUrl(reference) + "\"></span>";								
	
	if (reference.identifier)
	{
		html += "<div class=\"item-links\">";
		for (var j in reference.identifier)
		{
			switch (reference.identifier[j].type)
			{
				case "biostor":
					html += "<a href=\"http://biostor.org/reference/" + reference.identifier[j].id + "\" target=\"_new\"><i class=\"icon-external-link\"></i>biostor.org/reference/" + reference.identifier[j].id + "</a></li>";
					break;
					
				case "doi":
					html += "<a href=\"http://dx.doi.org/" + reference.identifier[j].id + "\" target=\"_new\"><i class=\"icon-external-link\"></i>dx.doi.org/" + reference.identifier[j].id + "</a></li>";
					break;

				case "handle":
					html += "<a href=\"http://hdl.handle.net/" + reference.identifier[j].id + "\" target=\"_new\"><i class=\"icon-external-link\"></i>hdl.handle.net/" + reference.identifier[j].id + "</a></li>";
					break;
					
				default:
					break;
			}
		}
		html += "</div>";
	}
	
	
	
	html += "</td>";
	html += "</tr>";	
	html += "</tbody>";
	html += "</table>";

	//$("#" + id).html(html);
	$(html).appendTo("#" + id);
}			
