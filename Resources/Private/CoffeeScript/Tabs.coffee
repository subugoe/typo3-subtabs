$ ->
	$('.search_input').focus ->
		if $('.search.-show-popup').length
			return
		$('.search').addClass('-show-popup')
		if $('.search_navigation .-active').length is 0
			$('.search_navigation a:first').trigger('click', true)
		$('.search_content').css
			'min-height': $('.search_navigation').height() + 'px'

	$('.search_input').change ->
		$('.search_input').val( $(this).val() )

	$('.search, .main_left, .header_show-nav').click (e) ->
		e.stopPropagation()

	$(window).add('.search_close').click ->
		$('.search_input').blur()
		$('.search').removeClass('-show-popup')

	$(document).bind 'keydown', (e) ->
		if e.keyCode is 27 # Esc
			if $('.search_input').val() is ''
				$(window).click()
			else
				$('.search_input').val('').change()

	$('.search_navigation a').click ->
		target = $(this).attr('href').split('#')[1]
		$parent = $(this).parent('li')
		$('.search_navigation li').not($parent).removeClass('-active')
		$parent.addClass('-active')
		$('.search_content, .search_form').not('.-' + target).removeClass('-visible')
		$('.search_content, .search_form').filter('.-' + target).addClass('-visible')
		$('.search_form.-' + target + ' input').focus()
		false

	$('.search_content.-catalogue input[type=radio]').click ->
		link = $('.search_content.-catalogue input:checked').val()
		$('.search_form.-catalogue').attr('action', link)

	# submit the catalogue form
	$('.search_form.-catalogue').submit ->
		str = $('#mytextbox').val()
		link = $('.search_content.-catalogue input:checked').val()

		# todo necessary to escape dbis and ezb?
		if  $('#katalog-4').attr('checked') is 'checked' or $('#katalog-5').attr('checked') is 'checked'
			get = escape(str)
		else
			get = encodeURIComponent(str)
		url = link + get
		if $('.search_catalog-list label:first-child input:checked').length isnt 0 and window.location.hostname is 'www.sub.uni-goettingen.de'
			bixPix = document.createElement('img')
			bixPix.setAttribute('src', 'http://dbspixel.hbz-nrw.de/count?id=AF007&page=2')
			window.open(url)
		else
			if $('.search_catalog-list input:checked').hasClass('-new-window')
				window.open(url)
			else
				location.href = url
		false
	false

	# Toggle catalogue info
	$('.search_info-toggle').click ->
		$(this).siblings('.search_info-toggle').addBack().toggle()
		$(this).closest('.search_item').find('.search_info').slideToggle()
