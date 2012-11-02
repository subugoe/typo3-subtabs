Fachbereich = Backbone.Model.extend(defaults:
  title: ""
  subjects: []
)
Fach = Backbone.Model.extend(defaults:
  title: ""
  tags: []
)
language = jQuery(document).children("html").attr("lang")
sys_language_uid = undefined
synonyms = {}
collection = []
(if language is "de" then sys_language_uid = 0 else sys_language_uid = 1)
dataUrl = "/uploads/tx_subtabs/data-" + sys_language_uid + ".js"

# get Json data and put it into models
synonyms = -> jQuery.getJSON dataUrl, (faecherSammlungen) ->

  # iterate over JSON DATA
  i = 0

  while i < faecherSammlungen.length
    subject = new Fachbereich()
    subject.set title: faecherSammlungen[i].titel

    # get sub properties
    j = 0

    while j < faecherSammlungen[i].faecher.length
      fach = new Fach()
      fach.set title: faecherSammlungen[i].faecher[j].titel
      fach.set tags: faecherSammlungen[i].faecher[j].tags
      subject.attributes.subjects.push fach
      j++
    collection.push subject
    i++