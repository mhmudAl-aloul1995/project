<?php

namespace App\Http\Controllers\main;

use App\Category;
use App\Folder;
use App\Http\Controllers\Controller;
use App\Research;
use App\Version;
use Illuminate\Database\Eloquent\Builder;
use View;
use Yajra\Datatables\Enginges\EloquentEngine;

class homeController extends Controller
{


    public function index()
    {

        $folders=Folder::with('versions')->get();
        $researches=Research::all();
        $last_folder=Folder::latest()->first()['fldr_no'];
        $last_version=Version::latest()->first()['vr_no'];
        $version_count=Version::count();
        $folder_count=Folder::count();
        $version_id=Version::latest()->first()['id'];

        $category = Category::withCount([
            'researches',
            'researches as pending_researches_count' => function (Builder $query)use($version_id)  {
                $query->where('version_id', $version_id);
            },
        ])->get();

        return View::make('main/home',compact('version_id','folders','category','researches','last_folder','last_version'));

    }


}
