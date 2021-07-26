<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "app_dream_vw_agyw_prev".
 *
 * @property integer provincia_id
 * @property integer distrito_id
 * @property integer bairro_id
 * @property integer ponto_entrada
 * @property integer organizacao_id
 * @property string  data_registo
 * @property integer beneficiario_id
 * @property string  nui
 * @property integer sexo_id
 * @property integer idade_registo
 * @property integer idade_actual
 * @property string  faixa_registo
 * @property string  faixa_actual
 * @property string  dataNascimento
 * @property string  com_quem_mora
 * @property integer sustenta_casa
 * @property integer vai_escola
 * @property integer tem_deficiencia
 * @property string  tipo_dificiencia
 * @property integer foi_casada
 * @property integer esteve_gravida
 * @property integer tem_filhos
 * @property integer gravida_amamentar
 * @property integer trabalha
 * @property integer teste_hiv
 * @property integer vitima_exploracao_sexual
 * @property integer migrante
 * @property string  vitima_trafico
 * @property integer sexualmente_activa
 * @property integer relacoes_multiplas_cocorrentes
 * @property integer vitima_vbg
 * @property integer trabalhadora_sexo
 * @property integer abuso_alcool_drogas
 * @property integer historico_its
 * @property integer area_servico_id
 * @property integer servico_id
 * @property integer sub_servico_id
 * @property integer pacote_servico_id
 * @property integer ponto_entrada_id
 * @property integer localizacao_id
 * @property string  data_servico
 * @property integer servico_status
 * @property integer vulneravel
 */
class Vw_agyw_prev extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'app_dream_vw_agyw_prev';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['provincia_id', 'distrito_id', 'bairro_id', 'ponto_entrada', 'organizacao_id', 'beneficiario_id', 'sexo_id', 'idade_registo', 'idade_actual', 'sustenta_casa', 'vai_escola', 'tem_deficiencia', 'foi_casada', 'esteve_gravida', 'tem_filhos', 'gravida_amamentar', 'trabalha', 'teste_hiv', 'vitima_exploracao_sexual', 'migrante', 'sexualmente_activa', 'relacoes_multiplas_cocorrentes', 'vitima_vbg', 'trabalhadora_sexo', 'abuso_alcool_drogas', 'historico_its', 'area_servico_id', 'servico_id', 'sub_servico_id', 'pacote_servico_id', 'ponto_entrada_id', 'localizacao_id', 'servico_status','vulneravel'], 'integer'],
            [['data_registo', 'nui', 'faixa_registo', 'faixa_actual', 'dataNascimento', 'com_quem_mora', 'tipo_diciciencia', 'vitima_trafico', 'data_servico'], 'string', 'max' => 250],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            "provincia_id" => Yii::t('app', 'Província'),
            "distrito_id" => Yii::t('app', 'Distrito'),
            "bairro_id" => Yii::t('app', 'Bairro'),
            "ponto_entrada" => Yii::t('app', 'Ponto de Entrada'),
            "organizacao_id" => Yii::t('app', 'Organização'),
            "data_registo" => Yii::t('app', 'Data de Registo no DLT'),
            "beneficiario_id" => Yii::t('app', 'beneficiario'), 
            "nui" => Yii::t('app', 'NUI'),
            "sexo_id" => Yii::t('app', 'Sexo'),
            "idade_registo" => Yii::t('app', 'Idade (no registo)'),
            "idade_actual" => Yii::t('app', 'Idade (Actual)'),
            "faixa_registo" => Yii::t('app', 'Faixa etária (no registo)'),
            "faixa_actual" => Yii::t('app', 'Faixa etária (actual)'),
            "dataNascimento" => Yii::t('app', 'Data de Nascimento'),
            "com_quem_mora" => Yii::t('app', 'Com quem mora'),
            "sustenta_casa" => Yii::t('app', 'Sustenta a casa'),
            "vai_escola" => Yii::t('app', 'Vai à escola'),
            "tem_deficiencia" => Yii::t('app', 'Tem deficiência'),
            "tipo_dificiencia" => Yii::t('app', 'Tipo de deficiência'),
            "foi_casada" => Yii::t('app', 'Já foi casada'),
            "esteve_gravida" => Yii::t('app', 'Já esteve grávida'),
            "tem_filhos" => Yii::t('app', 'Tem filhos'),
            "gravida_amamentar" => Yii::t('app', 'Grávida ou a amamentar'),
            "trabalha" => Yii::t('app', 'Trabalha'),
            "teste_hiv" => Yii::t('app', 'Já fez o teste de HIV'),
            "vitima_exploracao_sexual" => Yii::t('app', 'Vítima de exploração sexual'),
            "migrante" => Yii::t('app', 'Migrante'),
            "vitima_trafico" => Yii::t('app', 'Vítima de tráfico'),
            "sexualmente_activa" => Yii::t('app', 'Sexualmente activa'),
            "relacoes_multiplas_cocorrentes" => Yii::t('app', 'Relações múltiplas e concorrentes'),
            "vitima_vbg" => Yii::t('app', 'Vítima de VBG'),
            "trabalhadora_sexo" => Yii::t('app', 'Trabalhadora de sexo'),
            "abuso_alcool_drogas" => Yii::t('app', 'Abuso de álcool e drogas'),
            "historico_its" => Yii::t('app', 'Histórico de ITS'),
            "area_servico_id" => Yii::t('app', 'Tipo de serviço'),
            "servico_id" => Yii::t('app', 'Serviço'),
            "sub_servico_id" => Yii::t('app', 'Sub-serviço ou Intervenção'),
            "pacote_servico_id" => Yii::t('app', 'Pacote de Serviço'),
            "ponto_entrada_id" => Yii::t('app', 'Ponto de Entrada do Serviço'),
            "localizacao_id" => Yii::t('app', 'Local do Serviço'),
            "data_servico" => Yii::t('app', 'Data do Serviço'),
            "servico_status" => Yii::t('app', 'servico_status'),
            "vulneravel" => Yii::t('app', 'vulneravel'),

        ];
    }
}
