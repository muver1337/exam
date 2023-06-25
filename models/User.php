<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $email
 * @property string $name
 * @property string $surname
 * @property string $password
 * @property int $active
 * @property int $role
 *
 * @property Answer[] $answers
 * @property Theme[] $themes
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    public $password2;

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return null;
    }

    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'name', 'surname', 'password', 'password2'], 'required'],
            ['email', 'email'],
            ['name', 'validateName'],
            ['password2', 'compare', 'compareAttribute' => 'password'],
            [['active', 'role'], 'integer'],
            [['email', 'name', 'surname', 'password'], 'string', 'max' => 255],
            [['email'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'email',
            'name' => 'Name',
            'surname' => 'Surname',
            'password' => 'Password',
            'password2' => 'Повторите пароль',
            'active' => 'Active',
            'role' => 'Role',
        ];
    }

    public function getAnswers()
    {
        return $this->hasMany(Answer::class, ['id_user' => 'id']);
    }

    /**
     * Gets query for [[Themes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getThemes()
    {
        return $this->hasMany(Theme::class, ['id_user' => 'id']);
    }

    public function validatePassword($password)
    {
        return $this->password === md5($password);
    }

    static public function findByUsername($email)
    {
        return self::find()->where(['email'=>$email])->one();
    }

    public function validateName($attr)
    {
        $user = self::find()->where(['name'=>$this ->name])->one();

        if ($user !== null){
            $this->addError($attr, 'Имя занято');
        }
    }

    public function beforeSave($insert)
    {
        $this->password = md5($this->password);
        return true;
    }
}
