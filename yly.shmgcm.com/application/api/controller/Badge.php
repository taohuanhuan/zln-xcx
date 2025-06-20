<?php
namespace app\api\controller;

use app\common\controller\Api;
use think\Db;

class Badge extends Api
{
    protected $noNeedLogin = [];
    protected $noNeedRight = '*';

    // 所有徽章列表
    public function list()
    {
        $rows = Db::table('yly_badge', false)
            ->field('id,name,description,icon')
            ->order('id asc')
            ->select();
        return json(['code'=>1,'msg'=>'ok','data'=>$rows]);
    }

    // 当前用户已领取徽章
    public function my()
    {
        $userId = $this->auth->id;
        $rows = Db::table('yly_user_badge', false)->alias('ub')
            ->join(['yly_badge'=>'b'],'ub.badge_id=b.id')
            ->where('ub.user_id', $userId)
            ->field('b.id,b.name,b.description,b.icon,ub.get_time,ub.mood')
            ->order('ub.id desc')
            ->select();
        return json(['code'=>1,'msg'=>'ok','data'=>$rows]);
    }

    // 领取徽章
    public function claim()
    {
        $badgeId = $this->request->post('badge_id');
        $mood    = $this->request->post('mood','');
        $timeStr = $this->request->post('get_time');
        if(!$badgeId){
            return json(['code'=>0,'msg'=>'缺少参数','data'=>null]);
        }
        $userId = $this->auth->id;
        Db::startTrans();
        try {
            $exists = Db::table('yly_user_badge', false)
                ->where('user_id',$userId)
                ->where('badge_id',$badgeId)
                ->lock(true)
                ->find();
            if($exists){
                Db::rollback();
                return json(['code'=>0,'msg'=>'已领取该徽章','data'=>null]);
            }
            $getTime = $timeStr ? date('Y-m-d H:i:s', intval($timeStr) / 1000) : date('Y-m-d H:i:s');
            Db::table('yly_user_badge', false)->insert([
                'user_id'   => $userId,
                'badge_id'  => $badgeId,
                'mood'      => $mood,
                'get_time'  => $getTime,
                'createtime'=> date('Y-m-d H:i:s'),
            ]);
            Db::commit();
            return json(['code'=>1,'msg'=>'领取成功','data'=>null]);
        } catch(\Exception $e){
            Db::rollback();
            return json(['code'=>0,'msg'=>'领取失败: '.$e->getMessage(),'data'=>null]);
        }
    }
}
