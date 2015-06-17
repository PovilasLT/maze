$( document ).ready(function() {
    var at_users = [], user;

    $users = $('.media-heading').find('a.author');
    for (var i = 0; i < $users.length; i++) {
        user = $users.eq(i).text().trim();
        if ($.inArray(user, at_users) == -1) {
            at_users.push(user);
        }

    }

    $('textarea').textcomplete([{
        mentions: at_users,
        match: /\B@(\w*)$/,
        search: function (term, callback) {
            callback($.map(this.mentions, function (mention) {
                return mention.indexOf(term) === 0 ? mention : null;
            }));
        },
        index: 1,
        replace: function (mention) {
            return '@' + mention + ' ';
        }
    }], {
        appendTo: 'body'
    });
});