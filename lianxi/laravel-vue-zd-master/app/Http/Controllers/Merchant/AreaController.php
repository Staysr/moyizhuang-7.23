<?php
/**
 * Created by PhpStorm.
 * User: fathoo
 * Date: 2018/5/25
 * Time: 17:47
 */

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Repositories\Modules\ZdCategory\Interfaces;
use App\Repositories\Modules\ZdArea\Interfaces as ZdAreaInterfaces;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


/**
 * Class AreaController
 * @package App\Http\Controllers\Merchant
 */
class AreaController extends Controller
{

    protected $repo = null;

    public function __construct(Interfaces $repo)
    {
        $this->repo = $repo;
    }


    /**
     * 地区列表
     * @param Request $request
     * @param ZdAreaInterfaces $area
     * @author Mark
     * @date 2018/6/14 14:16
     */
    public function index(Request $request, ZdAreaInterfaces $area)
    {
        $names = $this->repo->scope(['orderWith'])->getModel()->where(
            ['level' => 2]
        )->get(['name'])->pluck('name')->toArray();
        $result = $area->getModel()->where(
            ['level' => 1]
        )->whereIn('area_name', $names)->get([DB::raw('area_name as province'), 'parent_code', 'code'])->toArray();

        if(!empty($result)) {
            foreach ($result as $index => $item) {
                $sub = $area->getModel()->where(
                    'position',
                    'like',
                    'tr_'.$item['parent_code'].' tr_'.$item['code']."%"
                )->get(
                    [DB::raw('area_name as city'), 'level', 'code', 'parent_code']
                )->toArray();
                $result[$index]['city'] = array_filter(
                    $sub,
                    function ($item) {
                        return $item['level'] == 2;
                    }
                );
                sort($result[$index]['city']);
                foreach ($result[$index]['city'] as $key => $value) {
                    $result[$index]['city'][$key]['district'] = array_column(
                        array_filter(
                            $sub,
                            (
                            function ($miss) use ($value) {
                                return $miss['parent_code'] == $value['code'];
                            }
                            )
                        ),
                        'city'
                    );
                    unset($result[$index]['city'][$key]['level']);
                    unset($result[$index]['city'][$key]['code']);
                    unset($result[$index]['city'][$key]['parent_code']);
                }
            }
            unset($result[$index]['parent_code']);
            unset($result[$index]['code']);
        }
        return $this->respondWithSuccess($result);
    }

}

?>