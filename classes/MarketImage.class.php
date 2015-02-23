<?php

class MarketImage extends SimpleORMap {

    static public function findByPlugin_id($plugin_id) {
        return self::findBySQL("plugin_id = ? ORDER BY position ASC, mkdate ASC", array($plugin_id));
    }

    static public function getImageDataPath() {
        return $GLOBALS['STUDIP_BASE_PATH'] . "/data/pluginmarket_images";
    }

    protected static function configure($config = array())
    {
        $config['db_table'] = 'pluginmarket_images';
        $config['belongs_to']['plugin'] = array(
            'class_name' => 'MarketPlugin',
            'foreign_key' => 'plugin_id',
        );
        parent::configure($config);
    }

    public function getURL() {
        return URLHelper::getURL("plugins.php/pluginmarket/presenting/image/".$this->getId(), array(), true);
    }

    public function delete() {
        parent::delete();
        unlink($this->getFilePath());
    }

    public function installFromPath($path) {
        copy($path, $this->getFilePath());
    }

    protected function getFilePath() {
        if (!file_exists(self::getImageDataPath())) {
            mkdir(self::getImageDataPath());
        }
        if (!$this->getId()) {
            $this->setId($this->getNewId());
        }
        return self::getImageDataPath()."/".$this->getId();
    }

    public function outputImage() {
        $path = self::getImageDataPath() . "/" . $this->getId();
        header("Content-Type: " . mime_content_type($path));
        header("Content-Disposition: inline; filename=" . $this['filename']);
        echo file_get_contents($path);
    }
}