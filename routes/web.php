<?php


Route::get('/messages', 'MessagesController@index');
Route::get('newMessage','MessagesController@newMessage');
Route::post('sendNewMessage', 'MessagesController@sendNewMessage');
Route::post('/sendMessage', 'MessagesController@sendMessage');



Route::get('/getMessages', function(){
$allUsers1 = DB::table('users')
->Join('conversations', 'users.id', 'conversations.user_a')
->where('conversations.user_b',  Auth::user()->id)->get();
//return $allUsers1;

$allUsers2 = DB::table('users')
->Join('conversations', 'users.id', 'conversations.user_b')
->where('conversations.user_a',  Auth::user()->id)->get();
return array_merge($allUsers1->toArray(), $allUsers2->toArray());

});

Route::get('/getMessages/{id}', function($id){
//conversation check
$userMessage = DB::table('messages')
->join('users', 'users.id','messages.user_sender')
->where('messages.conversation_id', $id)->get();
return $userMessage;
});



Route::get('/', 'PagesController@index');

Route::get('/about', 'PagesController@about');

Route::get('/future', 'PagesController@future');

Route::get('/volunteer', 'PagesController@volunteer');

Route::get('/garden', 'PagesController@garden');

Route::get('/contact', 'PagesController@contact');


Route::resource('posts', 'PostsController');

Auth::routes();


Route::group(['middleware' => 'auth'], function(){

 Route::get('/profile/{User}', [
'uses' => 'UserController@index',

'as'   => 'profile'

 ]);

  Route::get('/profile/edit/profile', [
'uses' => 'UserController@edit',

'as'   => 'profile.edit'

 ]);

   Route::post('/profile/update/profile', [
'uses' => 'UserController@update',

'as'   => 'profile.update'

 ]);


});







Route::get('/dashboard', 'DashboardController@index');


Route::get('profiles/profile/{id?}', 'GardenController@viewProfile');
Route::get('garden', 'GardenController@member')->middleware('auth');








Route::get('/add_friend/{id}', [

  'uses' => 'GardenController@add_friend',

  'as' => 'add_friend'

]);

    Route::get('/accept_friend/{id}', [
        'uses' => 'GardenController@accept_friend',
        'as' => 'accept_friend'
    ]);
      Route::get('/accept/{name}/{id}', 'GardenController@accept');


Route::get('/check_relationship_status/{id}', [

  'uses' => 'GardenController@check',

  'as' => 'check'

]);



Route::get('/friends', 'GardenController@friends');







Route::get('/matches', 'MatchesController@matches');


Route::get('/check_match_status/{id}', [

  'uses' => 'MatchesController@check',

  'as' => 'check'

]);



Route::get('/like_user/{id}', [

  'uses' => 'MatchesController@like_user',

  'as' => 'like_user'

]);


    Route::get('/mutual_like/{id}', [
        'uses' => 'MatchesController@mutual_like',
        'as' => 'mutual_like'
    ]);













Route::get('/notifications/{id}', 'GardenController@notifications');

Route::get('/requests', 'GardenController@requests');


Route::get('requestRemove/{id}', 'GardenController@requestRemove');

Route::get('/notifications/{id}', 'GardenController@notifications');

  Route::get('/unfriend/{id}', function($id){
                $loggedUser = Auth::user()->id;
              DB::table('friendships')
              ->where('sender_id', $loggedUser)
              ->where('recipient_id', $id)
              ->delete();
              DB::table('friendships')
              ->where('recipient_id', $loggedUser)
              ->where('sender_id', $id)
              ->delete();
              return back()->with('msg', 'U bent geen vrienden meer..(?)');
        });
