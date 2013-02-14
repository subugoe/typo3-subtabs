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
