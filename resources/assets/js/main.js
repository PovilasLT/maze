$(document).ready(function() {
	$('pre code').each(function(i, block) {
		hljs.highlightBlock(block);
	});

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
});