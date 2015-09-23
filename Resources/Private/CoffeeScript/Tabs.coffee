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
		$('.search_input').blur()
		$('.search').removeClass('-show-popup')

	$(document).bind 'keydown', (e) ->
		if e.keyCode is 27 # Esc
			if $('.search_input').val() is ''
				$(window).click()
			else
				$('.search_input').val('')

	$('.search_navigation a').click ->
		target = $(this).attr('href').split('#')[1]
		$parent = $(this).parent('li')
		$('.search_navigation li').not($parent).removeClass('-active')
		$parent.addClass('-active')
		$('.search_content, .search_form').not('.-' + target).removeClass('-visible')
		$('.search_content, .search_form').filter('.-' + target).addClass('-visible')
		$('.search_form.-' + target + ' input').focus()
		false
