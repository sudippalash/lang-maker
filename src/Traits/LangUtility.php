<?php

namespace Sudip\LangMaker\Traits;

trait LangUtility
{
    public function languages()
    {
        $dir = lang_path();
        $glob = glob($dir.'/*', GLOB_ONLYDIR);
        $arrLang = array_map(
            function ($value) use ($dir) {
                return str_replace($dir.'/', '', $value);
            }, $glob
        );

        // Ignore lang/vendor directory
        if (in_array('vendor', $arrLang)) {
            unset($arrLang[array_search('vendor', $arrLang)]);
        }

        $arrLang = array_map(
            function ($value) {
                return preg_replace('/[0-9]+/', '', $value);
            }, $arrLang
        );
        $arrLang = array_filter($arrLang);

        return $arrLang;
    }

    public function buildArray($fileData)
    {
        $content = '';
        foreach ($fileData as $lable => $data) {
            if (is_array($data)) {
                $content .= "\t'$lable' => [".$this->buildArray($data)."],\n";
            } else {
                $content .= "\t'$lable' => '".addslashes($data)."',\n";
            }
        }

        return $content;
    }

    public function cssGenerate($bootstrapVersion)
    {
        $cssClass = config('lang-maker.css');

        $card = $bootstrapVersion == 3 ? 'panel panel-default' : 'card';
        $btn = $bootstrapVersion == 3 ? 'btn-default' : 'btn-secondary';

        $cssClass['tabActive'] = ($bootstrapVersion != 5 ? 'active' : 'show active');
        $cssClass['formGroup'] = ($bootstrapVersion == 3 ? 'form-group' : 'mb-3');
        $cssClass['floatRight'] = ($bootstrapVersion == 3 ? 'pull-right' : ($bootstrapVersion == 4 ? 'float-right' : 'float-end'));

        $cssClass['container'] = isset($cssClass['container']) ? $cssClass['container'] : 'container-fluid';

        $cssClass['card'] = isset($cssClass['card']) ? $cssClass['card'] : $card;

        $cssClass['input'] = isset($cssClass['input']) ? $cssClass['input'] : 'form-control';

        $cssClass['btn'] = isset($cssClass['btn']) ? $cssClass['btn'] : $btn;

        $cssClass['link'] = isset($cssClass['link']) ? $cssClass['link'] : 'lang-maker-link';

        return $cssClass;
    }
}
