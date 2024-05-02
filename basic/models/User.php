<?php

namespace app\models;

//class User extends \yii\base\BaseObject implements \yii\web\IdentityInterface
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class User extends ActiveRecord implements \yii\web\IdentityInterface
{
    public function rules()
    {
        return [
            [['username', 'login'], 'string', 'max' => 64],
            [['password'], 'string', 'max' => 128],
            [['authKey', 'accessToken'], 'string', 'max' => 254],
        ];
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'ФИО',
            'login' => 'Логин',
            'password' => 'Пароль',
            'authKey' => 'Auth Key',
            'accessToken' => 'Access Token',
        ];
    }
    public static function tableName()
    {
        return 'users';
    }
    public function getProjects()
    {
        return $this->hasMany(Projects::class, ['user_id' => 'id']);
    }
    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
//        foreach (self::$users as $user) {
//            if ($user['accessToken'] === $token) {
//                return new static($user);
//            }
//        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return User|array|ActiveRecord|null
     */
    public static function findByUsername($username)
    {
        $user = self::find()->where(['username' => $username])->one();
        return (!empty($user)) ? $user : null;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->authKey = \Yii::$app->security->generateRandomString();
            }
            return true;
        }
        return false;
    }
    public static function getUsersDropDown()
    {
        $users = self::find()
            ->select(['id', 'username'])->all();
        return ArrayHelper::map($users, 'id', 'username');
    }
}
