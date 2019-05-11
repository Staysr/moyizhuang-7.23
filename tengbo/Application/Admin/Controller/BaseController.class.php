<?php
namespace Admin\Controller;
use Think\Controller;
class BaseController extends Controller {
//    //公钥
//    const RSA_PUBLIC = '-----BEGIN PUBLIC KEY-----
//MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCbPkzY1xPRZefLOy/K5ydrIPI0
//xKgVqGtr3JFXMpXyBiKSNlF5bmkwt+EqZZ6lvSmSR2L0pA52ScbNWBblVzBIXBq/
//T0MST7fGBCkJf3hHjDpJyXKojq9dzpo/vINxwYSr8xgvGOL6uXhQR4BJikKVFDRV
//KEvAKN8ESruBffGtFQIDAQAB
//-----END PUBLIC KEY-----
//';
//    //私钥
//    const RSA_PRIVATE = '-----BEGIN ENCRYPTED PRIVATE KEY-----
//MIICxjBABgkqhkiG9w0BBQ0wMzAbBgkqhkiG9w0BBQwwDgQIWYnNv62J+4gCAggA
//MBQGCCqGSIb3DQMHBAhic43+Edm3KwSCAoAcIHTfIg6tJR3nRs2kk0USZ3+ga5LI
//39OxFrClDF+Uw+tQhu5px/g//AzHAZgj3MJ3J4qpkbHiZ8Zd9uAGSJ6yFE/i27IG
//zCn1VjooCSl7B0rVDZKJt9XLLfrsKsgb9xm0S5uyYbDsxZWQihR3s4oohfQLKwST
//X3j4Fei2h4JRpKt5s2QKFphvI4D6iqV25HSxCguL7k6rCBjJotTQPiKpQmiHJo+2
//3ubuaUxnPA2boK5kiZR4safTxmkEEDPHfin/vbgDJ2FImiz1FrdjjMGQEAS3FXYt
//hrzvTYo/DQWaeg3tZZodJPxzmHhEUsVYuhvAEv4kpZ3IIdHi4se73d3vft5v23kO
//xhdHAkWZaUm+EsmpeUCFHeavZ4GAXNBgcNqGh5q6thESSg+PHSD6kFe9KE/6DIbk
//5LDPvKVBNP2rvNNGLk01VaM5oPxJIVKfONBXzYJBHQRtWs/udjrzpZsQl/Nng/Wx
//EP5h/U9W2yvES/fnXiRuIq8YU0rTMgWre1K/4oTnrJ4PdaNEYolmGo0rfRsipB2p
//snkzzB2eDV4xBIfXLo0KH4ARw71a4o4DtdjYUduvW/B4l6XIqxZ797OJDTQbJrE0
//+M/ZDlO+zU/I0VXeYGEGvTvLAOn0H/s2Jq9tpk2As4HDHrKRzbS8qmjKWguabivp
//atMVfpKyOfvfbEO90hYa74DueHO4i0J1TWyX8PndqODCRxT71zH5HBbasfdAJf1o
//Mxqw6EyppNiTGiZVFpCLWOOPiwP74YDglMYfpGEmW+N95J/CVPiu6Ozn/e0jXDvI
//eBqmXzLttQ/yiKOD9DG1w8MJ6dQNgIT1nt6uzomrmN/wSxIIHYAF9Avr
//-----END ENCRYPTED PRIVATE KEY-----
//';

	public function _initialize() {
		if (!session('admin')){
			$this->redirect('Login/login');
			die();
		} 
	}

    /**
     * 上传图片 - Lw
     */
    public function upload($file,$url){
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     314572800;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =     './Public/upload/'.$url; // 设置附件上传根目录
        // 上传单个文件
        $info   =   $upload->uploadOne($file);
        if(!$info) {// 上传错误提示错误信息
            $this->error($upload->getError());
        }else{// 上传成功 获取上传文件信息
            return '/tengbo/Public/upload/'.$url.$info['savepath'].$info['savename'];
        }
    }
	
	//导出
	public function exportExcel($expTitle,$expCellName,$expTableData){
        $xlsTitle = iconv('utf-8', 'gb2312', $expTitle);//文件名称
        $fileName = $expTitle.date('_YmdHis');//or $xlsTitle 文件名称可根据自己情况设定
        $cellNum = count($expCellName);
        $dataNum = count($expTableData);

        vendor("PHPExcel.PHPExcel");
            
        $objPHPExcel = new \PHPExcel();
        $cellName = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ');

        $objPHPExcel->getActiveSheet(0)->mergeCells('A1:'.$cellName[$cellNum-1].'1');//合并单元格
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', $expTitle.'  导出时间:'.date('Y-m-d H:i:s'));
        for($i=0;$i<$cellNum;$i++){
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellName[$i].'2', $expCellName[$i][1]);
        }
        // Miscellaneous glyphs, UTF-8
        for($i=0;$i<$dataNum;$i++){
            for($j=0;$j<$cellNum;$j++){
                $objPHPExcel->getActiveSheet(0)->setCellValue($cellName[$j].($i+3), $expTableData[$i][$expCellName[$j][0]]);
            }
        }
        //清空缓冲区 防止乱码
		ob_end_clean();
        header('pragma:public');
        header('Content-type:application/vnd.ms-excel;charset=utf-8;name="'.$xlsTitle.'.xls"');
        header("Content-Disposition:attachment;filename=$fileName.xls");//attachment新窗口打印inline本窗口打印
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        exit;
    }



}
