<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\SettingRequest;
use anlutro\LaravelSettings\SettingStore as Setting;


class SettingSiteController extends Controller
{

    public function __construct()
    {

    }

    public function index()
    {
        $settings = (object) \Setting::all();




        return view('auth.setting.index', compact('settings'));
    }


    public function save(SettingRequest $request)
    {
        $params = $request->all();
        \Setting::set('wrapping', $params['wrapping']);
        \Setting::set('is_wrapping', ($request->has('is_wrapping')) ? 1 : 0);
        \Setting::save();
        return redirect()->route('settings_site.index')->with('message', 'Настройки успешно сохранены');
    }


}
