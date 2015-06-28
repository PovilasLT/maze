<?php

//Markdown parseris JavaScriptui
Route::post('/markdown', function()
{
	return Markdown::convertToHtml(Request::input('body'));	
});