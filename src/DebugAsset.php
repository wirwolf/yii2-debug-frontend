<?php
/**
 * Created by IntelliJ IDEA.
 * User: andru
 * Date: 11.04.17
 * Time: 15:01
 */

namespace wirwolf\yii2DebugFrontend;

use yii\web\AssetBundle;

/**
 * Class DebugAsset
 * @package wirwolf\yii2DebugFrontend
 */
class DebugAsset extends AssetBundle
{

    public $sourcePath = __DIR__ . '/Assets';

    public $css = [
        'main.css',
        'toolbar.css',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}