<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Conexiones;
use DB;
use Funciones;
use App;
use App\PushSubscription;
use Auth;
use NotificationChannels\WebPush\WebPushMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use NotificationChannels\WebPush\WebPushChannel;

class NotificacionesController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.notificaciones.createnotificaciones');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // //return json_decode($request->input('json'));
        if(Auth::check()){
          $user_id = Auth::user()->id;
        }
        else{
          $user_id =  0;
        }
        $json = json_decode($request->input('json'));
        $keys = $json->keys;

        $subs = PushSubscription::where('user_id', '=', $user_id)->first();

        if($subs){
          $subscription = PushSubscription::find($subs->id);
          $subscription->endpoint = $json->endpoint;
          $subscription->public_key = $keys->p256dh;
          $subscription->auth_token = $keys->auth;
          $subscription->save();
        }
        else{
          $subscription = new PushSubscription();
          $subscription->user_id =$user_id;
          $subscription->endpoint = $json->endpoint;
          $subscription->public_key = $keys->p256dh;
          $subscription->auth_token = $keys->auth;
          $subscription->save();
        }
        $user = \App\User::findOrFail($user_id);
        //$user->updatePushSubscription($request->input('endpoint'), $request->input('keys.p256dh'), $request->input('keys.auth'));
        $user->notify(new \App\Notifications\GenericNotification("Welcome To WebPush", "You will now get all of our push notifications"));




        return response()->json([
          'success' => true
        ]);



    }
    /**
     * enviar mensaje
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function send(Request $request)
    {

        WebPushMessage::create()
            ->id(3)
            ->title('Approved!')
            ->icon('/approved-icon.png')
            ->body($request->input('mensaje'))
            ->action('View account', 'view_account');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
