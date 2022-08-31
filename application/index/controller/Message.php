<?php

namespace app\index\controller;

use app\common\controller\Frontend;
use app\admin\model\blog\Message as MessageModel;
class Message extends Frontend
{

    protected $noNeedLogin = '*';
    protected $noNeedRight = '*';
    protected $layout = '';

    public function index()
    {   
        
        if(request()->isPost()){
            $data=[
                'username'=>input('username'),
                'content'=>input('content'),
                'createtime'=>time(),
            ];


        if(MessageModel::insert($data)){
            return $this->success('留言成功,正在跳转','Message/index');
        }else{
            return $this->success('留言提交失败!','Message/index');
        }
        return;
         }

        $list = MessageModel::order('id','desc')->paginate([   
            'list_rows'         =>7,
        ]);

        $this->assign([
            'list' => $list,
        ]);
        
        return $this->view->fetch();
    }


}
