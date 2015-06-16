$(function() {
	$('.parent-icon').click(function() {
		
		var current = $(this);
		var id = current.attr('id');

		if(!current.hasClass('expanded'))
		{
			$('.parent-node-collection-'+id).slideDown('fast');
			current.addClass('expanded')
			.removeClass('fa-plus')
			.addClass('fa-minus');
		}
		else 
		{
			$('.parent-node-collection-'+id).slideUp('fast');
			current.removeClass('expanded')
			.removeClass('fa-minus')
			.addClass('fa-plus');
		}
	});
});