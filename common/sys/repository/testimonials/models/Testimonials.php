<?php

namespace common\sys\repository\testimonials\models;

use Yii;

/**
 * This is the model class for table "testimonials".
 *
 * @property integer $id
 * @property integer $shopperapproved_id
 * @property string $author
 * @property string $address
 * @property string $field_created_date
 * @property string $body
 * @property integer $rating
 * @property integer $is_top
 * @property string $created_date
 * @property string $update_date
 */
class Testimonials extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'testimonials';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['shopperapproved_id', 'author', 'address', 'field_created_date', 'body', 'rating', 'is_top'], 'required'],
            [['shopperapproved_id', 'rating', 'is_top'], 'integer'],
            [['created_date', 'update_date'], 'safe'],
            [['body'], 'string'],
            [['author', 'address', 'field_created_date'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'shopperapproved_id' => 'Shopperapproved ID',
            'author' => 'Author',
            'address' => 'Address',
            'field_created_date' => 'Created Date',
            'body' => 'Body',
            'rating' => 'Rating',
            'is_top' => 'Is Top Home Page',
            'created_date' => 'Created Date',
            'update_date' => 'Update Date',
        ];
    }
}
