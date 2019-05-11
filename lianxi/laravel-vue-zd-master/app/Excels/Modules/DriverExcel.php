<?php
/**
 * Created by PhpStorm.
 * User: lin.zhou
 * Date: 2018/4/18
 * Time: 15:15
 */

namespace App\Excels\Modules;

use App\Excels\Facades\ExcelAbstract;
use App\Repositories\Modules\ZdDriver\Interfaces;
use App\Searchs\Modules\Api\Driver\FinishSearch;
use phpDocumentor\Reflection\DocBlock;

class DriverExcel extends ExcelAbstract
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
        $title= [
            '司机ID',
            '姓名',
            '手机号',
            '身份证',
            '所属商圈',
            '角色',
            '司机类型',
            '车牌',
            '外包公司',
            '所属上级',
            'APP状态',
            '车型',
            '成功配送次数',
            '上岗次数',
            '投诉次数',
            '评分',
        ];
        if(request()->input('export')=='social'){
            array_push($title,'保证金');
            array_push($title,'平台信息费');
        }
        return $title;
    }

    /**
     * @param mixed $row
     *
     * @return array
     */
    public function map($row): array
    {
        $base=[
            $row->id,
            $row->name,
            $row->phone,
            $row->idcard,
            $this->getCategoryAttr($row),
            $this->getIdentityTypeAttr($row),
            $this->getTypeNameAttr($row),
            $row->car_number,
            $this->getCompanyNameAttr($row),
            $this->getSupervisorNameAttr($row),
            $this->getAppstatusAttr($row),
            $this->getCarTypeAttr($row),
            $this->getCompleteCountAttr($row),
            $this->getWorkCountAttr($row),
            $this->getComplaintCountAttr($row),
            $this->getScoreAttr($row),

        ];
        if(request()->input('export')=='social'){
            array_push($base,$this->getDepositStatusAttr($row));
            array_push($base,$this->getDepositStatusAttr($row));
        }
        return $base;
    }

    public function getDepositStatusAttr($row){
        switch ($row->deposit_status) {
            case 0:
                return "未缴纳";
            case 1:
                return "已缴纳";
            case 2:
                return "退款中";
            case 3:
                return "已退款";
        }
    }


    public function getIsPlatServiceFeeAttr($row){
        return $row->is_plat_service_fee==0 ? '已缴纳' : '未缴纳';
    }


    public function getCategoryAttr($row)
    {
        return empty($row->category) ? "" : $row->category->name;
    }

    public function getCompanyNameAttr($row)
    {
        return empty($row->company) ? "" : $row->company->name;
    }

    public function getSupervisorNameAttr($row)
    {
        return empty($row->supervisor) ? "" : $row->supervisor->name;
    }

    public function getTypeNameAttr($row)
    {
        switch ($row->type) {
            case 1:
                return '小队长';
                break;
            case 2:
                return '大队长';
                break;
            default:
                return '队员';
        }
    }

    public function getAppStatusAttr($row)
    {
        switch ($row->app_status) {
            case 0:
                return "禁用";
            case 1:
                return "启用";
            default:
                return '-';
                break;
        }
    }

    public function getIdentityTypeAttr($row)
    {
        switch ($row->identity_type) {
            case 0:
                return "小B";
            case 1:
                return "大B";
        }
    }

    protected function getScoreAttr($row)
    {
        return ($row->count_assess == 0)
            ? "0"
            : (string)round(
                $row->sum_score / $row->count_assess,
                1
            );
    }


    public function getCarTypeAttr($row)
    {
        return empty($row->carType) ? "" : $row->carType->name;
    }


    public function getCompleteCountAttr($row)
    {
        return empty($row->driverSub) ? "0" : (string)$row->driverSub->complete_count;
    }


    public function getWorkCountAttr($row)
    {
        return empty($row->driverSub) ? "0" : (string)$row->driverSub->work_count;
    }

    public function getComplaintCountAttr($row)
    {
        return empty($row->driverSub) ? "0": (string)$row->driverSub->complaint_count;
    }


    /**
     * 查询
     * @return array
     * @throws \luffyzhao\laravelTools\Searchs\Exceptions\SearchException
     * @author Mark
     * @date   2018/8/31 15:08
     */
    protected function getAttributes()
    {
        $search = new FinishSearch(
            request()->only(
                [
                    'name',
                    'phone',
                    'idcard',
                    'category_id',
                    'type',
                    'company_id',
                    'driver_type',
                    'supervisor_id',
                    'car_number',
                    'app_status',
                    'status',
                    'driver_type',
                ]
            )
        );
        return $search->toArray();
    }


}