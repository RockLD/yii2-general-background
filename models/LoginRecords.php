<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "login_records".
 *
 * @property int $id
 * @property string $login_account
 * @property string $login_ip 登录ip
 * @property string $result 结果
 * @property string $login_time 登录时间
 */
class LoginRecords extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'login_records';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['login_account', 'login_ip', 'result', 'login_time'], 'required'],
            [['login_time'], 'safe'],
            [['login_account', 'result'], 'string', 'max' => 100],
            [['login_ip'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'login_account' => 'Login Account',
            'login_ip' => 'Login Ip',
            'result' => 'Result',
            'login_time' => 'Login Time',
        ];
    }

    public static function add($account,$ip,$result)
    {
        $params = [
            'login_account'=>$account,
            'login_ip'=>$ip,
            'result'=>$result,
            'login_time'=>date("Y-m-d H:i:s")
        ];

        $obj = new self();
        $obj->setAttributes($params);
        return $obj->save();
    }
}
