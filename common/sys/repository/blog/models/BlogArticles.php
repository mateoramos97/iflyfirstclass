<?php

namespace common\sys\repository\blog\models;

use Yii;

/**
 * This is the model class for table "blog_articles".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $keywords
 * @property string $alias
 * @property string $posted
 * @property string $summary
 * @property string $body_column_1
 * @property string $body_column_2
 * @property string $update_date
 * @property integer $is_top
 * @property integer $is_top_list
 * @property string $browser_title
 */
class BlogArticles extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blog_articles';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[
                'title',
                'description',
                'keywords',
                'alias',
                'summary',
                'body_column_1',
                'body_column_2',
                'browser_title'
            ], 'required'],
            //['alias', 'unique'],
            [['posted', 'update_date'], 'safe'],
            [['description', 'keywords', 'summary', 'body_column_1', 'body_column_2'], 'string'],
            [['is_top', 'is_top_list'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['alias', 'browser_title'], 'string', 'max' => 100],
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
            'title' => 'Title',
            'alias' => 'Alias',
            'posted' => 'Posted',
            'summary' => 'Summary',
            'body_column_1' => 'Body Column First',
            'body_column_2' => 'Body Column Second',
            'update_date' => 'Update Date',
            'is_top' => 'Is Top',
            'is_top_list' => 'Is Top List',
            'browser_title' => 'Browser Title',
        ];
    }
}
