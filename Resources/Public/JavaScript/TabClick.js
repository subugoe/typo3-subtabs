jQuery(document).ready(function () {

		// clicks outside the tab scope will close the tabsContentPlus panel
	jQuery('html').click(function(event) {
		var clicked = jQuery(event.target);

		if (!clicked.parents().hasClass('tabs') && jQuery('.tabsContentPlus').is(':visible')) {
			jQuery('.tabsContent').hide();
			jQuery('.tabElement.selected').removeClass('selected');
		}
		event.stopPropagation();
	});

	/**
	 * Darstellung der Tabs
	 * wenn geschlossen: false
	 * @author Ingo Pfennigstorf <pfennigstorf@sub.uni-goettingen.de>
	 */
	jQuery('.tabs').each(function () {
		var panels = jQuery(this).find('> div');
		var tabs = jQuery(this).find('> ul.tabNavigation a');

			// show additional stuff in focus
		jQuery('.tabs .tabElement').click(function () {

			jQuery('div.tabsContent').css('height', 'auto');

			if (this.id == 'tab-webseite' && document.getElementById('solrtab').value == '') {
				jQuery('div.tabsContent').css('height', '30px');
			}

			if (typeof(piwikTracker) != 'undefined' && this.text != 'undefined') {
				piwikTracker.trackPageView('Tab/' + this.text);
			}
			if (this.id !== 'tab-webseite') {
				jQuery('.tabsContentPlus').show();
			}
		});
		tabs.click(function () {
			klappeAuf(this, tabs, panels, jQuery('div.tabsContent'), jQuery('.tabsContentPlus'));
			return false;
		})
			// Wenn ein grosses headerbild vorhanden ist
		if (document.getElementById('bigpicture') !== null) {
			jQuery('#Katalog .tabsContent').addClass('tabsContentLarge').css('display', 'block');
			jQuery('#tab-katalog').addClass('selected');

			jQuery('.tabsContentPlus').hide();
				// Klick in die Tabs
			jQuery('.tabs input[type=search]').focus(function(){
				jQuery('.tabsContentPlus').show();
				jQuery('div.tabsContent').css('height', 'auto');
				if (this.id == 'solrtab' && this.value == '') {
					jQuery('div.tabsContent').css('height', '30px');
				}
				return false;
			})
			// small mode
		} else {
				// CSS des Tabinhalts setzen
			jQuery('#Katalog .tabsContent').addClass('tabsContentSmall');
				// Klick auf in die Tabs

			var $_GET = getQueryParams(document.location.search);
			if ($_GET['tx_solr[q]']) {
				jQuery('#tab-webseite').addClass('selected');
				jQuery('#tab-katalog').removeClass('selected').addClass('hover');
			}
			jQuery('.tabsContent').hide();
		}
		return false;
	});

		// Klick in die Katalogsuchradiobuttonfelder
	jQuery('#catalogueSearchForm input[type=radio]').click(function () {
		var link = jQuery("#catalogueSearchForm input:checked").val();
		jQuery(this).parent().parent().attr('action', link);
	});

		// Submit des Katalogsuchformulars
	jQuery('#catalogueSearchForm').submit(function () {
		var str = jQuery('input#mytextbox.field').val();
		var link = jQuery("#catalogueSearchForm input:checked").val();
		var get = encodeURIComponent(str);
		var url = link + get;

			// BIX bei Katalogsuche triggern
		if (jQuery('#katalog-2').attr('checked') == 'checked') {
			var bixPix = document.createElement('img');
			bixPix.setAttribute('src', 'http://dbspixel.hbz-nrw.de/count?id=AF007&page=2');
			window.open(url);
		} else {
			if (jQuery('#catalogueSearchForm input:checked').attr('class') === 'newWindow') {
				window.open(url);
			} else {
				location.href = url;
			}
		}
		return false;
	});

	/**
	* Auf- und Zuklappen der Tabs
	 *
	* @param klickObjekt
	* @param tabs
	* @param panels
	* @param tabsContent
	* @param tabsContentPlus
	*/
	function klappeAuf(klickObjekt, tabs, panels, tabsContent, tabsContentPlus) {
		tabsContent.show();
		tabsContentPlus.show();

			// Ist der Tab ausgewaehlt?
		if (klickObjekt.classList.contains('selected')) {
			searchTerm = jQuery(this);
				// Klasse selected entfernen
			jQuery(klickObjekt).removeClass('selected').addClass('hover');
			panels.hide();
		} else {
				// Nur noch hovern
			tabs.removeClass('selected').addClass('hover');
			jQuery(klickObjekt).addClass('selected').removeClass('hover');
			panels.hide().filter(klickObjekt.hash).show();
		}
		return false;
	}

	/**
	 * URI Encoding der Suchen
	 *
	 * @param qs
	 */
	function getQueryParams(qs) {
		qs = qs.split("+").join(" ");
		var params = {},
			tokens,
			re = /[?&]?([^=]+)=([^&]*)/g;
		while (tokens = re.exec(qs)) {
			params[decodeURIComponent(tokens[1])] = decodeURIComponent(tokens[2]);
		}
		return params;
	}
});