(function() {
  var collection, dataUrl, language, synonyms, sys_language_uid;

  language = jQuery(document).children("html").attr("lang");

  sys_language_uid = void 0;

  synonyms = {};

  collection = [];

  if (language === "de") {
    sys_language_uid = 0;
  } else {
    sys_language_uid = 1;
  }

  dataUrl = "/uploads/tx_subtabs/data-" + sys_language_uid + ".js";

  synonyms = function() {
    return jQuery.getJSON(dataUrl, function(faecherSammlungen) {
      var fach, i, j, subject, _results;
      i = 0;
      _results = [];
      while (i < faecherSammlungen.length) {
        subject = new Fachbereich();
        subject.set({
          title: faecherSammlungen[i].titel
        });
        j = 0;
        while (j < faecherSammlungen[i].faecher.length) {
          fach = new Fach();
          fach.set({
            title: faecherSammlungen[i].faecher[j].titel
          });
          fach.set({
            tags: faecherSammlungen[i].faecher[j].tags
          });
          subject.attributes.subjects.push(fach);
          j++;
        }
        collection.push(subject);
        _results.push(i++);
      }
      return _results;
    });
  };

}).call(this);

(function() {
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
    }).data("ui-autocomplete")._renderItem = function(ul, item) {
      return $("<li></li>").data("item.autocomplete", item).append("<a href=\"/index.php?id=" + tx_solr_uid + "&tx_solr[q]=" + item.value + "\">" + item.label + "</a>").appendTo(ul);
    };
  });

}).call(this);

(function() {
  var getQueryParams, klappeAuf;

  $(function() {
    "use strict";
    $('.tx-subtabs-tabs li').click = function(event) {
      var clicked;
      clicked = $(event.target);
      if (!clicked.parents().hasClass('tabs') && $('.tabsContentPlus').is(':visible')) {
        $('.tabsContent').hide();
        $('.tabElement.selected').removeClass('selected');
      }
      event.stopPropagation();
      return false;
    };
    $('.tx-subtabs-tabs input.field').change(function() {
      if ($(this).val().length >= 3) {
        sessionStorage.setItem('term', $(this).val().toLowerCase());
        $('.tx-subtabs-tabs input.field').each(function() {
          if (sessionStorage.getItem('term')) {
            return $(this).val(sessionStorage.getItem('term'));
          }
        });
      }
      return false;
    });
    $('.tabs').each(function() {
      var getParams, panels, tabs;
      panels = $(this).find('> div');
      tabs = $(this).find('> ul.tabNavigation a');
      $('.tabs .tabElement').click(function() {
        $('div.tabsContent').css('height', 'auto');
        if (this.id === 'tab-webseite' && ($('#WebseiteContentPlus').children('ul').val() === '' || document.getElementById('solrtab').value === '')) {
          $('div.tabsContent').css('height', '30px');
        }
        if (this.id === 'tab-webseite' && $('#solrtab').val() !== '') {
          $('#solrtab').keydown().focus();
          $('div.tabsContent').css('height', 'auto');
        }
        if (typeof piwikTracker !== 'undefined' && this.text !== 'undefined') {
          piwikTracker.trackPageView('Tab/' + this.text);
        }
        if (this.id !== 'tab-webseite') {
          return $('.tabsContentPlus').show();
        }
      });
      tabs.click(function() {
        return klappeAuf(this, tabs, panels, $('div.tabsContent'), $('.tabsContentPlus'));
      });
      if (document.getElementById('bigpicture') !== null) {
        $('#Katalog .tabsContent').addClass('tabsContentLarge').css('display', 'block');
        $('#tab-katalog').addClass('selected');
        $('.tabsContentPlus').hide();
        $('.tabs input[type=search]').focus(function() {
          $('.tabsContentPlus').show();
          $('div.tabsContent').css('height', 'auto');
          if (this.id === 'solrtab' && ($('#WebseiteContentPlus').children('ul').children('li').length === '' || this.value === '')) {
            return $('div.tabsContent').css('height', '30px');
          }
        });
      } else {
        $('#Katalog .tabsContent').addClass('tabsContentSmall');
        getParams = getQueryParams(document.location.search);
        if (getParams['tx_solr[q]']) {
          $('#tab-webseite').addClass('selected');
          $('#tab-katalog').removeClass('selected').addClass('hover');
        }
        $('.tabsContent').hide();
      }
      return false;
    });
    $('#catalogueSearchForm input[type=radio]').click(function() {
      var link;
      link = $("#catalogueSearchForm input:checked").val();
      return $(this).parent().parent().attr('action', link);
    });
    $('#catalogueSearchForm').submit(function() {
      var bixPix, get, link, str, url;
      str = $('input#mytextbox.field').val();
      link = $("#catalogueSearchForm input:checked").val();
      if ($('#katalog-4').attr('checked') === 'checked' || $('#katalog-5').attr('checked') === 'checked') {
        get = escape(str);
      } else {
        get = encodeURIComponent(str);
      }
      url = link + get;
      if ($('#katalog-2').attr('checked') === 'checked') {
        bixPix = document.createElement('img');
        bixPix.setAttribute('src', 'http://dbspixel.hbz-nrw.de/count?id=AF007&page=2');
        window.open(url);
      } else {
        if ($('#catalogueSearchForm input:checked').attr('class') === 'newWindow') {
          window.open(url);
        } else {
          location.href = url;
        }
      }
      return false;
    });
    return false;
  });

  klappeAuf = function(klickObjekt, tabs, panels, tabsContent, tabsContentPlus) {
    tabsContent.show();
    tabsContentPlus.show();
    if (klickObjekt.classList.contains('selected')) {
      $(klickObjekt).removeClass('selected').addClass('hover');
      panels.hide();
    } else {
      tabs.removeClass('selected').addClass('hover');
      $(klickObjekt).addClass('selected').removeClass('hover');
      panels.hide().filter(klickObjekt.hash).show();
    }
    return false;
  };

  getQueryParams = function(qs) {
    var params, re, tokens, _results;
    qs = qs.split("+").join(" ");
    params = {};
    re = /[?&]?([^=]+)=([^&]*)/g;
    _results = [];
    while ((tokens = re.exec(qs))) {
      _results.push(params[decodeURIComponent(tokens[1])] = decodeURIComponent(tokens[2]));
    }
    return _results;
  };

}).call(this);

