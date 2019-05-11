<?php
/**
 * Created by PhpStorm.
 * User: lin.zhou
 * Date: 2018/4/18
 * Time: 15:15
 */

namespace App\Excels\Modules;


use App\Excels\Facades\ExcelAbstract;
use App\Repositories\Modules\ZdCar\Interfaces;
use App\Searchs\Modules\Api\Car\CarSearch;

class CarExcel extends ExcelAbstract
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
        return ['车牌号码','关联司机','司机号码','车辆型号','外包公司','车辆配件','创建时间'];
    }

    /**
     * @param mixed $row
     *
     * @return array
     */
    public function map($row): array
    {
        return [
            $row->number,
            $this->getDriverNameAttr($row),
            $this->getDriverPhoneAttr($row),
            $this->getTypeNameAttr($row),
            $this->getCompanyNameAttr($row),
            $row->parts,
            $row->created_at
        ];
    }


    public function getDriverNameAttr($row)
    {
       return empty($row->driver) ? "" : $row->driver->name;
    }

    public function getDriverPhoneAttr($row)
    {
        return empty($row->driver) ? "" : $row->driver->phone;
    }

    public function getTypeNameAttr($row)
    {
        return empty($row->carType) ? "" : $row->carType->name;
    }


    public function getCompanyNameAttr($row)
    {
        return empty($row->company) ? "" : $row->company->name;
    }


    /**
     * 查找
     * @return array
     * @throws \luffyzhao\laravelTools\Searchs\Exceptions\SearchException
     * @author Mark
     * @date   2018/8/31 11:08
     */
    protected function getAttributes()
    {
        $search = new CarSearch(request()->only([
            'driver_id',
            'number',
            'company_id',
            'created_at',
        ]));
        return $search->toArray();
    }


}