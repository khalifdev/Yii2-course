<?php


namespace app\components;


use app\base\BaseComponent;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

class FileComponent extends BaseComponent
{
    public function saveFiles(array $files) : array
    {
        $names = [];
        foreach ($files as $key => $file){

            $names[] = $this->genFileName($file);

            $path = $this->getPathToSave() . $names[$key];
            if (!$file->saveAs($path)) {
                return [];
            }
        }

        return $names;
    }

    private function getPathToSave()
    {
        $path = \Yii::getAlias('@webroot/files/');
        FileHelper::createDirectory($path);
        return $path;
    }

    private function genFileName(UploadedFile $file)
    {
        return time() . "_" . $file->getBaseName() . '.' . $file->getExtension();
    }

}