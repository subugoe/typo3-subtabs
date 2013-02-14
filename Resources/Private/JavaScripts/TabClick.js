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
    get = encodeURIComponent(str);
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
