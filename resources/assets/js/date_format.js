$(function() {
	moment.locale('lt');
	$('.date-when').each(function() {
		var date = $(this);
		date.text(moment(date.text(), 'YYYY-MM-DD hh:mm:ss')
			.tz('Europe/Vilnius')
			.fromNow()
			);
	})
});