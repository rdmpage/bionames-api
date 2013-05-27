function display_reference(data)
{
	var html = "";
	
	html += "<div class=\"pub\">";
	
	var has_thumbnail = false;
	if (data.thumbnail)
	{
		has_thumbnail = true;
		html += '<div class="thumbnail"><a href="mockup_publication.php?id=' + data._id + '"><img src="' + data.thumbnail + '" /></a></div>';
	}					
	if (data.thumbnail_url)
	{
		has_thumbnail = true;
		html += '<div class="thumbnail"><a href="mockup_publication.php?id=' + data._id + '"><img src="' + 'http://bionames.org/bionames-api/' + data.thumbnail_url + '" /></a></div>';
	}					
	
	if (!has_thumbnail)
	{
		html += '<div class="thumbnail"></div>';
	}
	
	html += '<div class="citation">'; // RMS
  
	if (data.title)
	{
		html += '<div class="title">' 
			+ '<a href="mockup_publication.php?id=' + data._id + '">'
			+ data.title 
			+ '</a>'
			+ '</div>';
		//document.title = data.title;
	}
						
	html += '<div class="meta">';
	
	
	html += '<div>';
	if (data.author)
	{
		html += 'by ';
		for (var j in data.author)
		{
			html += '<a href="mockup_author.php?name=' + data.author[j].name + '">'
			html += data.author[j].name;
			html += '</a>';
			html += '; ';
		}
	}
  
	if (data.journal)
	{
		if (data.journal.name)
		{
			html += '<span class="journal">' + data.journal.name + '</span>';
		}
		if (data.journal.volume)
		{
			html += ' ' + data.journal.volume;
		}
		if (data.journal.issue)
		{
			html += '(' + data.journal.issue + ')';
		}
		if (data.journal.pages)
		{
			html += ' pages ' + data.journal.pages;
		}
	}
	if (data.year)
	{
		html += ' (' + data.year + ')';
	}
	html += '</div>';
	
	if (data.identifier)
	{
		html += '<ul>';
		for (var j in data.identifier)
		{
			switch (data.identifier[j].type)
			{
				case "biostor":
					html += "<li><a href=\"http://biostor.org/reference/" + data.identifier[j].id + "\" target=\"_new\">biostor.org/reference/" + data.identifier[j].id + "</a></li>";
					break;

				case "cinii":
					html += "<li><a href=\"http://ci.nii.ac.jp/naid/" + data.identifier[j].id + "\" target=\"_new\">ci.nii.ac.jp/naid/" + data.identifier[j].id + "</a></li>";
					break;
					
				case "doi":
					html += "<li><a href=\"http://dx.doi.org/" + data.identifier[j].id + "\" target=\"_new\">dx.doi.org/" + data.identifier[j].id + "</a></li>";
					break;

				case "handle":
					html += "<li><a href=\"http://hdl.handle.net/" + data.identifier[j].id + "\" target=\"_new\">hdl.handle.net/" + data.identifier[j].id + "</a></li>";
					break;

				case "jstor":
					html += "<li><a href=\"http://www.jstor.org/stable" + data.identifier[j].id + "\" target=\"_new\">www.jstor.org/stable/" + data.identifier[j].id + "</a></li>";
					break;
					
				default:
					break;
			}
		}	
		html += '</ul>';
	}
  html += "</div>"; // RMS 
	html += "<span class=\"Z3988\" title=\"" + referenceToOpenUrl(data) + "\"></span>";		
	html += '</div>';

	return html;
}			
