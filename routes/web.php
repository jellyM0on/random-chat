<?php


use App\Websockets\SocketHandler\UpdatePostSocketHandler;
use Illuminate\Support\Facades\Route;
use BeyondCode\LaravelWebSockets\Facades\WebSocketsRouter;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/app', function (){
    return view('app');
});

// Route::get('/playground', function () { 
//     event(new \App\Events\ChatMessageEvent()); 
//     return null; 
// }); 

Route::get('/ws', function (){
    return view('websocket'); 
});

Route::post('/chat-message', function (\Illuminate\Http\Request $request){
    event(new \App\Events\ChatMessageEvent($request->message, auth()->user())); 
    return null; 
}); 


WebSocketsRouter::webSocket('/socket/update-post', UpdatePostSocketHandler::class); 