<?php
/**
 * -----------------------------------------------------------------
 * NOTE : There is two routes has a name (user & group),
 * any change in these two route's name may cause an issue
 * if not modified in all places that used in (e.g Chatify class,
 * Controllers, chatify javascript file...).
 * -----------------------------------------------------------------
 */

 use App\Http\Controllers\Chatify\CustomChatify;

use Illuminate\Support\Facades\Route;

/*
* This is the main app route [Chatify Messenger]
*/
Route::get('/', 'CustomChatify@index')->name(config('chatify.routes.prefix'));

/**
 *  Fetch info for specific id [user/group]
 */
Route::post('/idInfo', 'CustomChatify@idFetchData');

/**
 * Send message route
 */
Route::post('/sendMessage', 'CustomChatify@send')->name('send.message');

/**
 * Fetch messages
 */
Route::post('/fetchMessages', 'CustomChatify@fetch')->name('fetch.messages');

/**
 * Download attachments route to create a downloadable links
 */
Route::get('/download/{fileName}', 'CustomChatify@download')->name(config('chatify.attachments.download_route_name'));

/**
 * Authentication for pusher private channels
 */
Route::post('/chat/auth', 'CustomChatify@pusherAuth')->name('pusher.auth');

/**
 * Make messages as seen
 */
Route::post('/makeSeen', 'CustomChatify@seen')->name('messages.seen');

/**
 * Get contacts
 */
Route::get('/getContacts', 'CustomChatify@getContacts')->name('contacts.get');

/**
 * Update contact item data
 */
Route::post('/updateContacts', 'CustomChatify@updateContactItem')->name('contacts.update');


/**
 * Star in favorite list
 */
Route::post('/star', 'CustomChatify@favorite')->name('star');

/**
 * get favorites list
 */
Route::post('/favorites', 'CustomChatify@getFavorites')->name('favorites');

/**
 * Search in messenger
 */
Route::get('/search', 'CustomChatify@search')->name('search');

/**
 * Get shared photos
 */
Route::post('/shared', 'CustomChatify@sharedPhotos')->name('shared');

/**
 * Delete Conversation
 */
Route::post('/deleteConversation', 'CustomChatify@deleteConversation')->name('conversation.delete');

/**
 * Delete Message
 */
Route::post('/deleteMessage', 'CustomChatify@deleteMessage')->name('message.delete');

/**
 * Update setting
 */
Route::post('/updateSettings', 'CustomChatify@updateSettings')->name('avatar.update');

/**
 * Set active status
 */
Route::post('/setActiveStatus', 'CustomChatify@setActiveStatus')->name('activeStatus.set');






/*
* [Group] view by id
*/
Route::get('/group/{id}', 'CustomChatify@index')->name('group');

/*
* user view by id.
* Note : If you added routes after the [User] which is the below one,
* it will considered as user id.
*
* e.g. - The commented routes below :
*/
// Route::get('/route', function(){ return 'Munaf'; }); // works as a route
Route::get('/{id}', 'CustomChatify@index')->name('user');
// Route::get('/route', function(){ return 'Munaf'; }); // works as a user id
