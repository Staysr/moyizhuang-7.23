<?php
/**
 * Created by PhpStorm.
 * User: fathoo
 * Date: 2018/5/25
 * Time: 17:47
 */

namespace App\Http\Controllers\Api;

use App\Repositories\Modules\ZdMerchantContract\Interfaces;
use App\Repositories\Modules\ZdMerchant\Interfaces as ZdMerchantInterfaces ;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Storage;

/**
 * Class ContractController
 *
 * @package App\Http\Controllers\Api
 */
class ContractController extends ApiController
{

    protected $repo = null;

    public function __construct(Interfaces $repo)
    {
        $this->repo = $repo;
    }


    /**
     * 合同详情
     * @param Request $request
     * @param         $id
     *
     * @return \Illuminate\Http\JsonResponse
     * @author Mark
     * @date   2018/9/6 15:09
     */
    public function show(Request $request,$id)
    {
        $result = $this->repo->scope(['orderWith'])->paginate(
            ['merchant_id'=>$id],
            20,
            [
                'id',
                'path'
            ]
        );

        return $this->respondWithSuccess($result);
    }


    /**
     * 更新
     * @param Request              $request
     * @param ZdMerchantInterfaces $merchant
     * @param                      $id
     *
     * @return \Illuminate\Http\JsonResponse
     * @author Mark
     * @date   2018/9/7 13:57
     */
    public function update(Request $request,ZdMerchantInterfaces $merchant,$id)
    {
        $new=[];
        $input=collect($request->input(['images']))->pluck('path')->toArray();
        foreach ($input as $index => $item) {
            $new[]['path']=$item;
        }
        $result = $merchant->find($id);
        $result->contract()->delete();
        if(!empty($new)){
            $result->contract()->createMany($new);
        }
        return $this->respondWithSuccess([],'更新合同成功');

    }



    /**
     * 上传base64
     * @method base64
     *
     * @param Request $request
     *
     * @return array|\Illuminate\Http\JsonResponse
     *
     * @author luffyzhao@vip.126.com
     */
    public function upload(Request $request)
    {
        $base64 = $request->post('base64');
        if (preg_match(
            '/^(data:[a-zA-Z0-9]+\/(\w+);base64,)/',
            $base64,
            $matches
        )
        ) {
            $types = ['jpg', 'gif', 'png', 'jpeg'];
            if (!in_array($matches[2], $types)) {
                return $this->respondWithError(
                    '图片格式不正确，只支持 jpg、gif、png、jpeg哦！'
                );
            }
            $img = base64_decode(str_replace($matches[1], '', $base64));
            $filename = date('Y-m-d').'/'.date('H-i-s').uniqid().'.'
                .$matches[2];
            if (Storage::put($filename, $img)) {
                return $this->respondWithSuccess(
                    [
                        'path' => Storage::url($filename),
                    ]
                );
            }
        }
        return $this->respondWithError('上传失败');
    }

}

