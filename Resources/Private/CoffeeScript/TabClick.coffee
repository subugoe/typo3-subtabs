$ ->
	"use strict"
	$('.tx-subtabs-tabs li').click = (event) ->
		clicked = $(event.target)

		if !clicked.parents().hasClass('tabs') and $('.tabsContentPlus').is(':visible')
			$('.tabsContent').hide()
			$('.tabElement.selected').removeClass('selected')
		event.stopPropagation()
		false

	# put search terms into local session storage
	$('.tx-subtabs-tabs input.field').change ->
		if $(this).val().length >= 3
			sessionStorage.setItem('term', $(this).val().toLowerCase())
			$('.tx-subtabs-tabs input.field').each ->
				if sessionStorage.getItem('term')
					$(this).val(sessionStorage.getItem('term'))
		false

	$('.tabs').each ->
		panels = $(this).find('> div')
		tabs = $(this).find('> ul.tabNavigation a')

		$('.tabs .tabElement').click ->
			$('div.tabsContent').css('height', 'auto')

			if this.id is 'tab-webseite' and ($('#WebseiteContentPlus').children('ul').val() is '' or document.getElementById('solrtab').value is '')
				$('div.tabsContent').css('height', '30px')

			if this.id is 'tab-webseite' and $('#solrtab').val() isnt ''
				$('#solrtab').keydown().focus()
				$('div.tabsContent').css('height', 'auto')

			if typeof(piwikTracker) isnt 'undefined' and this.text isnt 'undefined'
				piwikTracker.trackPageView('Tab/' + this.text)

			if this.id isnt 'tab-webseite'
				$('.tabsContentPlus').show()
		#	false

		tabs.click ->
			klappeAuf(this, tabs, panels, $('div.tabsContent'), $('.tabsContentPlus'));

		if (document.getElementById('bigpicture') != null)
			$('#Katalog .tabsContent').addClass('tabsContentLarge').css('display', 'block')
			$('#tab-katalog').addClass('selected')

			$('.tabsContentPlus').hide()

			$('.tabs input[type=search]').focus ->
				$('.tabsContentPlus').show()
				$('div.tabsContent').css('height', 'auto');
				if this.id is 'solrtab' and ($('#WebseiteContentPlus').children('ul').children('li').length is '' or this.value is '')
					$('div.tabsContent').css('height', '30px')
				#false
		else
			$('#Katalog .tabsContent').addClass('tabsContentSmall')

			getParams = getQueryParams(document.location.search);
			if getParams['q']
				$('#tab-webseite').addClass('selected')
				$('#tab-katalog').removeClass('selected').addClass('hover')

			$('.tabsContent').hide()

		false

	$('#catalogueSearchForm input[type=radio]').click ->
		link = $("#catalogueSearchForm input:checked").val()
		$(this).parent().parent().attr('action', link)

	# submit the catalogue form
	$('#catalogueSearchForm').submit ->
		str = $('input#mytextbox.field').val()
		link = $("#catalogueSearchForm input:checked").val()
		if  $('#katalog-4').attr('checked') is 'checked' or $('#katalog-5').attr('checked') is 'checked'
			get = escape(str)
		else
			get = encodeURIComponent(str)
		url = link + get
		if $('#katalog-2').attr('checked') is 'checked'
			bixPix = document.createElement('img')
			bixPix.setAttribute('src', 'http://dbspixel.hbz-nrw.de/count?id=AF007&page=2')
			window.open(url)
		else
			if $('#catalogueSearchForm input:checked').attr('class') is 'newWindow'
				window.open(url)
			else
				location.href = url
		false;
	false

# show the subsection of a specified tab
klappeAuf = (klickObjekt, tabs, panels, tabsContent, tabsContentPlus) ->
	tabsContent.show()
	tabsContentPlus.show()

	if klickObjekt.classList.contains('selected')
		$(klickObjekt).removeClass('selected').addClass('hover')
		panels.hide()
	else
		tabs.removeClass('selected').addClass('hover')
		$(klickObjekt).addClass('selected').removeClass('hover')
		panels.hide().filter(klickObjekt.hash).show()
	false

# get and decode query parameters
getQueryParams = (qs) ->
	qs = qs.split("+").join(" ")
	params = {}
	re = /[?&]?([^=]+)=([^&]*)/g
	while (tokens = re.exec(qs))
		params[decodeURIComponent(tokens[1])] = decodeURIComponent(tokens[2])
	# false