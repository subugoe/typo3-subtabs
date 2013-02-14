$ ->
	"use strict"
	tx_solr_uid = 1616
	tx_solr_suggestUrl = "/?eID=tx_solr_suggest&id=" + tx_solr_uid
	sprache = $(document).children("html").attr("lang")
	if sprache is "de"
		sys_language_uid = 0
	else
		sys_language_uid = 1

	# Change back to the old behavior of auto-complete
	# http://jqueryui.com/docs/Upgrade_Guide_184#Autocomplete
	$.ui.autocomplete::_renderItem = (ul, item) ->
		$("<li></li>").data("item.autocomplete", item).append("<a href=\"/index.php?id=" + tx_solr_uid + "&tx_solr[q]=" + item.value + "\">" + item.label + "</a>").appendTo ul

	$("#Webseite .tx-solr-q").autocomplete
		source: (request, response) ->
			$.ajax
				type: "GET"
				url: tx_solr_suggestUrl
				dataType: "json"
				data:
					termLowercase: request.term.toLowerCase()
					termOriginal: request.term
					L: sys_language_uid

				success: (data) ->
					rs = []
					output = []
					$.each data, (term, termIndex) ->
						unformatted_label = term + " <span class=\"result_count\">(" + data[term] + ")</span>"
						output.push
							label: unformatted_label.replace(new RegExp("(?![^&;]+;)(?!<[^<>]*)(" + $.ui.autocomplete.escapeRegex(request.term) + ")(?![^<>]*>)(?![^&;]+;)", "gi"), "<span class=\"highlight\">$1</span>")
							value: term

					$("#Webseite .tabsContent").css "height", "auto"
					response output
					$('.ui-helper-hidden-accessible').css('display', 'none')

		select: (event, ui) ->
			@value = ui.item.value
			$(this).closest("form").submit()

		delay: 0
		minLength: 3
		appendTo: "#WebseiteContentPlus"