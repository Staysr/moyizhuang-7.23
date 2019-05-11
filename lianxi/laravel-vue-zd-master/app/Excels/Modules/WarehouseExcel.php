<?php
/**
 * Created by PhpStorm.
 * User: lin.zhou
 * Date: 2018/4/18
 * Time: 15:15
 */

namespace App\Excels\Modules;


use App\Excels\Facades\ExcelAbstract;
use App\Repositories\Modules\ZdWarehouse\Interfaces;
use App\Searchs\Modules\Api\Warehouse\WarehouseSearch;

class WarehouseExcel extends ExcelAbstract
{

    public function __construct(Interfaces $repo)
    {
        parent::__construct($repo);
    }


    /**
     * @return array
     */
    public function headings(): array
    {
        return ['仓编号','商户简称','仓名称','所在区域','联系人','联系电话','是否启用','创建日期'];
    }

    /**
     * @param mixed $row
     *
     * @return array
     */
    public function map($row): array
    {
        return [
            $row->id,
            $this->getMerchantName($row),
            $row->title,
            $row->category_zone,
            $row->contacts,
            $row->contacts_phone,
            $this->getStatsAttr($row),
            $row->create_time
        ];
    }


    /**
     * 姓名
     * @param $row
     *
     * @return string
     * @author Mark
     * @date   2018/8/31 12:28
     */
    public function getMerchantName($row){
        return empty($row->merchant)? "":$row->merchant->short_name;
    }


    /**
     * 状态
     * @param $row
     *
     * @return string
     * @author Mark
     * @date   2018/8/31 12:28
     */
    public function getStatsAttr($row)
    {
       return $row->status==1 ? "是" : "否";
    }


    /**
     * @return array
     * @throws \luffyzhao\laravelTools\Searchs\Exceptions\SearchException
     * @author Mark
     * @date   xxx
     */
    protected function getAttributes()
    {
        $search = new WarehouseSearch(
            request()->only(
                [
                    'merchant_id',
                    'id',
                    'short_name',
                    'status',
                    'category_position',
                    'created_at'
                ]
            )
        );
        return $search->toArray();
    }


}