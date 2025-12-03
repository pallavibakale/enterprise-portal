<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "client".
 *
 * @property int $id
 * @property string $name
 * @property string $contact_email
 * @property int $created_at
 * @property int $updated_at
 */
class Client extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%client}}';
    }

    public function rules()
    {
        return [
            [['name', 'contact_email'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['name', 'contact_email'], 'string', 'max' => 255],
            [['contact_email'], 'email'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'contact_email' => 'Contact Email',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        $time = time();
        if ($this->isNewRecord) {
            $this->created_at = $time;
        }
        $this->updated_at = $time;

        return true;
    }
}
