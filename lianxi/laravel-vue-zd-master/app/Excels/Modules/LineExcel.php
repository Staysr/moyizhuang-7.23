<?php
/**
 * Created by PhpStorm.
 * User: lin.zhou
 * Date: 2018/4/18
 * Time: 15:15
 */

namespace App\Excels\Modules;


use App\Excels\Facades\ExcelAbstract;
use App\Repositories\Modules\ZdPoint\Interfaces;
use App\Searchs\Modules\Api\Point\PointSearch;

class LineExcel extends ExcelAbstract
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
        return ['商户简称','仓库名称','到仓时间','线路名称','配送顺序','配送点地址','联系人','联系电话','备注'];
    }

    /**
     * @param mixed $row
     *
     * @return array
     */
    public function map($row): array
    {
        return [
            $this->getMerchantName($row),
            $this->getWarehouseName($row),
            $this->getTime($row),
            $this->getLineName($row),
            $this->getLineSort($row),
            $row->fixed_name,
            $row->contacts,
            $row->contact_way,
            $row->remark
        ];
    }

    /**
     * 到仓时间
     * @param $row
     * @return string
     */
    public function getTime($row)
    {
        return empty($row->pointTime) ? "" : $row->pointTime->arrival_warehouse_day.' '.$row->pointTime->arrival_warehouse_time;
    }

    /**
     * 商户简称
     * @param $row
     *
     * @return string
     * @author Mark
     * @date   2018/8/31 12:28
     */
    public function getMerchantName($row){
        return empty($row->pointTime) ? "" : (empty($row->pointTime->warehouse) ? "":(empty($row->pointTime->warehouse->merchant) ? "": $row->pointTime->warehouse->merchant->short_name));
    }

    /**
     * 仓名称
     * @param $row
     *
     * @return string
     * @author Mark
     * @date   2018/8/31 12:28
     */
    public function getWarehouseName($row){
        return empty($row->pointTime) ? "" : (empty($row->pointTime->warehouse) ? "":$row->pointTime->warehouse->title);
    }

    /**
     * 线路名称
     * @param $row
     * @return string
     */
    public function getLineName($row) {
        return empty($row->linePoint) ? "" : (empty($row->linePoint->line) ? "" : $row->linePoint->line->title);
    }

    /**
     * 路线排序
     * @param $row
     * @return string
     */
    public function getLineSort($row) {
        return empty($row->linePoint) ? "" : $row->linePoint->sort;
    }

    /**
     * 获取where条件
     * @method getAttributes
     *
     * @return array
     *
     * @throws \luffyzhao\laravelTools\Searchs\Exceptions\SearchException
     * @author luffyzhao@vip.126.com
     */
    protected function getAttributes()
    {
        $search = new PointSearch(
            request()->only([
                'point_time_id',
            ])
        );

        return $search->toArray();
    }
}