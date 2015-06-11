function getMarkdown(body)
{
    var markdown_content;
    $.ajax({
        async: false,
        cache: false,
        type: "POST",
        dataType: "text",
        url: "/markdown",
        data: {
            'body': body
        }
    }).success(function (data) {
        if (data != 'false')
            markdown_content = data;
        else
            markdown_content = 'Įvyko klaida bandant peržiūrėti turinį!';

    });
    return markdown_content;
}