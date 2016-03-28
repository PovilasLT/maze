var $ = require('jquery');
var textcomplete = require('jquery-textcomplete');
var emojies = require('emoji_loader').emojies;

module.exports = function() {
    var at_users = [];

    var $users = $('.author');
    for (var i = 0; i < $users.length; i++) {
        var user = $users.eq(i).text().trim();
        if ($.inArray(user, at_users) == -1) {
            at_users.push(user);
        }

    }

    $('textarea').textcomplete([{
        mentions: at_users,
        match: /\B@(\w*)$/i,
        search: function (term, callback) {
            callback($.map(this.mentions, function (mention) {
                return mention.search(new RegExp(term, "i")) === 0 ? mention : null;
            }));
        },
        replace: function (mention) {
            return '@' + mention + ' ';
        },
        index: 1,
    	appendTo: 'body',
    }, { 
        match: /\B:([\-+\w]*)$/,
        search: function (term, callback) {
            callback($.map(emojies, function (emoji) {
                return emoji.indexOf(term) === 0 ? emoji : null;
            }));
        },
        template: function (value) {
            return '<img align="absmiddle" alt=":' + value + ':" class="emoji" src="/images/emoji/' + value + '.png" title=":' + value + ':"></img>'+value;
        },
        replace: function (value) {
            return ':' + value + ': ';
        },
        index: 1
    }], {
        maxCount: 10
    });
};