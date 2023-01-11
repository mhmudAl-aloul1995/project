<?php

namespace App\Http\Controllers\main;

use App\Category;
use App\Folder;
use App\Http\Controllers\Controller;
use App\Research;
use App\User;
use App\Version;
use View;
use Yajra\Datatables\Enginges\EloquentEngine;
use Illuminate\Http\Request;

class browseController extends Controller
{


    public function browse_version()
    {

        $folder = Folder::with('versions')->orderBy('fldr_no', 'desc')->get();


        return View::make('main/browse_version', compact('folder'));

    }

    public function browse_researcher()
    {

        $chars = array (
            'ا',
            'ب',
            'پ',
            'ت',
            'ث',
            'ج',
            'چ',
            'ح',
            'خ',
            'د',
            'ذ',
            'ر',
            'ز',
            'ژ',
            'س',
            'ش',
            'ص',
            'ض',
            'ط',
            'ظ',
            'ع',
            'غ',
            'ف',
            'ق',
            'ک',
            'گ',
            'ل',
            'م',
            'ن',
            'و',
            'ه',
            'ی',

        );

        return View::make('main/browse_researcher', compact('chars'));

    }

    public function browse_index_researcher($folder_id=null)
    {

        $chars = array (
            'ا',
            'ب',
            'پ',
            'ت',
            'ث',
            'ج',
            'چ',
            'ح',
            'خ',
            'د',
            'ذ',
            'ر',
            'ز',
            'ژ',
            'س',
            'ش',
            'ص',
            'ض',
            'ط',
            'ظ',
            'ع',
            'غ',
            'ف',
            'ق',
            'ک',
            'گ',
            'ل',
            'م',
            'ن',
            'و',
            'ه',
            'ی',

        );
        $folders = Folder::with('versions')->orderBy('fldr_no', 'desc')->get();

        return View::make('main/browse_index_researcher', compact('chars','folders','folder_id'));

    }
    public function browse_category()
    {

        $category = Category::all();


        return View::make('main/browse_category', compact('category'));

    }
}
