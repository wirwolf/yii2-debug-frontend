<?php

namespace wirwolf\yii2DebugFrontend\Panels;
/**
 * Created by IntelliJ IDEA.
 * User: wir_wolf
 * Date: 11.04.17
 * Time: 21:34
 */
interface IPanel
{
    /**
     * @return mixed
     */
    public function getAlias();

    public function getName();
}