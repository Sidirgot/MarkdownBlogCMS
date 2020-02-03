<?php

namespace App\Http\Controllers\Backend\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingsRequest;
use App\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Setting::latest()->get(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\SettingsRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(SettingsRequest $request)
    {
        $setting = Setting::create($request->validated());

        return response()->json($setting, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Setting $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        return response()->json($setting, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\SettingsRequest $request
     * @param  \App\Setting $setting
     * @return \Illuminate\Http\Response
     */
    public function update(SettingsRequest $request, Setting $setting)
    {
        $setting->update($request->validated());

        return response()->json($setting->fresh(), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Setting $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        $setting->delete();

        return response()->json('deleted', 200);
    }
}
