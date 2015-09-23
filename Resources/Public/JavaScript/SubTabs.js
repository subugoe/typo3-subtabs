(function() {
  var $noResults, filterTimeout, filterVal, sys_language_uid;

  $noResults = {};

  sys_language_uid = 0;

  filterVal = '';

  filterTimeout = null;

  $(function() {
    var $target, language;
    language = $(document).children('html').attr('lang');
    sys_language_uid = (language === 'de' ? 0 : 1);
    $target = $('.search_content.-subjects');
    $('.search_tab.-subjects').click(function() {
      var noResults;
      if ($('.search_areas').length === 0) {
        noResults = language === 'de' ? 'Keine Treffer' : 'No results';
        $noResults = $("<p class=\"search_no-results\">" + noResults + "</p>").hide();
        $target.append($noResults);
        return $target.loadSubjects("/uploads/tx_subtabs/data-" + sys_language_uid + ".js");
      } else {
        return $('#q').keyup();
      }
    });
    $('#q').bind('keypress', function(e) {
      if (e.keyCode === 13) {
        return false;
      }
    });
    return $('#q').keyup(function(e) {
      clearTimeout(filterTimeout);
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
        var $area, $areaLink, $areaList, $subject, $subjectLink, $subjectList, $tag, $tagList, area, i, j, k, len, len1, len2, ref, ref1, subject, tag;
        $areaList = $('<ul class="search_areas"/>');
        for (i = 0, len = areas.length; i < len; i++) {
          area = areas[i];
          $area = $("<li class='search_area'/>");
          $areaLink = $("<a><span class='search_title'>" + area.titel + "</span></a>");
          $areaLink.attr('href', area.seite);
          $area.append($areaLink);
          $subjectList = $('<ul class="search_subjects"/>').hide();
          ref = area.faecher;
          for (j = 0, len1 = ref.length; j < len1; j++) {
            subject = ref[j];
            $subject = $("<li class='search_subject'/>");
            $subjectLink = $("<a><span class='search_title'>" + subject.titel + "</span></a>");
            $subjectLink.attr('href', subject.seite);
            $subject.append($subjectLink);
            $tagList = $('<ul class="search_tags"/>');
            ref1 = subject.tags;
            for (k = 0, len2 = ref1.length; k < len2; k++) {
              tag = ref1[k];
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
        $noResults.toggle($items.filter(':visible').length > 0);
        $this.html($this.html().replace(/\^/g, '<span class="search_highlight">').replace(/\$/g, '</span>'));
      } else {
        $this.clearHighlight();
        $items.filter('.search_area').show();
        $items.not('.search_area').hide();
        $noResults.hide();
      }
    });
  };

  $.fn.clearHighlight = function() {
    return this.each(function() {
      return $(this).find('.search_highlight').contents().unwrap();
    });
  };

}).call(this);

(function() {
  $(function() {
    $('.search_input').focus(function() {
      if ($('.search.-show-popup').length) {
        return;
      }
      $('.search').addClass('-show-popup');
      if ($('.search_navigation .-active').length === 0) {
        $('.search_navigation a:first').trigger('click', true);
      }
      return $('.search_content').css({
        'min-height': $('.search_navigation').height() + 'px'
      });
    });
    $('.search_input').change(function() {
      return $('.search_input').val($(this).val());
    });
    $('.search, .main_left, .header_show-nav').click(function(e) {
      return e.stopPropagation();
    });
    $(window).click(function() {
      $('.search_input').blur();
      return $('.search').removeClass('-show-popup');
    });
    $(document).bind('keydown', function(e) {
      if (e.keyCode === 27) {
        if ($('.search_input').val() === '') {
          return $(window).click();
        } else {
          return $('.search_input').val('');
        }
      }
    });
    return $('.search_navigation a').click(function() {
      var $parent, target;
      target = $(this).attr('href').split('#')[1];
      $parent = $(this).parent('li');
      $('.search_navigation li').not($parent).removeClass('-active');
      $parent.addClass('-active');
      $('.search_content, .search_form').not('.-' + target).removeClass('-visible');
      $('.search_content, .search_form').filter('.-' + target).addClass('-visible');
      $('.search_form.-' + target + ' input').focus();
      return false;
    });
  });

}).call(this);
