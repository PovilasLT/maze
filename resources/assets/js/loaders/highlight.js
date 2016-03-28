var $ = require('jquery');
var hljs = require('highlight.js');

module.exports = function() {
	$('pre code').each(function(i, block) {
		hljs.highlightBlock(block);
	});
};