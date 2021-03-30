<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ohrm_job_title".
 *
 * @property integer $id
 * @property string $job_title
 * @property string $job_description
 * @property string $note
 * @property integer $is_deleted
 */
class TituloProfissional extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ohrm_job_title';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'job_title'], 'required'],
            ['name', 'unique'],
            [['id', 'is_deleted'], 'integer'],
            [['job_title'], 'string', 'max' => 100],
            [['job_description', 'note'], 'string', 'max' => 400],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'job_title' => 'Título Prof.',
            'job_description' => 'Job Description',
            'note' => 'Note',
            'is_deleted' => 'Is Deleted',
        ];
    }
}
