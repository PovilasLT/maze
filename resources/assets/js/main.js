$(document).ready(function() {
	$('pre code').each(function(i, block) {
		hljs.highlightBlock(block);
	});

	$('#toggle-sidebar').click(function() {
	var main_content = $('.main-content');
	var main_sidebar = $('.main-sidebar');

	if(main_content.hasClass('is_visible'))
	{
		main_content.slideUp('', function() {
			main_sidebar.removeClass('hidden-xs').removeClass('hidden-sm');
		}).removeClass('is_visible');
	}
	else
	{
		main_content.slideDown('', function() {
			main_sidebar.addClass('hidden-xs').addClass('hidden-sm');
		}).addClass('is_visible');
	}
	});
});