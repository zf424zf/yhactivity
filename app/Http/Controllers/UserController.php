<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Service\Service;
use App\Http\Service\User;
use App\Http\Service\WxApp;
use App\Http\Request\User\TicketRequest;
use App\Http\Request\User\WxLoginRequest;

/**
 * Created by PhpStorm.
 * User: skiden
 * Date: 2017/7/4
 * Time: 下午10:02
 */
class UserController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        return api_response(Service::SUCCESS, app('user')->info());
    }

    public function ticket(TicketRequest $request)
    {
        $session = (new WxApp(app('config')->get('wx.app_id'), app('config')->get('wx.app_secret')))->getSession(request('code'));
        $key = md5(str_random(40));
        cache()->put($key, $session, 1);
        return api_response(Service::SUCCESS, ['ticket' => $key, 'openid' => $session['openid']]);
    }

    public function wxlogin(WxLoginRequest $request)
    {
        $session = cache()->get($request->input('ticket'));
        if (!$session) {
            api_exception(Service::WX_TICKET_NOT_EXISTS);
        }
        $data = WxApp::decrypt($session['session_key'], $request->input('encrypted_data'), $request->input('iv'));
        if (!$data) {
            api_exception(Service::WX_DECRYPT_FAIL);
        }
        $user = app('user')->wxRegister($data);
        return api_response(Service::SUCCESS, $user);
    }

    public function niceUser(){
      return  (new User())->redirectByUser(\Request::get('uid'),\Request::get('name'),\Request::get('avatar'));
    }

}