<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GashaponHistory;
use App\GashaponPrize;
use App\GashaponShare;
use App\Services\LotteryService;
use Carbon\Carbon;

class LotteryController extends Controller
{
    protected $lotteryService;
    protected $gashaponPrize;
    protected $gashaponHistory;
    protected $gashaponShare;

    public function __construct(LotteryService $lotteryService, GashaponPrize $gashaponPrize, GashaponHistory $gashaponHistory, GashaponShare $gashaponShare, Carbon $carbon)
    {
        $this->lotteryService = $lotteryService;
        $this->gashaponPrize = $gashaponPrize;
        $this->gashaponHistory = $gashaponHistory;
        $this->gashaponShare = $gashaponShare;
        $this->carbon = $carbon;
    }

    /**
     * 抽獎功能
     */
    public function index(Request $request)
    {
        //簡單驗證
        if($request['phone'] == NULL || $request['phone'] == 'undefined'){
            $result['syscode'] = 403;
            $result['sysmessage'] = '驗證失敗';
            return $result;
        }

        //判斷活動是否開始
        if(Carbon::now()->between(Carbon::create(2017, 12, 15, 13, 0), Carbon::create(2017, 12, 25, 23, 59)) == false){
            $result['syscode'] = 4030;
            $result['sysmessage'] = '禁止使用此資源-非活動時間';
            return $result;
        }

        // 取得剩餘抽獎次數
        $phone = $request['phone'];
        $quota = $this->lotteryService->get_quota($phone); 

        // 判斷還可以抽獎嗎
        if($quota > 0){
            // 取得基數
            $arr = $this->lotteryService->get_cardinality_sum();

            // 透過基數亂數取得獎品
            $rid = $this->lotteryService->get_rand($arr);

            // 確認是否還有庫存 // 取得獎品
            $check_stock = $this->lotteryService->check_stock($rid);
            if ($check_stock == true) {
                $res = GashaponPrize::where('id', $rid)->pluck('prize');
                $data['prize'] = $res[0];
            }elseif ($check_stock == false) {
                $data['prize'] = '銘謝惠顧'; 
                $res[0] = '銘謝惠顧'; 
                $rid = '27'; //銘謝惠顧編號
            }else{
                return 'check_stock ERROR';
            }

            // 紀錄抽獎
            $data['phone'] = $request['phone'];
            $data['ip'] = request()->ip();
            $this->gashaponHistory->create($data);

            //
            $result['syscode'] = 200;
            $result['sysmessage'] = '成功';
            $result['data']['quota'] = $quota-1;
        }else{
            // 不能抽獎了
            $result['syscode'] = 401;
            $result['sysmessage'] = '無抽獎額度';
            $res[0] = '抽獎額度不足';
            $rid = 'error!';
            $result['data']['quota'] = 0;
        }
        $result['data']['phone'] = $request['phone'];
        $result['data']['prize'] = $res[0];
        $result['data']['prize_image'] = '/image/gift/'.$rid.'.png';
        return $result;
    }

    /**
     * 分享功能
     */
    public function share(Request $request){
        //簡單驗證
        if($request['phone'] == 'NULL' || $request['phone'] == 'undefined'){
            $result['syscode'] = 403;
            $result['sysmessage'] = '驗證失敗';
            return $result;
        }

        // 分享抽獎
        $data['phone'] = $request['phone'];
        $data['share_status'] = 'success';
        $this->gashaponShare->create($data);

        // 取得剩餘抽獎次數
        $phone = $request['phone'];
        $quota = $this->lotteryService->get_quota($phone); 

        // 回傳
        $result['syscode'] = 200;
        $result['sysmessage'] = '分享成功';
        $result['data']['quota'] = $quota;
        return $result;
    }

    /**
     * 取得中獎資訊
     */
    public function get_personal(Request $request){
        //簡單驗證
        if($request['phone'] == 'NULL' || $request['phone'] == 'undefined'){
            $result['syscode'] = 403;
            $result['sysmessage'] = '驗證失敗';
            return $result;
        }

        $phone = $request['phone'];
        $datas = $this->lotteryService->get_personal($phone); 


        // 回傳
        $result['syscode'] = 200;
        $result['sysmessage'] = '成功';
        $result['data'] = $datas;
        return $result;
    }

}