(function() {
  var fachMatchesTerm, getAlleFaecher, getDefaultFaecherSammlungen, getTrefferErsteEbene, highlightTerms, localizations, notifyAboutNoResults, objectMatchesTerm, resultsFound, synonyme;

  $(document).ready(function() {
    "use strict";
    $("#q").bind("keypress", function(e) {
      if (e.keyCode === 13) {
        return false;
      }
    });
    $("#tab-faechersammlungen").click(function() {
      if (typeof synonyme === 'function') {
        synonyme();
      }
      if ($(this.id).find('.field').val() !== '') {
        return $('#q').keyup();
      }
    });
    $("#Faechersammlungen #q.field").keyup(function() {
      var arr, filter;
      if ($("#Faechersammlungen #q.field").val().length >= 3) {
        $("#Faechersammlungen .tabsContentPlus").show();
        $("#Faechersammlungen .tabsContent").css("height", "auto");
        filter = $(this).val();
        arr = $.each(synonyme, function(key, val) {
          return objectMatchesTerm(val.titel, filter);
        });
        if (arr.length > 0) {
          getTrefferErsteEbene(arr, filter);
          $("ul:empty").parent("li").css("background-image", "url(\"/typo3conf/ext/subtabs/Resources/Public/Icons/arrow_right_grey.png\")").children("a").addClass("noMatch").removeAttr("href").next("ul").remove();
          if (resultsFound() === false) {
            notifyAboutNoResults(0);
          }
        }
      } else {
        getDefaultFaecherSammlungen();
      }
      return false;
    });
    $("#mytextbox").keyup(function() {
      return $(this).val().length >= 3;
    });
    return false;
  });


  /*
  Notifies the user that no results are found
   */

  notifyAboutNoResults = function(matches) {
    var message, notificationContainer, notificationText, tabsContentContainer;
    notificationContainer = document.createElement("div");
    if (matches === 0) {
      message = localizations[sys_language_uid].noResults;
    } else {
      message = matches;
    }
    notificationText = document.createTextNode(matches);
    tabsContentContainer = document.getElementById("FaechersammlungenContentPlus");
    notificationContainer.setAttribute("class", "noResults");
    notificationContainer.appendChild(notificationText);
    tabsContentContainer.appendChild(notificationContainer);
    return false;
  };


  /*
  Zeige Treffer der ersten Ebene an und gib diese aus
   */

  getTrefferErsteEbene = function(arr, filter) {
    var liste;
    liste = document.createElement("ul");
    $.each(arr, function(schluessel, wert) {
      var linkElement, linkText, listenElement;
      listenElement = document.createElement("li");
      linkElement = document.createElement("a");
      linkText = document.createTextNode(wert.titel);
      linkElement.setAttribute("href", "/" + wert.seite);
      linkElement.appendChild(linkText);
      listenElement.appendChild(linkElement);
      listenElement.appendChild(getAlleFaecher(schluessel, wert, filter));
      return liste.appendChild(listenElement);
    });
    $("#Faechersammlungen .tabsContentPlus").html(liste);
    $(".tx-subtabs-fach").css("display", "inline");
    return false;
  };


  /*
  Standards fuer den unteren Teil des Faecher und Sammlungen Reiters
   */

  getDefaultFaecherSammlungen = function() {
    var standardListe;
    standardListe = document.createElement("ul");
    $.each(synonyme, function(key, val) {
      var linkElement, linkText, listenElement;
      listenElement = document.createElement("li");
      linkElement = document.createElement("a");
      linkText = document.createTextNode(val.titel);
      listenElement.setAttribute("class", "kat-" + key);
      linkElement.setAttribute("href", "/" + val.seite);
      linkElement.appendChild(linkText);
      listenElement.appendChild(linkElement);
      listenElement.appendChild(getAlleFaecher(key, val, ""));
      return standardListe.appendChild(listenElement);
    });
    $("#Faechersammlungen .tabsContentPlus").html(standardListe);
    return false;
  };


  /*
  Ausgabe aller Faecher
   */

  getAlleFaecher = function(oberfach, inhalt, filterTerm) {
    var rueckgabe;
    rueckgabe = document.createElement("ul");
    rueckgabe.setAttribute("id", "fach-" + oberfach);
    rueckgabe.setAttribute("class", "tx-subtabs-fach");
    $.each(inhalt.faecher, function(key, val) {
      var fachTermMatch, linkElement, linkText, listenElement, trefferListe;
      if (filterTerm.length > 2) {
        fachTermMatch = fachMatchesTerm(val, filterTerm);
        if (fachTermMatch.length !== 0) {
          listenElement = document.createElement("li");
          linkElement = document.createElement("a");
          linkText = document.createTextNode(val.titel);
          linkElement.appendChild(linkText);
          linkElement.setAttribute("href", "/" + val.seite);
          listenElement.appendChild(linkElement);
          listenElement.appendChild(document.createElement("br"));
          trefferListe = document.createElement("div");
          trefferListe.setAttribute("class", "trefferliste");
          $.each(fachTermMatch, function(schluessel, wert) {
            var is_last_item;
            wert = highlightTerms(wert, filterTerm);
            $(trefferListe).append(" " + wert);
            is_last_item = schluessel === (fachTermMatch.length - 1);
            if (!is_last_item) {
              return $(trefferListe).append(",");
            }
          });
          listenElement.appendChild(trefferListe);
          return rueckgabe.appendChild(listenElement);
        }
      }
    });
    return rueckgabe;
  };


  /*
  Auszeichnung des Suchbegriffs in den Trefferstrings
  
  @param line
  @param word
   */

  highlightTerms = function(treffer, filterTerm) {
    var regex;
    regex = new RegExp("(" + filterTerm + ")", "gi");
    return treffer.replace(regex, "<span class=\"highlight\">$1</span>");
  };


  /*
  Wenn das Objekt dem Suchterm entspricht
   */

  objectMatchesTerm = function(titel, filterTerm) {
    var result;
    result = titel.toLowerCase().indexOf(filterTerm) >= 0;
    if (!result) {
      result = false;
    }
    return result;
  };


  /*
  Abfrage auf den Unterelementen
  @todo non-blocking / async
   */

  fachMatchesTerm = function(fach, filterTerm) {
    var fachArray, result, tag, tagID;
    fachArray = [];
    tagID = void 0;
    tag = void 0;
    result = fach.titel.toLowerCase().indexOf(filterTerm) >= 0;
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
  };


  /*
  Retrieve all synonyms and save them globally
   */

  synonyme = function() {
    var dataUrl, language, sys_language_uid;
    language = $(document).children("html").attr("lang");
    sys_language_uid = void 0;
    if (language === "de") {
      sys_language_uid = 0;
    } else {
      sys_language_uid = 1;
    }
    dataUrl = "/uploads/tx_subtabs/data-" + sys_language_uid + ".js";
    return $.getJSON(dataUrl, function(data) {
      synonyme = data;
      return getDefaultFaecherSammlungen();
    });
  };


  /*
  tells us if there are any results
  
  @return {Boolean}
   */

  resultsFound = function() {
    if ($("a.noMatch").length === $("#Faechersammlungen .tabsContentPlus ul>li>a").length) {
      return false;
    } else {
      return true;
    }
  };


  /*
  Localizations used for the tabs
  
  @type {Object}
   */

  localizations = {
    0: {
      noResults: "Keine Treffer"
    },
    1: {
      noResults: "No results"
    }
  };

}).call(this);
