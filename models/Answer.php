<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "answer".
 *
 * @property int $id
 * @property int $id_user
 * @property int $id_theme
 * @property string $name
 * @property string $description
 * @property string $image
 * @property int $status
 * @property int $date
 * @property string|null $after_image
 * @property string|null $after_discription
 *
 * @property Theme $theme
 * @property User $user
 */
class Answer extends \yii\db\ActiveRecord
{
    public $imageFile;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'answer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'id_theme', 'name', 'description', 'image', 'imageFile'], 'required'],
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
            [['id_user', 'id_theme', 'status', 'date'], 'integer'],
            [['description', 'after_discription'], 'string'],
            [['name', 'image', 'after_image'], 'string', 'max' => 255],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['id_user' => 'id']],
            [['id_theme'], 'exist', 'skipOnError' => true, 'targetClass' => Theme::class, 'targetAttribute' => ['id_theme' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Id User',
            'id_theme' => 'Id Theme',
            'name' => 'Name',
            'description' => 'Description',
            'image' => 'Image',
            'imageFile' => 'Image',
            'status' => 'Status',
            'date' => 'Date',
            'after_image' => 'After Image',
            'after_discription' => 'After Discription',
        ];
    }

    /**
     * Gets query for [[Theme]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTheme()
    {
        return $this->hasOne(Theme::class, ['id' => 'id_theme']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'id_user']);
    }

    public function upload()
    {
        $this->image = $this->imageFile->baseName . '.' . $this->imageFile->extension;
        if ($this->validate()) {
            $this->imageFile->saveAs('../web/uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            $this->save(false);
            return true;
        } else {
            return false;
        }
    }
}
