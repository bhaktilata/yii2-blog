<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        //'web/css/bootstrap.min.css',
        //'css/bootstrap.css',
        'css/style.css',
        //'css/animate.min.css',
                
    ];
    public $js = [
        //'js/responsiveslides.min.js',
        // 'js/jquery.js',
        //'js/bootstrap.js',
        'js/jquery.flexisel.js',
        //'js/jquery-1.11.1.min.js',
        ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
