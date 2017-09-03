<?php
/**
 * Created by PhpStorm.
 * User: 70427
 * Date: 2017/8/22
 * Time: 10:17
 */

namespace App\Http\Controllers;


use App\Http\Request\LuckRequest;
use App\Http\Request\SectionLuckRequest;
use App\Http\Service\Luck;

class LuckController extends Controller
{
    public function luck(LuckRequest $request)
    {
        return (new Luck())->getLuck($request->get('uid'), $request->get('path'));
    }

    public function luckList()
    {
        return (new Luck())->luckList(\Request::get('page', 1), \Request::get('pagesize', 12));
    }

    public function sectionLucky(SectionLuckRequest $request){
        return (new Luck())->getLuckyBySection($request->get('section'));
    }
}