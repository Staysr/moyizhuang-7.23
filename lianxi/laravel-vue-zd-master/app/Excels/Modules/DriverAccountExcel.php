<?php
/**
 * Created by PhpStorm.
 * User: lin.zhou
 * Date: 2018/4/18
 * Time: 15:15
 */

namespace App\Excels\Modules;


use App\Excels\Facades\ExcelAbstract;
use App\Repositories\Modules\ZdDriverSub\Interfaces;
use App\Searchs\Modules\Api\Account\DriverAccountSearch;

class DriverAccountExcel extends ExcelAbstract
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
        return ['司机姓名','所属队长','司机手机号','车型','车牌号码','成功配送次数','上岗次数','账单金额'];
    }

    /**
     * @param mixed $row
     *
     * @return array
     */
    public function map($row): array
    {
        return [
            $this->getDriverNameAttr($row),
            $this->getSupervisorNameAttr($row),
            $this->getDriverPhoneAttr($row),
            $this->getCarTypeAttr($row),
            $this->getCarNumberAttr($row),
            $this->getCompleteCountAttr($row),
            $this->getWorkCountAttr($row),
            $this->getTotalFeeAttr($row),
        ];
    }


    /**
     * 司机姓名
     * @param $row
     *
     * @return string
     * @author Mark
     * @date   2018/8/7 15:33
     */
    public function getDriverNameAttr($row)
    {
       return empty($row->driver) ? "" : $row->driver->name;
    }


    /**
     * 队长姓名
     * @param $row
     *
     * @return string
     * @author Mark
     * @date   2018/8/7 15:33
     */
    public function getSupervisorNameAttr($row)
    {
        return empty($row->driver->supervisor) ? "" : $row->driver->supervisor->name;
    }


    /**
     * 司机手机
     * @param $row
     *
     * @return string
     * @author Mark
     * @date   2018/8/7 15:33
     */
    public function getDriverPhoneAttr($row)
    {
        return empty($row->driver) ? "" : $row->driver->phone;
    }

    public function getCarTypeAttr($row)
    {
        return empty($row->driver) ? "" : $row->driver->carType->name;
    }


    public function getCarNumberAttr($row){
        return empty($row->driver) ? "" : $row->driver->car_number;
    }


    public function getTotalFeeAttr($row){
        if(empty($row->order)){
            return "0";
        }else{
            $total=0;
            foreach ($row->order as $index => $item) {
                $total+=$item->total_fee;
            }
            return  (string)$total;
        }
    }

    public function getCompleteCountAttr($row){
        return empty($row->complete_count) ? "0" : $row->complete_count;
    }

    public function getWorkCountAttr($row){
        return empty($row->work_count) ? "0" : $row->work_count;
    }

    /**
     * @return array
     * @throws \luffyzhao\laravelTools\Searchs\Exceptions\SearchException
     * @author Mark
     * @date   xxx
     */
    protected function getAttributes()
    {
        $search = new DriverAccountSearch(request()->only([
            'driver_id'
        ]));
        return $search->toArray();
    }


}