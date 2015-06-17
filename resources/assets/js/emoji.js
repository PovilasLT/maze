$( document ).ready(function() {
    emojify.setConfig({
        blacklist: {
                        'ids': [],
                        'classes': ['no-emojify'],
                        'elements': ['script', 'textarea', 'pre', 'code']
                    },
        tag_type: null,
        only_crawl_id: null,
        img_dir: '/images/emoji/',
        ignore_emoticons: false,
        mode: 'data-uri'
    });
    emojify.run(document.getElementById('content'));
});