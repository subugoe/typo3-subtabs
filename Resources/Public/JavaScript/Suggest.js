jQuery(document).ready(function(){

	var tx_solr_uid = 1616

	var tx_solr_suggestUrl = '/?eID=tx_solr_suggest&id=' + tx_solr_uid;

	var sprache =  jQuery(document).children('html').attr('lang');
	if (sprache == 'de') {
		sys_language_uid = 0;
	} else {
		sys_language_uid = 1;
	}

	// Change back to the old behavior of auto-complete
	// http://jqueryui.com/docs/Upgrade_Guide_184#Autocomplete
	jQuery.ui.autocomplete.prototype._renderItem = function( ul, item ) {
			return jQuery( '<li></li>' )
				.data( 'item.autocomplete', item )
				.append( '<a href="/index.php?id=' + tx_solr_uid + '&tx_solr[q]=' + item.value + '">' + item.label + '</a>' )
				.appendTo(ul);
	};

	jQuery('#Webseite .tx-solr-q').autocomplete({
			source: function(request, response) {
				jQuery.ajax({
					type: 'GET',
					url: tx_solr_suggestUrl,
					dataType: 'json',
					data: {
						termLowercase: request.term.toLowerCase(),
						termOriginal: request.term,
						L: sys_language_uid
					},
					success: function(data) {
						var rs     = [],
							output = [];

						jQuery.each(data, function(term, termIndex) {
							var unformatted_label = term + ' <span class="result_count">(' + data[term] + ')</span>';
							output.push({
								label : unformatted_label.replace(new RegExp('(?![^&;]+;)(?!<[^<>]*)(' +
											jQuery.ui.autocomplete.escapeRegex(request.term) +
											')(?![^<>]*>)(?![^&;]+;)', 'gi'), '<span class="highlight">$1</span>'),
								value : term
							});
						});
						jQuery('#Webseite .tabsContent').css('height', 'auto');
						response(output);
					}
				})
			},
			select: function(event, ui) {
				this.value = ui.item.value;
				jQuery(this).closest('form').submit();
			},
			delay: 0,
			minLength: 3,
			appendTo: '#WebseiteContentPlus'
		});
});