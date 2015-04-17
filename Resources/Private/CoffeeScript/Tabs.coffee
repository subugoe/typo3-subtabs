$(document).ready ->
	"use strict"
	$("#q").bind "keypress", (e) ->
		false if e.keyCode is 13


	# variable synonyme wird damit global nutzbar
	$("#tab-faechersammlungen").click ->
		if typeof synonyme is 'function'
			synonyme()
		if $(this.id).find('.field').val() isnt ''
			$('#q').keyup();

	# Eingabe in das Textfeld bei Faecher und Sammlungen
	$("#Faechersammlungen #q.field").keyup ->

		# nach der Eingabe des dritten Zeichens wird gesucht
		if $("#Faechersammlungen #q.field").val().length >= 3
			$("#Faechersammlungen .tabsContentPlus").show()
			$("#Faechersammlungen .tabsContent").css "height", "auto"

			# Eingabe in lower case konvertieren''
			filter = $(this).val()

			# Suche im Hauptobjekt nach dem eingegebenen Wert
			arr = $.each(synonyme, (key, val) ->
				objectMatchesTerm val.titel, filter
			)

			# Wenn es treffer gab ...
			if arr.length > 0
				getTrefferErsteEbene arr, filter
				$("ul:empty").parent("li").css("background-image", "url(\"/typo3conf/ext/subtabs/Resources/Public/Icons/arrow_right_grey.png\")").children("a").addClass("noMatch").removeAttr("href").next("ul").remove()
				notifyAboutNoResults(0) if resultsFound() is false

		else

			# ansonsten der Standard
			getDefaultFaecherSammlungen()
		false

	# Eingabe in das Textfeld der Kataloge
	$("#mytextbox").keyup ->
		$(this).val().length >= 3
	false

###
Notifies the user that no results are found
###
notifyAboutNoResults = (matches) ->
	notificationContainer = document.createElement("div")
	if matches is 0
		message = localizations[sys_language_uid].noResults
	else
		message = matches
	notificationText = document.createTextNode(matches)
	tabsContentContainer = document.getElementById("FaechersammlungenContentPlus")
	notificationContainer.setAttribute "class", "noResults"
	notificationContainer.appendChild notificationText
	tabsContentContainer.appendChild notificationContainer
	false

###
Zeige Treffer der ersten Ebene an und gib diese aus
###
getTrefferErsteEbene = (arr, filter) ->

	# Liste der Treffer zusammenbauen
	liste = document.createElement("ul")
	$.each arr, (schluessel, wert) ->
		listenElement = document.createElement("li")
		linkElement = document.createElement("a")
		linkText = document.createTextNode(wert.titel)
		linkElement.setAttribute "href", "/" + wert.seite
		linkElement.appendChild linkText
		listenElement.appendChild linkElement
		listenElement.appendChild getAlleFaecher(schluessel, wert, filter)
		liste.appendChild listenElement

	$("#Faechersammlungen .tabsContentPlus").html liste
	$(".tx-subtabs-fach").css "display", "inline"
	false


###
Standards fuer den unteren Teil des Faecher und Sammlungen Reiters
###
getDefaultFaecherSammlungen = ->
	standardListe = document.createElement("ul")
	$.each synonyme, (key, val) ->
		listenElement = document.createElement("li")
		linkElement = document.createElement("a")
		linkText = document.createTextNode(val.titel)
		listenElement.setAttribute "class", "kat-" + key
		linkElement.setAttribute "href", "/" + val.seite
		linkElement.appendChild linkText
		listenElement.appendChild linkElement
		listenElement.appendChild getAlleFaecher(key, val, "")
		standardListe.appendChild listenElement

	$("#Faechersammlungen .tabsContentPlus").html standardListe
	false

###
Ausgabe aller Faecher
###
getAlleFaecher = (oberfach, inhalt, filterTerm) ->
	rueckgabe = document.createElement("ul")
	rueckgabe.setAttribute "id", "fach-" + oberfach
	rueckgabe.setAttribute "class", "tx-subtabs-fach"
	$.each inhalt.faecher, (key, val) ->
		if filterTerm.length > 2
			fachTermMatch = fachMatchesTerm(val, filterTerm)
			if fachTermMatch.length isnt 0
				listenElement = document.createElement("li")
				linkElement = document.createElement("a")
				linkText = document.createTextNode(val.titel)
				linkElement.appendChild linkText
				linkElement.setAttribute "href", "/" + val.seite
				listenElement.appendChild linkElement
				listenElement.appendChild document.createElement("br")
				trefferListe = document.createElement("div")
				trefferListe.setAttribute "class", "trefferliste"

				# generiere Suchergebnisse innerhalb der Bereiche und stelle diese dar
				$.each fachTermMatch, (schluessel, wert) ->

					# Auszeichnung der gefundenen Stellen
					wert = highlightTerms(wert, filterTerm)
					$(trefferListe).append " " + wert
					is_last_item = (schluessel is (fachTermMatch.length - 1))
					$(trefferListe).append ","  unless is_last_item

				listenElement.appendChild trefferListe
				rueckgabe.appendChild listenElement

	rueckgabe


###
Auszeichnung des Suchbegriffs in den Trefferstrings

@param line
@param word
###
highlightTerms = (treffer, filterTerm) ->
	regex = new RegExp("(" + filterTerm + ")", "gi")
	treffer.replace regex, "<span class=\"highlight\">$1</span>"


###
Wenn das Objekt dem Suchterm entspricht
###
objectMatchesTerm = (titel, filterTerm) ->
	result = (titel.toLowerCase().indexOf(filterTerm) >= 0)
	result = false unless result
	result


###
Abfrage auf den Unterelementen
@todo non-blocking / async
###
fachMatchesTerm = (fach, filterTerm) ->
	fachArray = []
	tagID = undefined
	tag = undefined
	result = (fach.titel.toLowerCase().indexOf(filterTerm) >= 0)
	unless result
		for tagID of fach.tags
			tag = fach.tags[tagID]
			if tag.toLowerCase().indexOf(filterTerm) >= 0
				result = false
				fachArray.push tag
	else
		fachArray.push fach.titel
		for tagID of fach.tags
			tag = fach.tags[tagID]
			if tag.toLowerCase().indexOf(filterTerm) >= 0
				result = false
				fachArray.push tag
	fachArray


###
Retrieve all synonyms and save them globally
###
synonyme = ->
	language = $(document).children("html").attr("lang")
	sys_language_uid = undefined
	if language is "de"
		sys_language_uid = 0
	else
		sys_language_uid = 1
	dataUrl = "/uploads/tx_subtabs/data-" + sys_language_uid + ".js"

	# auslesen der JSON Daten
	$.getJSON dataUrl, (data) ->
		synonyme = data

		# Standardwerte in die Auswahlliste
		getDefaultFaecherSammlungen()


###
tells us if there are any results

@return {Boolean}
###
resultsFound = ->
	if $("a.noMatch").length is $("#Faechersammlungen .tabsContentPlus ul>li>a").length
		false
	else
		true


###
Localizations used for the tabs

@type {Object}
###
localizations =
	0:
		noResults: "Keine Treffer"
	1:
		noResults: "No results"
