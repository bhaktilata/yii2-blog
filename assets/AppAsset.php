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

        'css/style-starter.css',
        'css/custom.css',
        '//fonts.googleapis.com/css2?family=Cabin:wght@400;500;600;700&display=swap',
        '//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800&display=swap',
        //'css/site.css',
    ];
    public $js = [

        'js/theme-change.js',
        'js/jquery-3.3.1.min.js',
        'js/bootstrap.min.js',
        'js/main.js',
    ];
    public $depends = [

        'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',

    ];
}
