<?php

namespace app\models;

use Yii;
use dektrium\user\models\Profile;
/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property string $name
 * @property integer $provin_code
 * @property integer $city_code
 * @property integer $localidade_id
 * @property integer $us_id
 * @property integer $parceiro_id
 * @property string $user_location2
 * @property string $password_hash
 * @property string $auth_key
 * @property string $password_reset_token
 * @property integer $role
 * @property integer $status
 * @property string $district_code
 * @property integer $ccord_id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $confirmed_at
 * @property integer $blocked_at
 * @property string $confirmation_token
 * @property integer $confirmation_sent_at
 * @property string $unconfirmed_email
 * @property string $recovery_token
 * @property integer $recovery_sent_at
 * @property integer $registered_from
 * @property integer $logged_in_from
 * @property integer $logged_in_at
 * @property string $registration_ip
 */
class Utilizadores extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'email'], 'required'],
            [['provin_code', 'city_code', 'localidade_id',  'parceiro_id', 'role', 'status', 'ccord_id', 'confirmed_at', 'blocked_at', 'confirmation_sent_at','entry_point', 'recovery_sent_at', 'registered_from', 'logged_in_from', 'logged_in_at'], 'integer'],
			     [['us_id'], 'safe'],
            [['username', 'email', 'password_hash', 'password_reset_token', 'unconfirmed_email', 'registration_ip'], 'string', 'max' => 255],
            [['name'], 'string', 'max' => 200],
            [['user_location2'], 'string', 'max' => 100],
            [['auth_key', 'recovery_token'], 'string', 'max' => 32],
            [['district_code'], 'string', 'max' => 11],
            [['created_at', 'updated_at', 'confirmation_token','phone_number','phone_number2'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'email' => Yii::t('app', 'Email'),
            'name' => Yii::t('app', 'Nome de Utilizador'),
            'provin_code' => Yii::t('app', 'Província'),
            'city_code' => Yii::t('app', 'Cidade'),
            'localidade_id' => Yii::t('app', 'Localidade'),
            'us_id' => Yii::t('app', 'Ponto de Referencia'),
            'parceiro_id' => Yii::t('app', 'Parceiro'),
            'entry_point'=>Yii::t('app', 'Ponto de Entrada'),
            'user_location2' => Yii::t('app', 'User Location2'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'password_reset_token' => Yii::t('app', 'Password Reset Token'),
            'role' => Yii::t('app', 'Tipo de Utilizador'),
            'status' => Yii::t('app', 'Estado de Utilizador'),
            'district_code' => Yii::t('app', 'Distrito'),
            'ccord_id' => Yii::t('app', 'É Coordenador'),
			'phone_number' => Yii::t('app', 'Contacto'),
			'phone_number2' => Yii::t('app', 'Contacto Alt'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'confirmed_at' => Yii::t('app', 'Confirmed At'),
            'blocked_at' => Yii::t('app', 'Blocked At'),
            'confirmation_token' => Yii::t('app', 'Confirmation Token'),
            'confirmation_sent_at' => Yii::t('app', 'Confirmation Sent At'),
            'unconfirmed_email' => Yii::t('app', 'Unconfirmed Email'),
            'recovery_token' => Yii::t('app', 'Recovery Token'),
            'recovery_sent_at' => Yii::t('app', 'Recovery Sent At'),
            'registered_from' => Yii::t('app', 'Registered From'),
            'logged_in_from' => Yii::t('app', 'Logged In From'),
            'logged_in_at' => Yii::t('app', 'Logged In At'),
            'registration_ip' => Yii::t('app', 'Registration Ip'),
        ];
    }

      /*     public function beforeSave($insert) {
  

    if ($this->isNewRecord) { 
        
     $this->criado_em=date("Y-m-d H:m:s"); 
     $this->criado_por=Yii::$app->user->identity->id;
     $this->user_location=Yii::$app->request->userIP;
   
    } 
    else 
        {
       $this->actualizado_em=date("Y-m-d H:m:s");
        $this->actualizado_por=Yii::$app->user->identity->id;
        $this->user_location2=Yii::$app->request->userIP;
       
        }
    return parent::beforeSave($insert); 
}*/
	
    public function getBeneficiarios()
    {
        return $this->hasMany(Beneficiarios::className(), ['id' => 'criado_por']);
    }
  
	public function getProvincia()
{
 return $this->hasOne(Provincias::className(), ['id' => 'provin_code']);
}

    public function getDistrito()
{
 return $this->hasOne(Distritos::className(), ['district_code' => 'district_code']);
}

    public function getUs()
{
 return $this->hasOne(Us::className(), ['id' => 'us_id']);
}

    public function getCidade()
{
 return $this->hasOne(ComiteCidades::className(), ['id' => 'city_code']);
}

public function getLocalidade()
  {
      return $this->hasOne(ComiteLocalidades::className(), ['id' => 'localidade_id']);
  }

  public function getParceiro()
 {
     return $this->hasOne(Organizacoes::className(), ['id' => 'parceiro_id']);
 }
	 public function getNome()
{
    return $this->hasOne(Profile::className(), ['user_id' => 'id']);
}
	
}
