$ ->
	'use strict'

	# Tab navigation
	$('.search_input').focus ->
		if $('.search.-show-popup').length then return
		$('.search').addClass('-show-popup')
		$('.search_navigation a:first').trigger('click', true)
		$('.search_content').css('min-height', $('.search_navigation').height() + 'px')

	$('.search, .main_left, .header_show-nav').click (e) ->
		e.stopPropagation()

	$(window).click ->
		$('.search').removeClass('-show-popup')

	$('.search_navigation a').click ->
		id = $(this).attr('href').split('#')[1]
		$parent = $(this).parent('li');
		$('.search_navigation li').not($parent).removeClass('-active')
		$parent.addClass('-active')
		$('.search_content').not('#' + id).removeClass('-visible')
		$('#' + id).addClass('-visible')
		$('#q').focus()
		$('.search_submit').toggle(! $(this).hasClass('-hide-submit'))
		false
