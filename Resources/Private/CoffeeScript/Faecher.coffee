$noResults = {}
sys_language_uid = 0
filterVal = ''
filterTimeout = null

$ ->
	language = $(document).children('html').attr('lang')
	sys_language_uid = (if language is 'de' then 0 else 1)
	$target = $('.search_content.-subjects')

	$('.search_tab.-subjects').click ->
		if $('.search_areas').length is 0
			noResults = if language is 'de' then 'Keine Treffer' else 'No results'
			$noResults = $("<p class=\"search_no-results\">#{noResults}</p>").hide()
			$target.append($noResults)
			$target.loadSubjects("/uploads/tx_subtabs/data-#{sys_language_uid}.js")
		else
			$('#q').keyup()

	$('#q').bind 'keypress', (e) ->
		if e.keyCode is 13 # Return
			return false

	$('#q').keyup (e) ->
		clearTimeout(filterTimeout)

		if $target.is(':hidden')
			return

		filterTimeout = setTimeout( =>
			$target.filterSubjects($(this).val())
		, 100)

$.fn.loadSubjects = (url) -> return this.each ->
	$this = $(this)

	$.getJSON url, (areas) ->

		$areaList = $('<ul class="search_areas"/>')
		for area in areas
			$area = $("<li class='search_area'/>")
			$areaLink = $("<a><span class='search_title'>#{area.titel}</span></a>")
			$areaLink.attr('href', area.seite)
			$area.append($areaLink)

			$subjectList = $('<ul class="search_subjects"/>').hide()
			for subject in area.faecher
				$subject = $("<li class='search_subject'/>")
				$subjectLink = $("<a><span class='search_title'>#{subject.titel}</span></a>")
				$subjectLink.attr('href', subject.seite)
				$subject.append($subjectLink)

				$tagList = $('<ul class="search_tags"/>')
				for tag in subject.tags
					$tag = $("<li class='search_tag'><span class='search_title'>#{tag}</span></li>")

					$tagList.append($tag)

				$subject.append($tagList)
				$subjectList.append($subject)

			$area.append($subjectList)
			$areaList.append($area)

		$this.html($areaList)
		$('#q').keyup()

	return

$.fn.filterSubjects = (val) -> return this.each ->
	$this = $(this)

	if val is filterVal then return

	tokens = val.toLowerCase().replace(/[\^$]/g, '').split(' ')
	filterVal = val
	$items = $this.find('li')

	if val.length > 2 and tokens != ['']

		$this.clearHighlight()
		$items.each (index, item) ->
			show = true
			$.each tokens, (index, token) ->
				if $(item).text().toLowerCase().indexOf(token) == -1
					show = false
					return false
				else if token > ''
					$link = $(item).find('.search_title:first')
					regexp = new RegExp("(#{token})", "gi")
					$link.html( $link.html().replace(regexp, '\^$1\$') )
				return
			if show
				$(item)
					.show()
					.parents('.search_tags, .search_subject, .search_subjects, .search_area')
						.show()
			else
				$(item).hide()
			return

		$noResults.toggle($items.filter(':visible').length > 0)

		$this.html(
			$this.html()
				.replace(/\^/g, '<span class="search_highlight">')
				.replace(/\$/g, '</span>')
		)

	else

		$this.clearHighlight()
		$items.filter('.search_area').show()
		$items.not('.search_area').hide()
		$noResults.hide()

	return

$.fn.clearHighlight = -> return this.each ->
	$(this).find('.search_highlight').contents().unwrap()
