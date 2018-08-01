<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;


/**
 * This is the model class for table "noticia".
 *
 * @property int $id
 * @property string $titulo
 * @property string $contenido
 * @property int $tag
 * @property string $imagen
 */
class Noticia extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'noticia';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['titulo', 'contenido', 'tag', 'imagen'], 'required'],
            [['contenido', 'imagen'], 'string'],
            [['tag'], 'integer'],
            [['titulo'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'titulo' => 'Titulo de la noticia',
            'contenido' => 'Contenido de la noticia',
            'tag' => 'Tag',
            'imagen' => 'URL de la imagen',
        ];
    }
}
