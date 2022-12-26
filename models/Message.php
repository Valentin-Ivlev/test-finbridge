<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "message".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $author
 * @property string|null $iban
 * @property int|null $release_year
 * @property string|null $cover_image
 */
class Message extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'messages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['text', 'send_at', 'status'], 'required'],
            [['text', 'status'], 'string'],
            [['send_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text' => 'Text',
            'send_at' => 'Send At',
            'status' => 'Status',
        ];
    }
}
