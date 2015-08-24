<?php

Route::model('conferconversation', 'maze\Modules\Confer\Conversation');
Route::model('conferuser', 'maze\User');

Route::any('confer/auth', ['as' => 'confer.pusher.auth', 'uses' => 'ConversationController@authenticate']);
Route::get('confer/test', 'ConversationController@test');
Route::get('confer/settings', 'ConversationController@settings');
Route::get('confer/conversations/bar', 'ConversationController@barIndex');
Route::get('confer/conversations', 'ConversationController@index');
Route::get('confer/users', ['as' => 'confer.users.list', 'uses' => 'ConversationController@listUsers']);
Route::post('confer/user/{conferuser}/info', ['as' => 'confer.user.info', 'uses' => 'ConversationController@getUserInfo']);
Route::post('confer/user/{conferuser}/conversation/{conferconversation}/info', ['as' => 'confer.user.conversation.info', 'uses' => 'ConversationController@getUserAndConversationInfo']);
Route::get('confer/conversation/{conferconversation}', ['as' => 'confer.conversation.show', 'uses' => 'ConversationController@show']);
Route::post('confer/conversation/{conferconversation}/info', ['as' => 'confer.conversation.info', 'uses' => 'ConversationController@info']);
Route::post('confer/conversation/{conferconversation}/requested', ['as' => 'confer.conversation.requested', 'uses' => 'ConversationController@requested']);
Route::get('confer/conversation/find/user/{conferuser}', ['as' => 'confer.conversation.find', 'uses' => 'ConversationController@find']);
Route::delete('confer/conversation/{conferconversation}/leave', ['as' => 'confer.conversation.participant.delete', 'uses' => 'ConversationController@leave']);

Route::get('confer/conversation/{conferconversation}/messages', ['as' => 'confer.conversation.messages.show', 'uses' => 'ConversationController@showMoreMessages']);
Route::post('confer/conversation/{conferconversation}/messages', ['as' => 'confer.conversation.message.store', 'uses' => 'MessageController@store']);

Route::get('confer/conversation/{conferconversation}/invite', ['as' => 'confer.conversation.invite.show', 'uses' => 'ConversationController@showInvite']);
Route::patch('confer/conversation/{conferconversation}', ['as' => 'confer.conversation.update', 'uses' => 'ConversationController@update']);

Route::post('confer/session', ['as' => 'confer.session.store', 'uses' => 'SessionController@store']);
Route::patch('confer/requests/session', ['as' => 'confer.session.update', 'uses' => 'SessionController@update']);
Route::get('confer/session/clear', ['as' => 'confer.session.destroy', 'uses' => 'SessionController@destroy']);