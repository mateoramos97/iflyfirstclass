<?php

namespace common\sys\repository\landing\models;

use Yii;

/**
 * This is the model class for table "continent".
 *
 * @property integer $id
 * @property string $browser_title
 * @property string $description
 * @property string $keywords
 * @property string $name
 * @property string $alias
 * @property string $title
 * @property string $sub_title
 * @property string $summary
 * @property string $body_column_1
 * @property string $body_column_2
 * @property integer $first_class_price
 * @property integer $business_class_price
 * @property integer $first_class_old_price
 * @property integer $business_class_old_price
 * @property string $created_date
 * @property string $update_date
 */
class Continent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'continent';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[
                'browser_title',
                'description',
                'keywords',
                'name',
                'alias',
                'title',
                'sub_title',
                'summary',
                'body_column_1',
                'body_column_2',
                'first_class_price',
                'business_class_price',
                'first_class_old_price',
                'business_class_old_price'
            ], 'required'],
            [['description', 'keywords', 'summary', 'body_column_1', 'body_column_2'], 'string'],
            [['created_date', 'update_date'], 'safe'],
            [[
                'first_class_price',
                'business_class_price',
                'first_class_old_price',
                'business_class_old_price'
            ], 'integer'],
            [['name', 'alias', 'browser_title'], 'string', 'max' => 100],
            [['title', 'sub_title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'browser_title' => 'Browser Title',
            'description' => '[SEO] Description',
            'keywords' => '[SEO] Keywords',
            'name' => 'Name',
            'alias' => 'Alias',
            'title' => 'Title',
            'sub_title' => 'Sub Title',
            'summary' => 'Summary',
            'body_column_1' => 'Body Column First',
            'body_column_2' => 'Body Column Second',
            'first_class_price' => 'First Class Price',
            'business_class_price' => 'Business Class Price',
            'first_class_old_price' => 'First Class Old Price',
            'business_class_old_price' => 'Business Class Old Price',
            'created_date' => 'Created Date',
            'update_date' => 'Update Date',
        ];
    }
}
