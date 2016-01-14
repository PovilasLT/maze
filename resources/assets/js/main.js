$(document).ready(function() {

	$('pre code').each(function(i, block) {
		hljs.highlightBlock(block);
	});

	var create_reply_form = $('#create-reply-form');
	if(create_reply_form.length)
	{
		create_reply_form.affix({
			offset: {     
		      top: create_reply_form.offset().top,
		      bottom: $('footer').outerHeight(true)
		    }
		});
	}

	$('#toggle-sidebar').click(function() {
	var main_content = $('.main-content');
	var main_sidebar = $('.main-sidebar');
	var footer = $('footer');

	if(main_content.hasClass('is_visible'))
	{
		footer.hide();
		$(window).off('.affix');
		$('#sidebar-affix-container').removeClass('affix affix-top affix-bottom').removeData('affix');
		main_content.slideUp('', function() {
			main_sidebar.removeClass('hidden-xs').removeClass('hidden-sm');
			footer.show();
		}).removeClass('is_visible');
	}
	else
	{
		footer.hide();
		main_content.slideDown('', function() {
			main_sidebar.addClass('hidden-xs').addClass('hidden-sm');
			footer.show();
		}).addClass('is_visible');
	}
	});

	$('[data-toggle="tooltip"]').tooltip();

	$('.toggle-front-page-node').on('click', function() {
		$.ajax({
			url: $('.node-list').data('update-url'),
			method: 'post',
			dataType: 'json',
			data: {
				node_id: $(this).data('node'),
				state: $(this).is(':checked') ? 'on' : 'off'
			}
		});
	});
	$('.edit-front-page-nodes').on('click', function (e) {
		var edit_btn = $(this);

		if(edit_btn.data('active')) {
			edit_btn.data('active', 0).css('color', '');
			$('.toggle-front-page-node').addClass('hidden');
		}
		else {
			edit_btn.data('active', 1).css('color', '#27AE60');
			$('.toggle-front-page-node').removeClass('hidden');				
		}

		e.preventDefault();
	});
});