<?php

namespace common\sys\repository\seo\models;

use Yii;

/**
 * This is the model class for table "static_page".
 *
 * @property integer $id
 * @property string $title
 * @property string $admin_title
 * @property string $keywords
 * @property string $description
 */
class StaticPage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'static_page';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'admin_title', 'keywords', 'description'], 'required'],
            [['keywords', 'description'], 'string'],
            [['title', 'admin_title'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'admin_title' => 'Title Admin',
            'keywords' => '[SEO] Keywords',
            'description' => '[SEO] Description',
        ];
    }
}
