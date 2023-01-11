<?php

namespace App\Http\Controllers\main;

use App\Category;
use App\Folder;
use App\Http\Controllers\Controller;
use App\Research;
use App\Version;
use View;
use Yajra\Datatables\Enginges\EloquentEngine;

class homeController extends Controller
{


    public function index()
    {

        $folders=Folder::with('versions')->get();
        $category=Category::withCount('researches')->get();
        $researches=Research::all();
        $last_folder=Folder::latest()->first()['fldr_no'];
        $last_version=Version::latest()->first()['vr_no'];
        $version_count=Version::count();
        $folder_count=Folder::count();

        return View::make('main/home',compact('folders','category','researches','last_folder','last_version'));

    }


}
