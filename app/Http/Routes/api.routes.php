<?php

//Markdown parseris JavaScriptui
Route::post('/markdown', function()
{
	return markdown(Request::input('body'));	
});