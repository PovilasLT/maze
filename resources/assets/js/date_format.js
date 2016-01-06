
var maze_format_date = function() {
	moment.locale('lt');
	$('.date-when').each(function() {
		var date = $(this);
		var current_date = $('.current-date-invisible').text();
		current_date = new Date(current_date);
		var moment_obj = moment(date.text(), 'YYYY-MM-DD hh:mm:ss');
		var date_text = moment_obj.from(current_date);
		date.text(date_text);
	});
};

maze_format_date();