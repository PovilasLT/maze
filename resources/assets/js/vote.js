$("body").delegate('.vote-action', 'click', function (event) {
    var votable = $(this);

    // console.log('click');
    
    var type = votable.attr('type');
    var id = votable.attr('id');
    var vote = votable.attr('vote');

    $.ajax({
        async: true,
        cache: false,
        type: "POST",
        url: "/balsuoti/" + vote + "/" + type + "/" + id
    }).done(function(data) {
        if(data == 'auth required')
        {
            window.location.href = '/prisijungti';
        }
        else
        {
            do_vote();
        }
    });
    
    function do_vote() {

        var container = null;
        var counter = $('#votes-'+id+' .vote-count-container span');
        if(vote == 'upvote')
        {
            // console.log('upvote');
            container = $('#votes-'+id+' .upvote-container .vote');
            if(container.hasClass('upvote-active'))
            {
                counter.text(parseInt(counter.text()) - 1);
                container.removeClass('upvote-active').addClass('upvote');
            }
            else
            {
                var downvote_container = $('#votes-'+id+' .downvote-container .vote');
                if(downvote_container.hasClass('downvote-active'))
                {
                    counter.text(parseInt(counter.text()) + 2);
                }
                else
                {
                    counter.text(parseInt(counter.text()) + 1);
                }
                container.addClass('upvote-active').removeClass('upvote');
                downvote_container.removeClass('downvote-active').addClass('downvote');
            }
        }
        else
        {
            // console.log('downvote');
            container = $('#votes-'+id+' .downvote-container .vote');
            if(container.hasClass('downvote-active'))
            {
                counter.text(parseInt(counter.text()) + 1);
                container.removeClass('downvote-active').addClass('downvote');
            }
            else
            {
                var upvote_container = $('#votes-'+id+' .upvote-container .vote');
                if(upvote_container.hasClass('upvote-active'))
                {
                    counter.text(parseInt(counter.text()) - 2);
                }
                else
                {
                    counter.text(parseInt(counter.text()) - 1);
                }
                container.addClass('downvote-active').removeClass('downvote');
                upvote_container.removeClass('upvote-active').addClass('upvote');
            }
        }

        if(parseInt(counter.text()) > 0)
        {
            counter.removeAttr('class').attr('class', 'positive');
        }
        else if(parseInt(counter.text()) < 0)
        {
            counter.removeAttr('class').attr('class', 'negative');
        }
        else
        {
            counter.removeAttr('class').attr('class', 'neutral');
        }
    }

});