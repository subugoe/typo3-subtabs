var Fach, Fachbereich, collection, dataUrl, language, synonyms, sys_language_uid;

Fachbereich = Backbone.Model.extend({
  defaults: {
    title: "",
    subjects: []
  }
});

Fach = Backbone.Model.extend({
  defaults: {
    title: "",
    tags: []
  }
});

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
