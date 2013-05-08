function show_snippet (element_id, doc) {
	var html = '';
	
	html += '<div class="snippet">';
	
	

	switch (doc.type) {
		case 'article':
		case 'book':
		case 'chapter':
		case 'generic':
			// Publication snippet	
			html += '<a href="mockup_publication.php?id=' + doc._id + '">';
			if (doc.thumbnail) {
				html += '<img class="thumbnail" src="' + doc.thumbnail + '"/>';
			} else {
				html += '<div class="thumbnail_blank"></div>';
			}
						
			html += '<div class="details">';
			if (doc.title)
			{
				html += '<div class="title">' + doc.title + '</div>';
			}
			
			html += '<div class="metadata"><!-- begin metadata -->';
			
			html += '<div>';
			if (doc.author)
			{
				html += 'by ';
				for (var j in doc.author)
				{
					//html += '<a href="mockup_author.php?name=' + doc.author[j].name + '">'
					html += doc.author[j].name;
					//html += '</a>';
					html += '; ';
				}
			}
			html += '</div>';
			
			html += '<div>';
			if (doc.journal)
			{
				if (doc.journal.name)
				{
					html += '<span class="journal">' + doc.journal.name + '</span>';
				}
				if (doc.journal.volume)
				{
					html += ' ' + '<span class="volume">' + doc.journal.volume + '</span>';
				}
				if (doc.journal.issue)
				{
					html += '(' + doc.journal.issue + ')';
				}
				if (doc.journal.pages)
				{
					html += ' pages ' + doc.journal.pages;
				}
			}
			if (doc.year)
			{
				html += ' (' + doc.year + ')';
			}
			html += '</div>';
			
			if (doc.identifier)
			{
				html += '<ul class="identifier">';
				for (var j in doc.identifier)
				{
					switch (doc.identifier[j].type)
					{
						case "biostor":
							html += '<li>';
							//html += '<a href="http://biostor.org/reference/' + doc.identifier[j].id + '" target="_new">';
							html += 'biostor.org/reference/' + doc.identifier[j].id;
							//html += '</a>';
							html += '</li>';
							break;
		
						case "cinii":
							html += '<li>';
							//html += '<a href="http://ci.nii.ac.jp/naid/' + doc.identifier[j].id + '" target="_new">';
							html += 'ci.nii.ac.jp/naid/' + doc.identifier[j].id;
							//html += '</a>';
							html += '</li>';
							break;
							
						case "doi":
							html += '<li>';
							//html += '<a href="http://dx.doi.org/' + doc.identifier[j].id + '" target="_new">';
							html += 'dx.doi.org/' + doc.identifier[j].id;
							//html += '</a>';
							html += '</li>';
							break;
		
						case "handle":
							html += '<li>';
							//html += '<a href="http://hdl.handle.net/' + doc.identifier[j].id + '" target="_new">';
							html += 'hdl.handle.net/' + doc.identifier[j].id;
							//html += '</a>';
							html += '</li>';
							break;
		
						case "jstor":
							html += '<li>';
							//html += '<a href="http://www.jstor.org/stable' + doc.identifier[j].id + '" target="_new">';
							html += 'www.jstor.org/stable/' + doc.identifier[j].id;
							//html += '</a>';
							html += '</li>';
							break;
							
						default:
							break;
					}
				}	
				html += '</ul>';
			}
		
			
			html += '</div><!-- end metadata -->';
			html += '</a>';
			html += '</div>';
			break;
			
		case 'taxonConcept':
			html += '<div class="details">';
			html += '<a href="mockup_concept.php?id=' + doc._id + '">';
			if (doc.canonicalName)
			{
				html += '<div class="title">';
				html += doc.canonicalName;
				
				if (doc.author) {
					html += ' ' + doc.author;
				}
				
				html += '</div>';
			}
			html += '<div class="metadata"><!-- metadata -->';
			
			if (doc._id.match(/gbif/)) {
					html += '<div>' + 'According to GBIF';
					html += ' ' + doc._id.replace(/gbif\//, '');
					html += '<div style="float:right;"><img src="images/logo_leaf.gif" width="48"/></div>';
					html += '</div>';
			}									
			if (doc._id.match(/ncbi/)) {
					html += '<div>' + 'According to NCBI';
					html += ' ' + doc._id.replace(/ncbi\//, '');
					html += '<div style="float:right;"><img src="images/ncbi-twitter.jpg" width="48"/></div>';
					html += '</div>';
			}									
			
			
			html += '</div><!-- end metadata -->';
			html += '</a>';
			html += '</div>';
			break;
			
		default:
			break;
	}
	
	
	
	html += '<div style="clear:both;">';
	html += '</div>';
	
	$('#' + element_id).html(html);
}