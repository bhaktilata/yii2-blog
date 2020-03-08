<?php

namespace app\models;

use Yii;
use yii\web\uploads\image;
/**
 * This is the model class for table "article".
 *
 * @property int $id
 * @property string $title
 * @property string|null $slug
 * @property string|null $author
 * @property string|null $date
 * @property string $introtext
 * @property string|null $metadesc
 * @property string|null $metakey
 * @property string|null $short
 * @property string|null $content
 * @property string|null $image
 * @property int|null $hits
 * @property int|null $status
 * @property int|null $category_id
 *
 * @property Article $category
 * @property Article[] $articles
 * @property ArticleTag[] $articleTags
 * @property Comment[] $comments
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'introtext', 'content', ], 'required'],
            [['date'], 'date', 'format' => 'php:Y-m-d'],
            [['date'], 'default', 'value' => date('Y-m-d')], //заполняет текущую дату, если поле не заполнено
            [['introtext', 'metadesc', 'metakey', 'short', 'content'], 'string'],
            [['hits', 'status', 'category_id'], 'integer'],
            [['title', 'slug', 'author', 'image'], 'string', 'max' => 255],
            //[['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Article::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['category_id'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'slug' => 'Slug',
            'author' => 'Author',
            'date' => 'Date',
            'introtext' => 'Introtext',
            'metadesc' => 'Metadesc',
            'metakey' => 'Metakey',
            'content' => 'Content',
            'image' => 'Image',
            'category_id' => 'Category ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Article::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticles()
    {
        return $this->hasMany(Article::className(), ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticleTags()
    {
        return $this->hasMany(ArticleTag::className(), ['article_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['article_id' => 'id']);
    }
    
    public function saveImage($filename)
    {
        $this->image = $filename;
        return $this->save(false);
    }
    public function getImage() // отображает картинки в списке статей, форма вывода задаётся в modules/admin/views/article/index.php 
    {
       return ($this->image) ? '/images/' . $this->image : '/images/no-image.png';
       //  return ($this->image) ? '/uploads/' . $this->image : '/no-image.png';
  
       // $source = Yii::getAlias('@web') . 'http://myblog.loc/web/uploads/' . $this->image;
        return $source;
    } 

    public function deleteImage()
    {
        $imageUploadModel = new ImageUpload();
        $imageUploadModel->deleteCurrentImage($this->image);
    }
}
