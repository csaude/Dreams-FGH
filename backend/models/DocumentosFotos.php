<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use yii\helpers\Url;
/**
 * This is the model class for table "camarada_documentos_fotos".
 *
 * @property integer $id
 * @property integer $tipos_documentos_id
 * @property integer $emp_number
 * @property string $anexo
 * @property integer $criado_por
 * @property integer $actualizado_por
 * @property string $criado_em
 * @property string $actualizado_em
 * @property string $user_location
 * @property integer $status
 *
 * @property HsHrEmployee $empNumber
 * @property IsdbTiposDocumentos $tiposDocumentos
 * @property User $criadoPor
 * @property User $actualizadoPor
 */
class DocumentosFotos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'frlm_comite_documentos_fotos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status'], 'required'],
            [['tipos_documentos_id', 'emp_number', 'criado_por', 'actualizado_por', 'status'], 'integer'],
            [['criado_em', 'actualizado_em'], 'safe'],
            [['anexo'], 'string', 'max' => 250],
            [['user_location'], 'string', 'max' => 150],
            [['emp_number'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',

            'tipos_documentos_id' => 'Tipo de Foto',
            'emp_number' => 'Utilizador',
            'anexo' => 'Foto',
            'criado_por' => 'Criado Por',
            'actualizado_por' => 'Actualizado Por',
            'criado_em' => 'Criado Em',
            'actualizado_em' => 'Actualizado Em',
            'user_location' => 'User Location',
            'status' => 'Status',
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->anexo->saveAs('img/profiles/camarada_'.date("Ymd").utf8_encode($this->anexo->baseName . '.' . $this->anexo->extension));
            return true;
        } else {
            return false;
        }
    }
    

public function beforeSave($insert) {
    $model = new DocumentosFotos();

$fileupload = UploadedFile::getInstance($model, 'anexo');

  if(!empty($fileupload))   {   

//$fileupload->saveAs('/img/profiles/camarada_' . $fileupload->baseName . '.' . $fileupload->extension);
$fileupload->saveAs('img/profiles/camarada_'.sha1(Yii::$app->user->identity->id)."_".date("Ymd").UploadedFile::getInstance($model, 'anexo'));      
$this->anexo ="camarada_".sha1(Yii::$app->user->identity->id)."_".date("Ymd").UploadedFile::getInstance($model, 'anexo');
            if ($model->upload()) {
                // file is uploaded successfully
               $model->save();
            } } else {} 

//include('assets/ipc.php'); 
    if ($this->isNewRecord) {   
     $this->criado_em=date("Y-m-d H:m:s"); 
     $this->criado_por=Yii::$app->user->identity->id;
     $this->user_location=Yii::$app->request->userIP;
     $this->tipos_documentos_id =10; 
    } 
    else 
        {
        $this->actualizado_em=date("Y-m-d H:m:s");
        $this->actualizado_por=Yii::$app->user->identity->id;
        $this->user_location=Yii::$app->request->userIP;
        $this->tipos_documentos_id =10;  }
    return parent::beforeSave($insert); 
}

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmpNumber()
    {
        return $this->hasOne(Membros::className(), ['id' => 'emp_number']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTiposDocumentos()
    {
        return $this->hasOne(TiposDocumentos::className(), ['id' => 'tipos_documentos_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCriadoPor()
    {
        return $this->hasOne(User::className(), ['id' => 'criado_por']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActualizadoPor()
    {
        return $this->hasOne(User::className(), ['id' => 'actualizado_por']);
    }
}
