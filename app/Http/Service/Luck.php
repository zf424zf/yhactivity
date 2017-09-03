<?php
/**
 * Created by PhpStorm.
 * User: 70427
 * Date: 2017/8/23
 * Time: 13:37
 */

namespace App\Http\Service;


use App\Http\Models\ImageModel;
use App\Http\Models\WinModel;
use Carbon\Carbon;

class Luck
{
    private $giftNum;
    private $cupNum;
    private $cashNum;
    private $giftChance;
    private $cupChance;
    private $cashChance;

    private static $prizeArr = ['1' => 'yh_cash', '2' => 'yh_cup', '3' => 'yh_gift'];

    public function __construct()
    {
        date_default_timezone_set('PRC');
        $this->giftNum = setting('yh_gift', 0);
        $this->cupNum = setting('yh_cup', 0);
        $this->cashNum = setting('yh_cash', 0);
        $this->giftChance = setting('yh_gift_chance', 0);
        $this->cupChance = setting('yh_cup_chance', 0);
        $this->cashChance = setting('yh_cash_chance', 0);
    }

    public function getLuck($uid, $path)
    {
        $userLuckCountKey = cache_key('user.luck.count', $uid);
        if (!empty(cache()->get($userLuckCountKey))) {
            api_exception(Service::LIKE_TODAY_CHANCE_NONE);
        }
        $expire = Carbon::now()->endOfDay()->timestamp - Carbon::now()->timestamp;

        $user_count = rand(0, 10);
        switch ($user_count) {
            case ($user_count <= $this->cashChance):
                $level = $this->checkLuck(1);
                break;
            case ($user_count <= $this->cupChance):
                $level = $this->checkLuck(2);
                break;
            case ($user_count <= $this->giftChance):
                $level = $this->checkLuck(3);
                break;
            default:
                $level = 0;
                break;
        }
        $model = new WinModel();
        $model->uid = $uid;
        $model->page_url = $path;
        $model->is_win = $level > 0 ? 1 : 0;
        $model->win_lv = $level;
        $isSave = $model->save();
        if (!$isSave) {
            api_exception(Service::SYSTEM_ERROR);
        }
        //奖用户抽奖次数设为1 今天不能再抽
        cache()->put($userLuckCountKey, 1, $expire);
        //奖品数量减1
        if (!empty($level)) {
            \DB::table('settings')->where('key', self::$prizeArr[$level])->decrement('value');
        }
        app('setting')->clear();
        return api_response(Service::SUCCESS, ['level' => $level]);
    }

    public function checkLuck($level)
    {
        switch ($level) {
            case 1:
                if ($this->cashNum > 0) {
                    $endLevel = 1;
                } else if ($this->cupNum > 0) {
                    $endLevel = 2;
                } else if ($this->giftNum > 0) {
                    $endLevel = 3;
                } else {
                    $endLevel = 0;
                }
                break;
            case 2:
                if ($this->cupNum > 0) {
                    $endLevel = 2;
                } else if ($this->giftNum > 0) {
                    $endLevel = 3;
                } else {
                    $endLevel = 0;
                }
                break;
            case 3:
                if ($this->giftNum > 0) {
                    $endLevel = 3;
                } else {
                    $endLevel = 0;
                }
                break;
            default:
                $endLevel = 0;
        }
        return $endLevel;
    }

    public function luckList($page, $pagesize)
    {
        $data = ImageModel::with('users')
            ->where('type', 9)
            ->where('module', 9)
            ->orderBy('id')
            ->paginate($pagesize)->toArray();
        return api_response(Service::SUCCESS, $data);
    }
}