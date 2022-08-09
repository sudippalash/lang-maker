<?php

namespace Sudip\LangMaker\Traits;

trait LangUtility
{
    public function languages()
    {
        $dir = base_path() . '/resources/lang/';
        $glob = glob($dir . "*", GLOB_ONLYDIR);
        $arrLang = array_map(
            function ($value) use ($dir) {
                return str_replace($dir, '', $value);
            }, $glob
        );

        $arrLang = array_map(
            function ($value) use ($dir) {
                return preg_replace('/[0-9]+/', '', $value);
            }, $arrLang
        );
        $arrLang = array_filter($arrLang);

        return $arrLang;
    }

    public function buildArray($fileData)
    {
        $content = "";
        foreach ($fileData as $lable => $data) {
            if(is_array($data)) {
                $content .= "\t'$lable' => [" . $this->buildArray($data) . "],\n";
            } else {
                $content .= "\t'$lable' => '" . addslashes($data) . "',\n";
            }
        }
        
        return $content;
    }

    public function cssGenerate()
    {
        $cssClass = config('lang-maker.css');
        
        $cssClass['container'] = isset($cssClass['container']) ? $cssClass['container'] : 'container-fluid';

        $cssClass['card'] = isset($cssClass['card']) ? $cssClass['card'] : 'card';

        $cssClass['input'] = isset($cssClass['input']) ? $cssClass['input'] : 'form-control';

        $cssClass['btn'] = isset($cssClass['btn']) ? $cssClass['btn'] : 'btn-secondary';
        
        $cssClass['link'] = isset($cssClass['link']) ? $cssClass['link'] : 'lang-maker-link';
        
        return $cssClass;
    }
}