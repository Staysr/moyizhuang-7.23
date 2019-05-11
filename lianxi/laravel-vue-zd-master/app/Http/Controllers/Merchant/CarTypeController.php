<?php
/**
 * Created by PhpStorm.
 * User: fathoo
 * Date: 2018/5/25
 * Time: 17:47
 */

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Repositories\Modules\ZdCarType\Interfaces;
use Illuminate\Http\Request;


/**
 * Class TaskController
 * @package App\Http\Controllers\Merchant
 */
class CarTypeController extends Controller
{

    protected $repo = null;

    public function __construct(Interfaces $repo)
    {
        $this->repo = $repo;
    }

    /**
     * 车型列表
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @author Mark
     * @date 2018/4/24 12:04
     */
    public function index(Request $request)
    {
        $result=$this->repo->scope(['orderWith'])->get(
            ['id','name','code','capacity','length','width','height','spec']
        )->each(function ($item) {
            $item->length=number_format($item->length,2,".", "");
            $item->width=number_format($item->width,2,".", "");
            $item->height=number_format($item->height,2,".", "");
        });
        return $this->respondWithSuccess($result);
    }

}

?>