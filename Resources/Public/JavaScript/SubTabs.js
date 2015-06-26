var $noResults, filterTimeout, filterVal, sys_language_uid;

$noResults = {
  0: $('<p class="search_no-results">Keine Treffer</p>'),
  1: $('<p class="search_no-results">No results</p>')
};

sys_language_uid = 0;

filterVal = '';

filterTimeout = null;

$(function() {
  var $target, language;
  language = $(document).children('html').attr('lang');
  sys_language_uid = (language === 'de' ? 0 : 1);
  $target = $('#Faechersammlungen');
  $("#tab-faechersammlungen").click(function() {
    if ($('.search_areas').length === 0) {
      return $target.loadSubjects("/uploads/tx_subtabs/data-" + sys_language_uid + ".js");
    } else {
      return $('#q').keyup();
    }
  });
  $("#q").bind('keypress', function(e) {
    if (e.keyCode === 13) {
      return false;
    }
  });
  return $('#q').keyup(function(e) {
    clearTimeout(filterTimeout);
    if (e.keyCode === 27) {
      $(this).val('');
    }
    if ($target.is(':hidden')) {
      return;
    }
    return filterTimeout = setTimeout((function(_this) {
      return function() {
        return $target.filterSubjects($(_this).val());
      };
    })(this), 100);
  });
});

$.fn.loadSubjects = function(url) {
  return this.each(function() {
    var $this;
    $this = $(this);
    $.getJSON(url, function(areas) {
      var $area, $areaLink, $areaList, $subject, $subjectLink, $subjectList, $tag, $tagList, area, subject, tag, _i, _j, _k, _len, _len1, _len2, _ref, _ref1;
      $areaList = $('<ul class="search_areas"/>');
      for (_i = 0, _len = areas.length; _i < _len; _i++) {
        area = areas[_i];
        $area = $("<li class='search_area'/>");
        $areaLink = $("<a><span class='search_title'>" + area.titel + "</span></a>");
        $areaLink.attr('href', area.seite);
        $area.append($areaLink);
        $subjectList = $('<ul class="search_subjects"/>').hide();
        _ref = area.faecher;
        for (_j = 0, _len1 = _ref.length; _j < _len1; _j++) {
          subject = _ref[_j];
          $subject = $("<li class='search_subject'/>");
          $subjectLink = $("<a><span class='search_title'>" + subject.titel + "</span></a>");
          $subjectLink.attr('href', subject.seite);
          $subject.append($subjectLink);
          $tagList = $('<ul class="search_tags"/>');
          _ref1 = subject.tags;
          for (_k = 0, _len2 = _ref1.length; _k < _len2; _k++) {
            tag = _ref1[_k];
            $tag = $("<li class='search_tag'><span class='search_title'>" + tag + "</span></li>");
            $tagList.append($tag);
          }
          $subject.append($tagList);
          $subjectList.append($subject);
        }
        $area.append($subjectList);
        $areaList.append($area);
      }
      $this.html($areaList);
      return $('#q').keyup();
    });
  });
};

$.fn.filterSubjects = function(val) {
  return this.each(function() {
    var $items, $this, tokens;
    $this = $(this);
    if (val === filterVal) {
      return;
    }
    tokens = val.toLowerCase().replace(/[\^$]/g, '').split(' ');
    filterVal = val;
    $items = $this.find('li');
    if (val.length > 2 && tokens !== ['']) {
      $this.clearHighlight();
      $items.each(function(index, item) {
        var show;
        show = true;
        $.each(tokens, function(index, token) {
          var $link, regexp;
          if ($(item).text().toLowerCase().indexOf(token) === -1) {
            show = false;
            return false;
          } else if (token > '') {
            $link = $(item).find('.search_title:first');
            regexp = new RegExp("(" + token + ")", "gi");
            $link.html($link.html().replace(regexp, '\^$1\$'));
          }
        });
        if (show) {
          $(item).show().parents('.search_tags, .search_subject, .search_subjects, .search_area').show();
        } else {
          $(item).hide();
        }
      });
      if ($items.filter(':visible').length === 0) {
        $this.append($noResults[sys_language_uid]);
      } else {
        $noResults[sys_language_uid].remove();
      }
      $this.html($this.html().replace(/\^/g, '<span class="search_highlight">').replace(/\$/g, '</span>'));
    } else {
      $this.clearHighlight();
      $items.filter('.search_area').show();
      $items.not('.search_area').hide();
      $noResults[sys_language_uid].remove();
    }
  });
};

