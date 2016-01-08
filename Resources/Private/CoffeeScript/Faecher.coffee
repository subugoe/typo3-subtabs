$areaList = {}
$noResults = {}
sys_language_uid = 0
filterVal = ''
filterTimeout = null

$ ->
	language = $(document).children('html').attr('lang')
	sys_language_uid = (if language is 'de' then 0 else 1)
	$target = $('.search_content.-subjects')

	$('.search_tab.-subjects').click ->
		unless $areaList.length
			$areaList = $('<ul class="search_areas"/>')
			$areaList.loadSubjects("/uploads/tx_subtabs/data-#{sys_language_uid}.js")
			$target.prepend($areaList)
			noResults = if language is 'de' then 'Keine Treffer' else 'No results'
			$noResults = $("<p class=\"search_no-results\">#{noResults}</p>").hide()
			$target.prepend($noResults)
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
			$areaList.filterSubjects($(this).val())
		, 100)

$.fn.loadSubjects = (url) -> return this.each ->
	$this = $(this)

	$.getJSON url, (areas) ->

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
			$this.append($area)

		$('#q').keyup()

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
				# This early check is much cheaper than regex below
				if $(item).text().toLowerCase().indexOf(token) is -1
					show = false
					return false

				if token > ''
					$link = $(item).find('.search_title:first')
					$html = $link.html()
					regex = new RegExp("(#{token})", "gi")
					$newHtml = $html.replace(regex, '\^$1\$')
					# Check again as .text() concatenates all children and thus
					# could have lead to false positives
					if $html isnt $newHtml
						$link.html( $newHtml )
					else
						show = false
						return false

			if show
				$(item).show().parents().show()
			else
				$(item).hide()

			return

		$noResults.toggle($items.filter(':visible').length is 0)

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
