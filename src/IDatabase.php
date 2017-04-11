<?php
namespace wirwolf\yii2DebugFrontend\Transports\Databases;

/**
 * Created by IntelliJ IDEA.
 * User: wir_wolf
 * Date: 10.04.17
 * Time: 22:41
 */
interface IDatabase
{
    /**
     * @param $tag
     * @param $summary
     * @param $data
     * @return mixed
     */
    public function save($tag, $summary, $data);

    /**
     * @param $filter
     * @param $limit
     * @return mixed
     */
    public function getSummery($filter, $limit);

    public function getTabInfoByTag($tag, $tab);
}