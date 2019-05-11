<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;

use App\Repositories\Modules\ZdMerchantUser\Interfaces;
use App\Repositories\Modules\ZdTask\Interfaces as ZdTaskInterfaces;
use App\Repositories\Modules\ZdTaskOrder\Interfaces as ZdTaskOrderInterfaces;
use App\Repositories\Modules\ZdDriver\Interfaces as ZdDriverInterface;
use App\Repositories\Modules\ZdMerchant\Interfaces as ZdMerchantInterface;
use App\Repositories\Modules\ZdSysUser\Interfaces as ZdSysUserInterface;
use App\Repositories\Modules\ZdFeedBack\Interfaces as ZdFeedBackInterface;
use App\Repositories\Modules\ZdSms\Interfaces as ZdSmsInterface;
use App\Repositories\Modules\ZdMonthBill\Interfaces as ZdMonthBillInterfaces;
use App\Repositories\Modules\ZdMerchantBill\Interfaces as ZdMerchantBillInterfaces;
use Illuminate\Support\Facades\Redis;
use App\Facades\Util;
use Illuminate\Http\Request;
use App\Http\Requests\Merchant\User\ForgetRequest;
use App\Http\Requests\Merchant\User\SmsRequest;

class UserController extends Controller
{

    protected $repo = null;

    public function __construct(Interfaces $repo)
    {
        $this->repo = $repo;
    }


    /**
     * 忘记密码
     * @param ForgetRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @author Mark
     * @date   2018/7/19 17:38
     */
    public function forget(ForgetRequest $request)
    {
        $user = $this->repo->findWhere($request->only(['phone'], ['*']));
        if ($this->repo->update($user->getModel(), $request->only(['password']))) {
            return $this->respondWithSuccess([], '更新密码成功');
        } else {
            return $this->respondWithError('更新密码失败！', 500);
        }
    }


    /**
     * 发送短信
     * @param SmsRequest     $request
     * @param ZdSmsInterface $sms
     *
     * @return \Illuminate\Http\JsonResponse
     * @author Mark
     * @date   2018/7/19 17:38
     */
    public function sms(SmsRequest $request, ZdSmsInterface $sms)
    {
        $code = Util::RandomCode(6);
        $content = $code."(验证码,五分钟内有效)【方舟货的】";
        Redis::setex('zhoudao:app:forget:'.$request->input(['phone']), 300, $code);

        $sms->create(
            [
                'mobile' => $request->input(['phone']),
                'contents' => $content,
                'remark' => '舟到APP找回密码',
            ]
        );
        return $this->respondWithSuccess([], '短信发送成功');
    }


    /**
     * 个人信息
     * @param ZdTaskInterfaces $task
     * @param ZdTaskOrderInterfaces $order
     * @param ZdMonthBillInterfaces $bill
     * @param ZdMonthBillInterfaces $SingleBill
     * @return \Illuminate\Http\JsonResponse
     * @author Mark
     * @date 2018/6/7 14:26
     */
    public function profile(ZdTaskInterfaces $task, ZdTaskOrderInterfaces $order,ZdMonthBillInterfaces $bill,ZdMerchantBillInterfaces $SingleBill)
    {
        $user = auth()->user();
        $pendingSum = $SingleBill->scope(['orderWith', 'SingleMerchant'])->getModel()
            ->whereYear('create_time', '=', date('Y'))
            ->whereMonth('create_time', '=', date('m'))
            ->sum('money');

        $totalSum=$bill->scope(['orderWith', 'SingleMerchant'])->getField(
            'money-repayment_money',
            'diff_money'
        )->sum('diff_money');
        $running = $task->scope(['SingleMerchant', 'Running'])->getModel()->count();
        $finish = $order->scope(['SingleMerchant', 'Finish'])->getModel()->pluck('total_fee')->toArray();
        $result['name'] = $user->merchant()->value("short_name");
        $result['status'] = $user->status;
        $result['running'] = $running;
        $result['unpay'] =number_format($pendingSum+$totalSum,2, ".", "");
        $result['finish'] = count($finish);

        return $this->respondWithSuccess($result);
    }


    /**
     * 获取商户信息
     * @param Request $request
     * @param ZdMerchantInterface $merchant
     * @return \Illuminate\Http\JsonResponse
     * @author Mark
     * @date 2018/6/22 16:13
     */
    public function detail(Request $request, ZdMerchantInterface $merchant)
    {
        $info = $merchant->findWhere(
            ['id' => auth()->user()->merchant_id],
            [
                'id',
                'title',
                'short_name',
                'city',
                'trade',
                'bank',
                'bank_no',
                'telephone',
                'content',
            ]
        );

        return $this->respondWithSuccess($info);
    }


    /**
     * 获取商户岗控信息
     * @param Request $request
     * @param ZdMerchantInterface $merchant
     * @param ZdDriverInterface $driver
     * @param ZdSysUserInterface $user
     * @return \Illuminate\Http\JsonResponse
     * @author Mark
     * @date 2018/6/22 17:22
     */
    public function info(Request $request, ZdMerchantInterface $merchant, ZdSysUserInterface $user)
    {
        $quality=auth()->user()->merchant->quality;
        $quality?$quality['status'] = 1:$quality['status'] = 0;
        $quality['job']= '品质经理';


        $advice=auth()->user()->merchant->advice;
        $advice?$advice['status'] = 1:$advice['status'] = 0;
        $advice['job']= '客户顾问';


        $running=auth()->user()->merchant->running;
        $running?$running['status'] = 1:$running['status'] = 0;
        $running['job']= '运作经理';


        return $this->respondWithSuccess([$quality,$advice,$running]);
    }


    /**
     * 提交反馈
     * @param Request $request
     * @param ZdFeedBackInterface $feedback
     * @return \Illuminate\Http\JsonResponse
     * @author Mark
     * @date 2018/6/23 10:27
     */
    public function feedback(Request $request, ZdFeedBackInterface $feedback)
    {
        $this->validate(
            $request,
            [
                'content' => ['required', 'min:15', 'max:200'],
            ],
            [],
            ['content' => '反馈内容']
        );

        $post = $request->only(
            [
                'content',
            ]
        );
        $post['merchant_id'] = auth()->user()->merchant_id;
        $feedback->create($post);

        return $this->respondWithSuccess([], '提交反馈成功');
    }


}
