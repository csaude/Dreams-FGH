<?php


namespace frontend\assets;

use yii\web\AssetBundle;

class MaterialAsset extends AssetBundle{
    public $sourcePath='@themes/material';
    public $baseUrl = '@web';
    
    public $css=[
        'css/material-wfont.min.css',
        'css/material.min.css',
        'css/ripples.min.css',
        'css/style.css',
    ];
    public $js=[
        'js/material.min.js',
        'js/ripples.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        
    ];
    
  
    
}
/*class MaterialAsset extends AssetBundle{
    public $sourcePath='@themes/materialize';
    public $baseUrl = '@web';
    
    public $css=[
        'css/materialize.css',
        'css/page-center.css',
        'css/prism.css',
        'css/style.css',
    ];
    public $js=[
        'js/jquery-1.11.2.js',
        'js/materialize.js',
        'js/materialize.min.js',
        'js/plugins.js',
        'js/prism.js',
        'js/raphael.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        
    ];    
}*/
