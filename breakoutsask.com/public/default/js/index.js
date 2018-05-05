$(document).ready(function () {
    $('#calendar').eCalendar();
	
	$('#calendar').eCalendar({
        url: 'https://www.google.co.in/',
		events: [
			{title: 'Breakout', description: 'Description 1', url: 'https://www.google.co.in/', datetime: new Date(2016, 01, 1, 17)},
			{title: 'Breakout', description: 'Description 2', url: 'https://www.google.co.in/', datetime: new Date(2016, 01, 2, 15)},
			{title: 'Breakout', description: 'Description 1', url: 'https://www.google.co.in/', datetime: new Date(2016, 01, 3, 17)},
			{title: 'Breakout', description: 'Description 2', url: 'https://www.google.co.in/', datetime: new Date(2016, 01, 4, 15)},
			{title: 'Breakout', description: 'Description 1', url: 'https://www.google.co.in/', datetime: new Date(2016, 01, 5, 17)},
			{title: 'Breakout', description: 'Description 2', url: 'https://www.google.co.in/', datetime: new Date(2016, 01, 6, 15)},
			{title: 'Breakout', description: 'Description 1', url: 'https://www.google.co.in/', datetime: new Date(2016, 01, 7, 17)},
			{title: 'Breakout', description: 'Description 2', url: 'https://www.google.co.in/', datetime: new Date(2016, 01, 8, 15)},
			{title: 'Breakout', description: 'Description 2', url: 'https://www.google.co.in/', datetime: new Date(2016, 01, 9, 15)}
		]
	});	
	
});