$.fn.clearHighlight = function() {
  return this.each(function() {
    return $(this).find('.search_highlight').contents().unwrap();
  });
};

$(function() {
  "use strict";
  var sprache, sys_language_uid, tx_solr_suggestUrl, tx_solr_uid;
  tx_solr_uid = 1616;
  tx_solr_suggestUrl = "/?eID=tx_solr_suggest&id=" + tx_solr_uid;
  sprache = $(document).children("html").attr("lang");
  if (sprache === "de") {
    sys_language_uid = 0;
  } else {
    sys_language_uid = 1;
  }
  if (typeof autocomplete === 'function') {
    return $("#Webseite .tx-solr-q").autocomplete({
      source: function(request, response) {
        return $.ajax({
          type: "GET",
          url: tx_solr_suggestUrl,
          dataType: "json",
          data: {
            termLowercase: request.term.toLowerCase(),
            termOriginal: request.term,
            L: sys_language_uid
          },
          success: function(data) {
            var output, rs;
            rs = [];
            output = [];
            $.each(data, function(term, termIndex) {
              var unformatted_label;
              unformatted_label = term + " <span class=\"result_count\">(" + data[term] + ")</span>";
              return output.push({
                label: unformatted_label.replace(new RegExp("(?![^&;]+;)(?!<[^<>]*)(" + $.ui.autocomplete.escapeRegex(request.term) + ")(?![^<>]*>)(?![^&;]+;)", "gi"), "<span class=\"highlight\">$1</span>"),
                value: term
              });
            });
            $("#Webseite .tabsContent").css("height", "auto");
            response(output);
            return $('.ui-helper-hidden-accessible').css('display', 'none');
          }
        });
      },
      select: function(event, ui) {
        this.value = ui.item.value;
        return $(this).closest("form").submit();
      },
      delay: 0,
      minLength: 3,
      appendTo: "#WebseiteContentPlus"
    });
  }
});

$(function() {
  'use strict';
  $('.search_input').focus(function() {
    if ($('.search.-show-popup').length) {
      return;
    }
    $('.search').addClass('-show-popup');
    $('.search_navigation a:first').trigger('click', true);
    return $('.search_content').css('min-height', $('.search_navigation').height() + 'px');
  });
  $('.search, .main_left, .header_show-nav').click(function(e) {
    return e.stopPropagation();
  });
  $(window).click(function() {
    return $('.search').removeClass('-show-popup');
  });
  return $('.search_navigation a').click(function() {
    var $parent, id;
    id = $(this).attr('href').split('#')[1];
    $parent = $(this).parent('li');
    $('.search_navigation li').not($parent).removeClass('-active');
    $parent.addClass('-active');
    $('.search_content').not('#' + id).removeClass('-visible');
    $('#' + id).addClass('-visible');
    $('#q').focus();
    $('.search_submit').toggle(!$(this).hasClass('-hide-submit'));
    return false;
  });
});


/*
	$('.tx-subtabs-tabs li').click = (event) ->
		clicked = $(event.target)

		if !clicked.parents().hasClass('tabs') and $('.tabsContentPlus').is(':visible')
			$('.tabsContent').hide()
			$('.tabElement.selected').removeClass('selected')
		event.stopPropagation()
		false

	 * put search terms into local session storage
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
		 *	false

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
				 *false
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

	 * submit the catalogue form
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

 * show the subsection of a specified tab
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

 * get and decode query parameters
getQueryParams = (qs) ->
	qs = qs.split("+").join(" ")
	params = {}
	re = /[?&]?([^=]+)=([^&]*)/g
	while (tokens = re.exec(qs))
		params[decodeURIComponent(tokens[1])] = decodeURIComponent(tokens[2])
	 * false
 */
