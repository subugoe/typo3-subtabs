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

	$(window).click ->
		$('.search_close').click()

	$('.search_close').click ->
		$('.search_input').blur()
		$('.search').removeClass('-show-popup')
		false

	$(document).bind 'keydown', (e) ->
		if e.keyCode is 27 # Esc
			if $('.search_input:focus').length is 0 or $('.search_input').val() is ''
				$(window).click()
			else
				$('.search_input').val('').change()
			return false

	$('.search_navigation a').click ->
		target = $(this).attr('href').split('#')[1]
		$parent = $(this).parent('li')
		$('.search_navigation li').not($parent).removeClass('-active')
		$parent.addClass('-active')
		$('.search_content, .search_form').not('.-' + target).removeClass('-visible')
		$('.search_content, .search_form').filter('.-' + target).addClass('-visible')
		$('.search_form.-' + target + ' .search_input').focus()
		false

	$('.search_form.-catalog').submit ->
		str = $('#mytextbox').val()
		link = $('.search_content.-catalog :checked').val()

		if str is ':P'
			$('body,button,input,select,textarea').css('fontFamily', 'Comic Sans MS,' + $('body').css('fontFamily'))
			$('#mytextbox').val(';)')

		if link.indexOf('/ezeit/') isnt -1 or link.indexOf('/dbinfo/') isnt -1
			# Escape search string for EZB and DBIS that still lack UTF-8 support
			get = escape(str)
		else
			get = encodeURIComponent(str)
		url = link + get

		if $('.search_catalog-list input:checked').hasClass('-new-window')
			open = window.open(url)
			if (open is null || typeof(open) is 'undefined') then location.href = url
		else
			location.href = url
		false

	# Toggle catalog info
	$('.search_info-toggle').click ->
		$(this).siblings('.search_info-toggle').addBack().toggle()
		$(this).closest('.search_item').find('.search_info').slideToggle()
		false
