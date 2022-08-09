<?php

namespace Sudip\LangMaker\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Filesystem\Filesystem;
use Sudip\LangMaker\Traits\LangUtility;

class LanguageController extends Controller
{
    use LangUtility;
    
    public function index($currantLang = 'en')
    {
        $languages = $this->languages();
        $dir = base_path() . '/resources/lang/' . $currantLang;
        if (!is_dir($dir)) {
            $dir = base_path() . '/resources/lang/en';
        }

        $jsonFileArray = [];
        if (file_exists($dir . '.json')) {
            $jsonFileArray = json_decode(file_get_contents($dir . '.json'));
        }
        
        $arrFiles = array_diff(
            scandir($dir), array(
                '..',
                '.',
            )
        );

        $ignore_lang_files = is_array(config('lang-maker.ignore_lang_file')) ? config('lang-maker.ignore_lang_file') : [];

        $pageArray = [];
        foreach ($arrFiles as $file) {
            $fileName = basename($file, ".php");

            if (!in_array($fileName, $ignore_lang_files)) {
                $fileData = $myArray = include $dir . "/" . $file;
                if (is_array($fileData)) {
                    $pageArray[$fileName] = $fileData;
                }
            }
        }

        $cssClass = $this->cssGenerate();

        $blade = config('lang-maker.bootstrap_v') == 3 ? 'lang-maker::index-3' : 'lang-maker::index';

        return view($blade, compact('languages', 'currantLang', 'jsonFileArray', 'pageArray', 'cssClass'));
    }
    
    public function store(Request $request)
    {
        $langCode = strtolower($request->code);
        $langDir = base_path() . '/resources/lang/';
        $dir = $langDir;
        if (!is_dir($dir)) {
            mkdir($dir);
            chmod($dir, 0777);
        }
        $dir = $dir . '/' . $langCode;

        if (file_exists($langDir . 'en.json')) {
            $jsonFile = $dir . ".json";
            \File::copy($langDir . 'en.json', $jsonFile);
        }

        if (!is_dir($dir)) {
            mkdir($dir);
            chmod($dir, 0777);
        }

        $fileSystem = new Filesystem();
        $fileSystem->copyDirectory($langDir . "en", $dir . "/");

        return redirect()->route(config('lang-maker.route_name'), [$langCode])->with(config('lang-maker.flash_success'), trans('lang-maker::sp_lang_maker.create_message'));
    }

    public function update(Request $request, $currantLang)
    {
        $dir = base_path() . '/resources/lang';
        if (!is_dir($dir)) {
            mkdir($dir);
            chmod($dir, 0777);
        }

        if ($request->label) {
            $jsonFile = $dir . "/" . $currantLang . ".json";
            file_put_contents($jsonFile, json_encode($request->label));
        }


        $langFolder = $dir . "/" . $currantLang;
        if (!is_dir($langFolder)) {
            mkdir($langFolder);
            chmod($langFolder, 0777);
        }

        if (!empty($request->message)) {
            foreach($request->message as $fileName => $fileData) {
                $content = "<?php\n\nreturn [\n";
                $content .= $this->buildArray($fileData);
                $content .= "];";
                file_put_contents($langFolder . "/" . $fileName . '.php', $content);
            }
        }

        return redirect()->route(config('lang-maker.route_name'), [$currantLang])->with(config('lang-maker.flash_success'), trans('lang-maker::sp_lang_maker.update_message'));
    }
}
