<?php

namespace common\sys\repository\landing\models;

use Yii;

/**
 * This is the model class for table "airline".
 *
 * @property integer $id
 * @property string $description
 * @property string $keywords
 * @property string $name
 * @property string $alias
 * @property string $title
 * @property string $summary
 * @property string $body_column_1
 * @property string $body_column_2
 * @property string $created_date
 * @property string $update_date
 * @property string $browser_title
 * @property string $sub_title
 */
class Airline extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'airline';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[
                'description',
                'keywords',
                'name',
                'alias',
                'title',
                'summary',
                'body_column_1',
                'body_column_2',
                'browser_title'
            ], 'required'],
            [['description', 'keywords', 'summary', 'body_column_1', 'body_column_2'], 'string'],
            [['created_date', 'update_date'], 'safe'],
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
            'description' => '[SEO] Description',
            'keywords' => '[SEO] Keywords',
            'name' => 'Name',
            'alias' => 'Alias',
            'title' => 'Title',
            'summary' => 'Summary',
            'body_column_1' => 'Body Column First',
            'body_column_2' => 'Body Column Second',
            'created_date' => 'Created Date',
            'update_date' => 'Update Date',
            'browser_title' => 'Browser Title',
            'sub_title' => 'Sub Title',
        ];
    }
}
