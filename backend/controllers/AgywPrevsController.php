<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use app\models\AgywPrev;
use app\models\Provincias;
use app\models\Distritos;

class AgywPrevsController extends Controller
{
    public function actionCreate()
    {
        $model = new AgywPrev();
       // $modelCanSave = false;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $province = Provincias::find()
                    ->where(['id' => $model->province_code])->one();

            $district = Distritos::find()
                    ->where(['district_code' => $model->district_code])->one();

            return $this->render('view', [
                'model' => $model,
                'province' => $province->province_name,
                'district' => $district->district_name,
            ]);
        }
        
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionLists($id)
    {
        $countDistritos = Distritos::find()
            ->where(['province_code' => $id])
            ->count();
        $Distritos  = Distritos::find()
            ->where(['province_code' => $id])
            ->all();
        echo "<option>-</option>";
        if ($countDistritos > 0) {
            foreach ($Distritos as $distrito) {
                echo "<option value='" . $distrito->district_code . "'>" . $distrito->district_name . "</option>";
            }
        } else {
            echo "<option>-</option>";
        }
    }
}