var url = '/posts/index.json';

$(function() {
	$.timer(5000, function() {
		$.getJSON(url, function(data) {
			$.each(data function(i, item) {
				if ($('#post_' + item.Post.id).size() > 0) {
					return
				}
				
				element = $('#content .post:first').clone();
				$('.body', element).text(item.Post.text);
				// TODO: Finish copying across Mariano's stuff. 
			});
		});
	});
});