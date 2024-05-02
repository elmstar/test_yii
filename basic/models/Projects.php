<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "projects".
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $title
 * @property float|null $price
 * @property string|null $date_start
 * @property string|null $deadline
 *
 * @property User $user
 */
class Projects extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projects';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id'], 'integer'],
            [['price'], 'number'],
            [['date_start', 'deadline'], 'safe'],
            [['title'], 'string', 'max' => 254],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'title' => 'Название',
            'price' => 'Стоимость',
            'date_start' => 'Дата начала',
            'deadline' => 'Дата сдачи',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
    public function getFormatDateStart()
    {
        //dd($this->date_start);
        return ($this->date_start)?date('Y-m-d', strtotime($this->date_start)):'';
    }
    public function getFormatDeadline()
    {
        return ($this->date_start)?date('Y-m-d', strtotime($this->deadline)):'';
    }

}
