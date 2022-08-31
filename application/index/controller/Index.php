<?php

namespace app\index\controller;

use app\common\controller\Frontend;
use app\admin\model\blog\Artical as ArticalModel;

class Index extends Frontend
{

    protected $noNeedLogin = '*';
    protected $noNeedRight = '*';
    protected $layout = '';

    public function index()
    {   
        
        $key = input('tittle');
        $map = [];
        if($key) {
            $map['tittle']=['like','%'.$key.'%'];
        }
        $list = ArticalModel::order('id','desc')->where($map)->paginate([   
            'list_rows'         =>5,
            'query'             => request()->param()
        ]);

        $good = ArticalModel::order('likes','desc')->limit(5)->select();

        $this->assign([
            'list' => $list,
            'good'  =>$good,
        ]);
        
        return $this->view->fetch();
    }
}
