$(function() {

	var is_expanded = $('.is-expanded .parent-icon');

	var affix_sidebar = function() {
		// $('#sidebar-affix-container').css('height', window.innerHeight - $('.main-sidebar').offset().top).affix({
		//     offset: {     
		//       top: 82,
		//       bottom: $('footer').outerHeight(true) + 40
		//     }
		// });
	};

	if(is_expanded.length)
	{
		var is_expanded_id = is_expanded.attr('id');
		is_expanded.addClass('expanded')
		.removeClass('fa-plus')
		.addClass('fa-minus');
		$('.parent-node-collection-'+is_expanded_id).slideDown('fast', function() {
			affix_sidebar();
		});
	}
	else
	{
		affix_sidebar();
	}
	
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


	$('.show-status-comments').click(function() {

		var current = $(this);
		var status_id = current.attr('status-id');

		if(current.hasClass('active'))
		{
			$('#comments-'+status_id).slideUp();
			current.removeClass('active');
		}
		else
		{
			$('#comments-'+status_id).slideDown();
			current.addClass('active');
		}

	});
});