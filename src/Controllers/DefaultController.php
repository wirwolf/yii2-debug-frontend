<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace wirwolf\yii2DebugFrontend\Controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\debug\models\search\Debug;
use yii\web\Response;

/**
 * Debugger controller
 *
 */
class DefaultController extends Controller
{

    /**
     * @inheritdoc
     */
    public $layout = 'main';

    /**
     * @var \yii\debug\Module
     */
    public $module;

    /**
     * @var array the summary data (e.g. URL, time)
     */
    public $summary;


    public function actionIndex() {
        //$searchModel = new Debug();
        //$dataProvider = $searchModel->search($_GET, $this->getManifest());

        // load latest request
        //$tags = array_keys($this->getManifest());
        //$tag = reset($tags);
        //$this->loadData($tag);

        return $this->render('index', [
            'panels'       => $this->module->panels,
            'dataProvider' => [],
            'searchModel'  => [],
            'manifest'     => [],
        ]);
    }

    /**
     * @inheritdoc
     */
    /*public function actions() {
        $actions = [];
        foreach ($this->module->panels as $panel) {
            $actions = array_merge($actions, $panel->actions);
        }

        return $actions;
    }

    public function beforeAction($action) {
        Yii::$app->response->format = Response::FORMAT_HTML;
        return parent::beforeAction($action);
    }



    public function actionView($tag = null, $panel = null) {
        if ($tag === null) {
            $tags = array_keys($this->getManifest());
            $tag = reset($tags);
        }
        $this->loadData($tag);
        if (isset($this->module->panels[$panel])) {
            $activePanel = $this->module->panels[$panel];
        } else {
            $activePanel = $this->module->panels[$this->module->defaultPanel];
        }

        return $this->render('view', [
            'tag'         => $tag,
            'summary'     => $this->summary,
            'manifest'    => $this->getManifest(),
            'panels'      => $this->module->panels,
            'activePanel' => $activePanel,
        ]);
    }

    public function actionToolbar($tag) {
        $this->loadData($tag, 5);

        return $this->renderPartial('toolbar', [
            'tag'      => $tag,
            'panels'   => $this->module->panels,
            'position' => 'bottom',
        ]);
    }

    public function actionDownloadMail($file) {
        $filePath = Yii::getAlias($this->module->panels['mail']->mailPath) . '/' . basename($file);

        if ((mb_strpos($file, '\\') !== false || mb_strpos($file, '/') !== false) || !is_file($filePath)) {
            throw new NotFoundHttpException('Mail file not found');
        }

        return Yii::$app->response->sendFile($filePath);
    }

    private $_manifest;

    protected function getManifest($forceReload = false) {
        return [];
    }

    public function loadData($tag, $maxRetry = 0) {
    }*/
}
