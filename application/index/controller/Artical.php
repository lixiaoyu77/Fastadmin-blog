<?php

namespace app\index\controller;

use app\common\controller\Frontend;
use app\admin\model\blog\Artical as ArticalModel;
class Artical extends Frontend
{

    protected $noNeedLogin = '*';
    protected $noNeedRight = '*';
    protected $layout = '';

    public function index()
    {   
        $id = input('id');
        $obj = ArticalModel::where('id',$id)->find();

        $goo = ArticalModel::order('likes','desc')->limit(5)->select();
       
        $this->assign([
            'obj'=>$obj,
            'goo'=>$goo
            ]);
        return $this->view->fetch();
    }

}
