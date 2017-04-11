<?php
namespace wirwolf\yii2DebugFrontend\Transports\Databases;

use yii\base\InvalidConfigException;
use yii\base\Object;
use yii\helpers\FileHelper;

/**
 * Created by IntelliJ IDEA.
 * User: wir_wolf
 * Date: 10.04.17
 * Time: 22:40
 */
class FileDatabase extends Object implements IDatabase
{

    /**
     * @var string the directory storing the debugger data files. This can be specified using a path alias.
     */
    public $dataPath = '@runtime/debug1';

    public $indexFile = '@runtime/debug1/index.data';

    /**
     * @var integer the permission to be set for newly created debugger data files.
     * This value will be used by PHP [[chmod()]] function. No umask will be applied.
     * If not set, the permission will be determined by the current environment.
     * @since 2.0.6
     */
    public $fileMode;

    /**
     * @var integer the permission to be set for newly created directories.
     * This value will be used by PHP [[chmod()]] function. No umask will be applied.
     * Defaults to 0775, meaning the directory is read-writable by owner and group,
     * but read-only for other users.
     * @since 2.0.6
     */
    public $dirMode = 0775;

    /**
     * @var integer the maximum number of debug data files to keep. If there are more files generated,
     * the oldest ones will be removed.
     */
    public $historySize = 200;

    /**
     * @param $tag
     * @param $summary
     * @param $data
     * @return mixed|void
     * @throws InvalidConfigException
     * @throws \yii\base\Exception
     */
    public function save($tag, $summary, $data) {
        $this->dataPath = \Yii::getAlias($this->dataPath);
        FileHelper::createDirectory($this->dataPath, $this->dirMode);
        $dataFile = "$this->dataPath/{$tag}.data";
        file_put_contents($dataFile, serialize($data));
        if ($this->fileMode !== null) {
            @chmod($dataFile, $this->fileMode);
        }


        $this->indexFile = \Yii::getAlias($this->indexFile);
        touch($this->indexFile);
        if (($fp = @fopen($this->indexFile, 'r+')) === false) {
            throw new InvalidConfigException("Unable to open debug data index file: {$this->indexFile}");
        }
        @flock($fp, LOCK_EX);
        $manifest = '';
        while (($buffer = fgets($fp)) !== false) {
            $manifest .= $buffer;
        }
        if (!feof($fp) || empty($manifest)) {
            // error while reading index data, ignore and create new
            $manifest = [];
        } else {
            $manifest = unserialize($manifest);
        }

        $manifest[$tag] = $summary;
        $this->gc($manifest);

        ftruncate($fp, 0);
        rewind($fp);
        fwrite($fp, serialize($manifest));

        @flock($fp, LOCK_UN);
        @fclose($fp);

        if ($this->fileMode !== null) {
            @chmod($indexFile, $this->fileMode);
        }

    }

    protected function gc(&$manifest) {
        if (count($manifest) > $this->historySize + 10) {
            $n = count($manifest) - $this->historySize;
            foreach (array_keys($manifest) as $tag) {
                $file = $this->dataPath . "/$tag.data";
                @unlink($file);
                unset($manifest[$tag]);
                if (--$n <= 0) {
                    break;
                }
            }
        }
    }

    /**
     * @param $filter
     * @param $limit
     * @return mixed
     */
    public function getSummery($filter, $limit) {
        // TODO: Implement getSummery() method.
    }

    public function getTabInfoByTag($tag, $tab) {
        // TODO: Implement getTabInfoByTag() method.
    }
}