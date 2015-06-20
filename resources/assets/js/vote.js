$("body").delegate('.vote-action', 'click', function (event) {
    console.log('click');
    var votable = $(this);
    
    var type = votable.attr('type');
    var id = votable.attr('id');
    var vote = votable.attr('vote');

    $.ajax({
        async: true,
        cache: false,
        type: "POST",
        error: function(xhr, status, error) {
          var err = eval(xhr.responseText);
          $(document).html(err);
        },
        url: "/balsuoti/" + vote + "/" + id + "/" + type
    }).done(function (data) {
        if(data == 'success')
        {
            if(vote == 'upvote')
            {
                var container = $('#votes-'+id+' .upvote-container .vote');
                if(container.hasClass('upvote-active'))
                {
                    container.removeClass('upvote-active').addClass('upvote');
                }
                else
                {
                    container.addClass('upvote-active').removeClass('upvote');
                    $('#votes-'+id+' .downvote-container .vote').removeClass('downvote-active').addClass('downvote');
                }
            }
            else
            {
                var container = $('#votes-'+id+' .downvote-container .vote');
                if(container.hasClass('downvote-active'))
                {
                    container.removeClass('downvote-active').addClass('downvote');
                }
                else
                {
                    container.addClass('downvote-active').removeClass('downvote');
                    $('#votes-'+id+' .upvote-container .vote').removeClass('upvote-active').addClass('upvote');
                }
            }
        }
    });

});