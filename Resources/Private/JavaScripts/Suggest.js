
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
  $.ui.autocomplete.prototype._renderItem = function(ul, item) {
    return $("<li></li>").data("item.autocomplete", item).append("<a href=\"/index.php?id=" + tx_solr_uid + "&tx_solr[q]=" + item.value + "\">" + item.label + "</a>").appendTo(ul);
  };
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
});
