<?php

namespace App\Http\Controllers\main;

use App\Category;
use App\Folder;
use App\Http\Controllers\Controller;
use App\Research;
use App\Version;
use View;
use Yajra\Datatables\Enginges\EloquentEngine;
use Illuminate\Http\Request;

class categoryController extends Controller
{


    public function index($type, $id)
    {

        $lastVersion = Version::latest('id')->first();
        $allcategory = Category::withCount('researches')->get();
        if ($type == 1) {
            $researches = Research::where(['category_id' => $id])->get();
            $category = $allcategory;
        }
        if ($type == 2) {
            $lastVersion = Version::latest('id')->where('folder_id', $id)->first();
            $researches = Research::wherehas('version', function ($q) use ($id) {
                $q->wherehas('folder', function ($q) use ($id) {
                    $q->where('folder_id', $id);
                });
            });
            if ($lastVersion != null) {
                $version_id = $lastVersion['id'];
                $category = Category::wherehas('researches', function ($q) use ($version_id) {
                    $q->where('version_id', $version_id);
                })->withCount('researches')->get();
            } else {
                $category = $allcategory;
            }
        }
        if ($type == 3) {
            $researches = Research::where(['version_id' => $id])->get();
            $lastVersion = Version::find($id);
            $category = Category::wherehas('researches', function ($q) use ($id) {
                $q->where('version_id', $id);
            })->withCount('researches')->get();

        }
        $folders_archive = Folder::with('versions')->get();

        return View::make('main/category', compact('category', 'researches', 'lastVersion', 'folders_archive', 'type', 'allcategory'));

    }


}
