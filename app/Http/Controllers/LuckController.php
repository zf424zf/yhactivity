<?php
/**
 * Created by PhpStorm.
 * User: 70427
 * Date: 2017/8/22
 * Time: 10:17
 */

namespace App\Http\Controllers;


use App\Http\Models\SectionModel;
use App\Http\Request\LuckContactRequest;
use App\Http\Request\LuckRequest;
use App\Http\Request\SectionLuckRequest;
use App\Http\Service\Image;
use App\Http\Service\Luck;
use App\Http\Service\Service;

class LuckController extends Controller
{
    public function __construct()
    {
        $this->middleware('isLogin',['except'=>['luck','luckList','sectionLucky','luckyContact']]);
    }

    public function luck(LuckRequest $request)
    {
        return (new Luck())->getLuck($request->get('uid'), $request->get('image_id'));
    }

    public function luckList()
    {
        $data = (new Luck())->luckList(\Request::get('page', 1), \Request::get('pagesize', 12));
        return api_response(Service::SUCCESS, $data);
    }

    public function sectionLucky(SectionLuckRequest $request)
    {
        $data =  (new Luck())->getLuckyBySection($request->get('section'));
        return api_response(Service::SUCCESS,$data);
    }

    public function luckyContact(LuckContactRequest $request)
    {
        return (new Luck())->luckContact($request->get('win_id'), $request->get('name'),
            $request->get('tel'), $request->get('address'));
    }

    public function indexView()
    {
        return view('lucky.index');
    }

    public function shareWallView(){
        $data =  (new Luck())->luckList(\Request::get('page', 1), \Request::get('pagesize', 12));
        return view('lucky.wall',['data'=>$data]);
    }

    public function shareDetailView($id){
        $user = session('user');
        $data = (new Image())->imageInfo($id,array_get($user,'id',''));
        return view('lucky.detail',['data'=>$data]);
    }
    public function shareRankView($section){
        $sections = SectionModel::pluck('name','id');
         if(empty($sections)){
             abort(404);
         }
         $data = (new Luck())->getLuckyBySection($section);
         return view('lucky.rank',['data'=>$data,'sections'=>$sections,'curSection'=>$section]);
    }

    public function luckView(){
        $imageId = \Request::get('image_id');
        $uid = session('user')['id'];
        $flag = (new Luck())->checkUserTodayLuck($uid);
        return view('lucky.luck',['uid'=>$uid,'flag'=>$flag,'image'=>$imageId]);
    }
}