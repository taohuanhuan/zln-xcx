<?php
namespace app\api\controller;

use app\common\controller\Api;
use think\Db;

class Messages extends Api
{
    protected $noNeedLogin = [];
    protected $noNeedRight = '*';

    /**
     * 返回表单选项
     */
    public function options()
    {
        $data = [
            'incomeOptions'   => ['<5k', '5-10k', '10-20k', '20k+'],
            'hobbyOptions'    => ['跑步', '旅行', '阅读', '健身', '电影'],
            'lifestyleOptions'=> ['抽烟', '饮酒', '不熬夜', '爱干净', '信佛'],
        ];
        return json(['code' => 1, 'msg' => 'ok', 'data' => $data]);
    }

    /**
     * 获取当前用户信息
     */
    public function info()
    {
        $row = Db::table('yly_user_profile', false)
            ->where('user_id', $this->auth->id)
            ->find();
        if ($row) {
            $row['hobbies']       = $row['hobbies'] ? json_decode($row['hobbies'], true) : [];
            $row['lifestyle']     = $row['lifestyle'] ? json_decode($row['lifestyle'], true) : [];
            $row['addPoints']     = $row['add_points'] ? json_decode($row['add_points'], true) : [];
            $row['cannotAccept']  = $row['cannot_accept'] ? json_decode($row['cannot_accept'], true) : [];
        }
        return json(['code' => 1, 'msg' => 'ok', 'data' => $row]);
    }

    /**
     * 保存信息
     */
    public function save()
    {
        $data = [
            'nickname'       => $this->request->post('nickname'),
            'id_card'        => $this->request->post('idCard'),
            'wechat'         => $this->request->post('wechat'),
            'region_label'   => $this->request->post('regionLabel'),
            'region_code'    => $this->request->post('regionCode'),
            'marital_status' => $this->request->post('maritalStatus'),
            'has_child'      => $this->request->post('hasChild'),
            'income_range'   => $this->request->post('incomeRange'),
            'has_car'        => $this->request->post('hasCar'),
            'has_house'      => $this->request->post('hasHouse'),
            'hobbies'        => json_encode($this->request->post('hobbies/a', [])),
            'lifestyle'      => json_encode($this->request->post('lifestyle/a', [])),
            'add_points'     => json_encode($this->request->post('addPoints/a', [])),
            'cannot_accept'  => json_encode($this->request->post('cannotAccept/a', [])),
            'updatetime'     => date('Y-m-d H:i:s'),
        ];

        $exists = Db::table('yly_user_profile', false)
            ->where('user_id', $this->auth->id)
            ->find();
        if ($exists) {
            Db::table('yly_user_profile', false)
                ->where('user_id', $this->auth->id)
                ->update($data);
        } else {
            $data['user_id'] = $this->auth->id;
            $data['createtime'] = date('Y-m-d H:i:s');
            Db::table('yly_user_profile', false)->insert($data);
        }
        return json(['code'=>1,'msg'=>'保存成功','data'=>null]);
    }
}
