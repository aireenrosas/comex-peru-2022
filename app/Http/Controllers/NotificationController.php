<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Conexiones;
use DB;
use Funciones;
use App;
use PushNotification;
use App\PushSubscription;
use Auth;

class NotificationController extends Controller
{

    public function __construct()
    {

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $devices = PushNotification::DeviceCollection(array(
    PushNotification::Device('token', array('badge' => 5)),
    PushNotification::Device('token1', array('badge' => 1)),
    PushNotification::Device('token2')
    ));
    $message = PushNotification::Message('Message Text',array(
        'badge' => 1,
        'sound' => 'example.aiff',

        'actionLocKey' => 'Action button title!',
        'locKey' => 'localized key',
        'locArgs' => array(
            'localized args',
            'localized args',
        ),
        'launchImage' => 'image.jpg',

        'custom' => array('custom data' => array(
            'we' => 'want', 'send to app'
        ))
    ));

    // $collection = PushNotification::app('appNameIOS')
    //     ->to($devices)
    //     ->send($message);

    // get response for each device push
    // foreach ($collection->pushManager as $push) {
    //     $response = $push->getAdapter()->getResponse();
    // }

    // access to adapter for advanced settings
    $push = PushNotification::app('appNameAndroid');
    $push->adapter->setAdapterParameters(['sslverifypeer' => false]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //return json_decode($request->input('json'));
        return Auth::user()->id;
        $subscription = new PushSubscription();
        $subscription->user_id = Auth::user()->id;
        $subscription->endpoint = $request->endpoint;
        $subscription->public_key = $request->keys['p256dh'];
        $subscription->auth_token = $request->keys['auth'];
        $subscription->save();

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
