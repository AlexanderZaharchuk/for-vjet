<?php

namespace core\helpers;

class DirParserHelper extends CommonHelper
{
    public $rootPath;
    public $file;
    public $tempPath = [];
    public $path = [];

    public function __construct($rootPath, $file)
    {
        $this->rootPath = $rootPath;
        $this->file = $file;

        parent::__construct();
    }
    
    public function init() {}

    public function run()
    {
        $map = $this->scanDirs($this->rootPath);
        $this->getAutoloadFilePath($map, $this->file);
    }

    public function getIgnoreDirAndFiles()
    {
        return [
            '.',
            '..',
            '.git',
            '.idea',
            '.gitignore',
            '.htaccess',
        ];
    }

    public function scanDirs($start)
    {
        $files = [];
        $handle = opendir($start);

        while (false !== ($file = readdir($handle)))
        {
            if (!in_array($file, self::getIgnoreDirAndFiles()))
            {
                if (is_dir($start.'/'.$file))
                {
                    $dir = self::scanDirs($start.'/'.$file);
                    $files[$file] = $dir;
                } else {
                    array_push($files, $file);
                }
            }
        }
        closedir($handle);

        return $files;
    }

    public function getAutoloadFilePath($map, $search)
    {
        foreach ($map as $key => $value) {
            $this->tempPath[] = $key;
            if (is_array($value)) {
                $this->getAutoloadFilePath($value, $search);
            }

            if ($value == $search) {
                array_pop($this->tempPath);
                $this->path = implode('/', $this->tempPath)."/";
            } else {
                array_pop($this->tempPath);
            }
        }
    }
}