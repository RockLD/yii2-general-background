<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "admins".
 *
 * @property int $admin_id
 * @property string $account 用户名
 * @property string $nickname 昵称
 * @property string $password 密码
 * @property string $email 邮箱
 * @property string $phone 手机号
 * @property int $role_id 角色id
 * @property string $head_img 头像
 * @property string $status 状态
 * @property string $create_at 创建时间
 * @property string $update_at 更新时间
 * @property int $create_admin_id 创建人
 * @property int $update_admin_id 更新人
 */
class Admins extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admins';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account', 'password', 'role_id', 'status', 'create_at', 'create_admin_id'], 'required'],
            [['role_id', 'create_admin_id', 'update_admin_id'], 'integer'],
            [['create_at', 'update_at'], 'safe'],
            [['account', 'nickname', 'email', 'head_img'], 'string', 'max' => 100],
            [['password'], 'string', 'max' => 32],
            [['phone'], 'string', 'max' => 15],
            [['status'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'admin_id' => 'Admin ID',
            'account' => 'Account',
            'nickname' => 'Nickname',
            'password' => 'Password',
            'email' => 'Email',
            'phone' => 'Phone',
            'role_id' => 'Role ID',
            'head_img' => 'Head Img',
            'status' => 'Status',
            'create_at' => 'Create At',
            'update_at' => 'Update At',
            'create_admin_id' => 'Create Admin ID',
            'update_admin_id' => 'Update Admin ID',
        ];
    }

    /**
     * 根据账号获取管理员信息
     * @param $account
     * @return array|\yii\db\ActiveRecord|null
     */
    public static function getInfoByAccount($account)
    {
        return self::find()->where(['account'=>$account])->asArray()->one();
    }
}
