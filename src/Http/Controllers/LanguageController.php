<?php

namespace Sudip\LangMaker\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Sudip\LangMaker\Traits\LangUtility;

class LanguageController extends Controller
{
    use LangUtility;

    public function index($currantLang = 'en')
    {
        $languages = $this->languages();
        $dir = lang_path($currantLang);
        if (! is_dir($dir)) {
            $dir = lang_path('en');
        }

        $jsonFileArray = [];
        if (file_exists($dir.'.json')) {
            $jsonFileArray = json_decode(file_get_contents($dir.'.json'));
        }

        $arrFiles = array_diff(
            scandir($dir), [
                '..',
                '.',
            ]
        );

        $ignore_lang_files = is_array(config('lang-maker.ignore_lang_file')) ? config('lang-maker.ignore_lang_file') : [];

        $pageArray = [];
        foreach ($arrFiles as $file) {
            $fileName = basename($file, '.php');

            if (! in_array($fileName, $ignore_lang_files)) {
                $fileData = $myArray = include $dir.'/'.$file;
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
        $dir = lang_path();
        if (! is_dir($dir)) {
            mkdir($dir);
            chmod($dir, 0777);
        }
        $dir = lang_path($langCode);

        if (file_exists(lang_path('en.json'))) {
            $jsonFile = $dir.'.json';
            File::copy(lang_path('en.json'), $jsonFile);
        }

        if (! is_dir($dir)) {
            mkdir($dir);
            chmod($dir, 0777);
        }

        $fileSystem = new Filesystem;
        $fileSystem->copyDirectory(lang_path('en'), $dir.'/');

        return redirect()->route(config('lang-maker.route_name'), [$langCode])->with(config('lang-maker.flash_success'), trans('lang-maker::sp_lang_maker.create_message'));
    }

    public function update(Request $request, $currantLang)
    {
        $dir = lang_path();
        if ($request->label) {
            $jsonFile = $dir.'/'.$currantLang.'.json';
            file_put_contents($jsonFile, json_encode($request->label));
        }

        $langFolder = $dir.'/'.$currantLang;
        if (! is_dir($langFolder)) {
            mkdir($langFolder);
            chmod($langFolder, 0777);
        }

        if (! empty($request->message)) {
            foreach ($request->message as $fileName => $fileData) {
                $content = "<?php\n\nreturn [\n";
                $content .= $this->buildArray($fileData);
                $content .= '];';
                file_put_contents($langFolder.'/'.$fileName.'.php', $content);
            }
        }

        return redirect()->route(config('lang-maker.route_name'), [$currantLang])->with(config('lang-maker.flash_success'), trans('lang-maker::sp_lang_maker.update_message'));
    }
}
