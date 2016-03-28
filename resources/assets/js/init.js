window.$ = window.jQuery = global.jQuery = global.$ = require('jquery');
window.getMarkdown = require('markdown_parser_loader');

var highlight = require('highlight_loader');
var autocomplete = require('autocomplete_loader');
var lightbox = require('lightbox_loader');
var autosize = require('autosize_loader');
var emoji = require('emoji_loader');

require('bootstrap');
require('lightbox');
require('editor');
require('autosize');


/**
 * Veiksmai, kuriuos reikia užkrauti tik vieną kartą.
 */
lightbox();

module.exports = function() {
	$(document).ready(function() {
		highlight();
		autocomplete();
		autosize();
		emoji.run();

		/**
		 * Markdown Toolbaras
		 */
		$('#the-content textarea').markdown();

		/**
		 * Bootstrap stuff
		 */
		$('[data-toggle="tooltip"]').tooltip({
			container: 'body',
			placement: 'top'
		});
		$('[data-toggle="popover"]').popover();
	});
};