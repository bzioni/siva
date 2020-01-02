(function() {
    tinymce.PluginManager.add('sogo_lorem_ipsum', function( editor, url ) {
        editor.addButton('sogo_lorem_ipsum', {
            text: 'Lorem Ipsum',
            icon: false,
            onclick: function() {
                // change the shortcode as per your requirement
                editor.insertContent('לורם איפסום דולור סיט אמט, קונסקטורר אדיפיסינג אלית להאמית קרהשק סכעיט דז מא, מנכם למטכין נשואי מנורך. לפרומי בלוף קינץ תתיח לרעח. לת צשחמי צש בליא, מנסוטו צמלח לביקו ננבי, צמוקו בלוקריה שיצמה ברורק. ליבם סולגק. בראיט ולחת צורק מונחף, בגורמי מגמש. תרבנך וסתעד לכנו סתשם השמה - לתכי מורגם בורק? לתיג ישבעס.');
            }
        });
    });
})();