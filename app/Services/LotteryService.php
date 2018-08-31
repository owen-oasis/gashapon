<?php
namespace App\Services;

use App\GashaponHistory;
use App\GashaponPrize;
use App\GashaponShare;
use Carbon\Carbon;

class LotteryService
{
    /** @var Mailer */
    protected $gashaponPrize;
    protected $gashaponHistory;
    protected $gashaponShare;
    protected $carbon;
    
    /**
     * EmailService constructor.
     * @param Mailer $mail
     */
    public function __construct(GashaponPrize $gashaponPrize, GashaponHistory $gashaponHistory, GashaponShare $gashaponShare, Carbon $carbon)
    {
        $this->gashaponPrize = $gashaponPrize;
        $this->gashaponHistory = $gashaponHistory;
        $this->gashaponShare = $gashaponShare;
        $this->carbon = $carbon;
    }

    /**
     *  取得本日抽獎次數
     */
    public function get_quota($phone)
    {
        // 消費者今日已經抽獎次數
        $used = $this->gashaponHistory->where('phone',$phone)->whereBetween('created_at',[$this->carbon->setTime(0,0,0)->format('Y-m-d H:i:s'), $this->carbon->now()->setTime(23,59,59)->format('Y-m-d H:i:s')])->count();

        // 今日可抽獎次數
        $haveshare = $this->gashaponShare->where('phone',$phone)->whereBetween('created_at',[$this->carbon->setTime(0,0,0)->format('Y-m-d H:i:s'), $this->carbon->now()->setTime(23,59,59)->format('Y-m-d H:i:s')])->count();
        
        if($haveshare >= 1){
            $quota = 2;
        }else{
            $quota = 1;
        }
        $quota = $quota - $used;
        return $quota;

    }


    /**
     *  計算基數總和
     */
    public function get_cardinality_sum()
    {
        $prize_arr = GashaponPrize::all();
        foreach ($prize_arr as $key => $val) { 
            $arr[$val['id']] = $val['cardinality']; 
        };
        return $arr;
    }


    /**
     * 取得基數中的隨機數
     */
    public function get_rand($proArr)
    {
        $result = '';
        $proSum = array_sum($proArr); 
        foreach ($proArr as $key => $proCur) { 
            $randNum = mt_rand(1, $proSum); 
            if ($randNum <= $proCur) { 
                $result = $key; 
                break; 
            } else { 
                $proSum -= $proCur; 
            }    
        } 
        unset ($proArr); 
        return $result; 
    }

    /**
     * 確認庫存並處理
     */
    public function check_stock($rid)
    {
        $row = GashaponPrize::where('id',$rid)->first();
        if ($row['inventory'] >= 1) {
            GashaponPrize::where('id',$rid)->update(['inventory' => $row['inventory']-1]);
            return true;
        }else{
            return false;
        }
    }

    /**
     * 取得所有個人中獎資訊
     */
    public function get_personal($phone)
    {
        return GashaponHistory::where('phone', $phone)->orderBy('created_at', 'DESC')->get();
    }
}