jQuery(document).ready(function () {

	jQuery('#q').bind('keypress', function(e) {
	  if (e.keyCode == 13) {
		  return false;
	  }
	});

		// variable synonyme wird damit global nutzbar
	if (typeof(synonyme) == 'undefined') {
		jQuery('#tab-faechersammlungen').click(function(){
			getSynonymListe();
		})
	}
			// Eingabe in das Textfeld bei Faecher und Sammlungen
	jQuery('#Faechersammlungen #q.field').keyup(function () {

			// nach der Eingabe des dritten Zeichens wird gesucht
		if (jQuery('#Faechersammlungen #q.field').val().length >= 3) {
			jQuery('#Faechersammlungen .tabsContentPlus').show();
			jQuery('#Faechersammlungen .tabsContent').css('height', 'auto');

			jQuery('#Faechersammlungen #q.field').change();

			jQuery('ul:empty')
				.parent('li')
				.css('background-image', 'url("/typo3conf/ext/subtabs/Resources/Public/Icons/arrow_right_grey.png")')
				.children('a')
				.addClass('noMatch')
				.removeAttr('href')
				.next('ul')
				.remove();
		} else {
				// ansonsten der Standard
			getDefaultFaecherSammlungen();
		}
	});

		// Inputfeld aendert sich oder Aenderung wird getriggert
	jQuery('#q.field').keyup(function () {

		if (jQuery(this).val().length >= 3) {
				
				// Eingabe in lower case konvertieren''
			var filter = jQuery(this).val().toLowerCase();

				// Suche im Hauptobjekt nach dem eingegebenen Wert
			var arr = jQuery.each(synonyme, function (key, val) {
				return objectMatchesTerm(val.titel, filter);
			});

				// Wenn es treffer gab ...
			if (arr.length > 0) {
				getTrefferErsteEbene(arr, filter);
				jQuery('ul:empty').parent('li')
				.css('background-image', 'url("/typo3conf/ext/subtabs/Resources/Public/Icons/arrow_right_grey.png")')
				.children('a')
				.css('color', '#dee1e7')
				.removeAttr('href')
				.next('ul')
				.remove();
			} else {
					// Falls kein Ergebnis vorhanden
					// @todo lokalisierung der fehlermeldungen
				jQuery('#Faechersammlungen .tabsContentPlus').html("Kein Ergebnis");
			}
		} else {
			getDefaultFaecherSammlungen();
		}
		return false;
	});

});

/**
 * Zeige Treffer der ersten Ebene an und gib diese aus
 */
function getTrefferErsteEbene(arr, filter) {

		// Liste der Treffer zusammenbauen
	var liste = document.createElement('ul');
		// @todo Realurl im JSON mit ausgeben
	jQuery.each(arr, function (schluessel, wert) {

		var listenElement = document.createElement('li');
		var linkElement = document.createElement('a');
		var linkText = document.createTextNode(wert.titel);

		linkElement.setAttribute('href', '/' + wert.seite);
		linkElement.appendChild(linkText);

		listenElement.appendChild(linkElement);
		listenElement.appendChild(getAlleFaecher(schluessel, wert, filter));

		liste.appendChild(listenElement);

	});

	jQuery('#Faechersammlungen .tabsContentPlus').html(liste);
	jQuery(".tx-subtabs-fach").css("display", "inline");
}

/**
 * Standards fuer den unteren Teil des Faecher und Sammlungen Reiters
 */
function getDefaultFaecherSammlungen() {

	var standardListe = document.createElement('ul');

	jQuery.each(synonyme, function (key, val) {

		var listenElement = document.createElement('li');
		var linkElement = document.createElement('a');
		var linkText = document.createTextNode(val.titel);

		listenElement.setAttribute('class', 'kat-' + key);
		linkElement.setAttribute('href', '/' + val.seite);
		linkElement.appendChild(linkText);

		listenElement.appendChild(linkElement);

		listenElement.appendChild(getAlleFaecher(key, val, ''));

		standardListe.appendChild(listenElement);
	});
	jQuery('#Faechersammlungen .tabsContentPlus').html(standardListe);

}

/**
 * Ausgabe aller Faecher
 */
function getAlleFaecher(oberfach, inhalt, filterTerm) {

	var rueckgabe = document.createElement('ul');
	rueckgabe.setAttribute('id', 'fach-' + oberfach);
	rueckgabe.setAttribute('class', 'tx-subtabs-fach');

	jQuery.each(inhalt.faecher, function (key, val) {

		if (filterTerm.length > 2) {
		var fachTermMatch = fachMatchesTerm(val, filterTerm);

			if (fachTermMatch.length !== 0) {

				var listenElement = document.createElement('li');
				var linkElement = document.createElement('a');
				var linkText = document.createTextNode(val.titel);

				linkElement.appendChild(linkText);
				linkElement.setAttribute('href', '/' + val.seite);
				listenElement.appendChild(linkElement);
				listenElement.appendChild(document.createElement('br'));

				var trefferListe = document.createElement('div');
				trefferListe.setAttribute('class', 'trefferliste');
					// generiere Suchergebnisse innerhalb der Bereiche und stelle diese dar
				jQuery.each(fachTermMatch, function (schluessel, wert) {

						// Auszeichnung der gefundenen Stellen
					wert = highlightTerms(wert, filterTerm);

					jQuery(trefferListe).append(' ' + wert);

					var is_last_item = (schluessel === (fachTermMatch.length - 1));

					if (!is_last_item) {
						jQuery(trefferListe).append(',');
					}

				});

				listenElement.appendChild(trefferListe);

				rueckgabe.appendChild(listenElement);
			}
		}
	});
	return rueckgabe;
}

/**
 * Auszeichnung des Suchbegriffs in den Trefferstrings
 *
 * @param line
 * @param word
 */
function highlightTerms(treffer, filterTerm) {
	var regex = new RegExp('(' + filterTerm + ')', 'gi');
	return treffer.replace(regex, '<span class="highlight">$1</span>');
}

/**
 * Wenn das Objekt dem Suchterm entspricht
 */
function objectMatchesTerm(titel, filterTerm) {
	var result = (titel.toLowerCase().indexOf(filterTerm) >= 0);
	if (!result) {
		result = false;
	}

	return result;
}

/**
 * Abfrage auf den Unterelementen
 * @todo non-blocking / async
 */
function fachMatchesTerm(fach, filterTerm) {
	var fachArray = new Array();
	var tagID, tag;
	var result = (fach.titel.toLowerCase().indexOf(filterTerm) >= 0);
	if (!result) {
		for (tagID in fach.tags) {
			tag = fach.tags[tagID];
			if (tag.toLowerCase().indexOf(filterTerm) >= 0) {
				result = false;
				fachArray.push(tag);
			}
		}
	} else {
		fachArray.push(fach.titel);
		for (tagID in fach.tags) {
			tag = fach.tags[tagID];
			if (tag.toLowerCase().indexOf(filterTerm) >= 0) {
				result = false;
				fachArray.push(tag);
			}
		}
	}
	return fachArray;
}

/**
 * Ausgabe der Synonyme
 */
function getSynonymListe() {

	var sprache =  jQuery(document).children('html').attr('lang');

	if (sprache == 'de') {
		var sys_language_uid = 0;

	} else {
		var sys_language_uid = 1;
	}

	var dataUrl = '/typo3temp/subtabs/data-' + sys_language_uid + '.js';

		// auslesen der JSON Daten
	jQuery.getJSON(dataUrl, function (data) {
		synonyme = data;

			// Standardwerte in die Auswahlliste
		getDefaultFaecherSammlungen();

	});
}
