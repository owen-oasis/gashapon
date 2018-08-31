<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LotteryService;
use App\Services\LoginService;


class LoginController extends Controller
{
    protected $lotteryService;
    protected $loginService;

    public function __construct(LotteryService $lotteryService,LoginService $loginService)
    {
        $this->lotteryService = $lotteryService;
        $this->loginService = $loginService;
    }

    /**
     * 登入功能
     */
    public function index(Request $request)
    {
		$result = $this->loginService->login($request);
		
		// 放入可抽獎次數
		if($result['syscode']==200){
	        $result['data']['quota'] = $this->lotteryService->get_quota($result['data']['phone']);
		}else{
			$result['data']['quota'] = 0;
		}
		
		return $result;
    } 
}
