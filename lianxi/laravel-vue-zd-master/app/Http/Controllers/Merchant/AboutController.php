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
 * Class AboutController
 * @package App\Http\Controllers\Merchant
 */
class AboutController extends Controller
{


    public function index($title)
    {
        $file = storage_path('markdown/').$title.'.md';
        if (file_exists($file)) {
            $parser = new \HyperDown\Parser();
            $content = $parser->makeHtml(file_get_contents($file));

            return view($title, ['content' => $content]);

        }
    }

}

?>