<?php

namespace App\Http\Controllers;

use App\Events\SendWelcomeNotification;
use App\Jobs\SendEmailJob;
use App\Models\Notification;
use App\Models\User;
use App\Notifications\demo;
use App\Notifications\SendPushNotification;
use App\Transformers\UserTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use League\Fractal\Manager;

class UserController extends Controller
{
    private $fractal;

    protected $userTransformer;

    public function __construct(Manager $fractal, UserTransformer $userTransformer)
    {
        $this->fractal = $fractal;
        $this->userTransformer = $userTransformer;
    }

    public function store(Request $request) {
        $data = $request->only('name', 'email', 'password');
        $user = User::create($data);
        event(new SendWelcomeNotification($user));
        return $this->sendResponse($user, 'tao thanh cong');
    }

    public function index()
    {
        $user =  User::latest('id')->first();
        return $this->userTransformer->transform($user);
    }

    public function notify() {
        $user = User::find(4);
        $notification = Notification::find(1);
        $user->notify(new sendPushNotification($notification->title,$notification->content, $notification->type));
        dd('done');
    }

    public function showNotify() {
        $user= User::find(4);
        $data = $user->unreadNotifications;
        return $this->sendResponse($data,'success');
    }

    public function queueJob() {
        $name = 'Kien Le Van';
//        SendEmailJob::dispatch($name);
        $response = Http::get(url('/users'));
        return $this->sendResponse($response, 'success');
    }

    public function queueJob2000() {
        $name = 'Kien Le Van';
//        SendEmailJob::dispatch($name);
        $response = Http::get(url('/users'));
        return $this->sendResponse($response, 'success');
    }

}
