<?php

namespace App\Http\Controllers;

use App\AllocationDonor;
use App\research;
use App\Category;
use App\Journal;
use App\user;
use App\Donor;
use App\Municipality;
use App\Product;
use App\Stage;
use App\Version;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Project;
use Yajra\Datatables\Datatables;
use Yajra\Datatables\Enginges\EloquentEngine;
use Illuminate\Support\Facades\DB;
use View;
use Illuminate\Support\Facades\Auth;


class researchController extends Controller
{


    public function index()
    {


        $category = Category::all();
        $users = Category::all();

        return View::make('research', compact('category', 'users'));

    }


    public function datatableResearch(Request $request)
    {
        $data = $request->all();

        $users = Research::query()->with('category')->select('researches.*');

        return Datatables::of($users)
            ->editColumn('res_link', function ($ctr) {

                return '<a target="_blank" href="' . asset($ctr->res_link) . '">الرابط</a>';
            })
            ->addColumn('action', function ($ctr) {

                return '<div class="btn-group">
                                                        <button  class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> إجراء
                                                            <i class="fa fa-angle-down"></i>
                                                        </button>
                                                        <ul  class="dropdown-menu" role="menu">
                                                            <li>
                                                                <a onclick="showModal(`research`,' . $ctr->id . ')" href="javascript:;">
                                                                    <i class="icon-pencil"></i> تعديل </a>
                                                            </li>
                                                            <li>
                                                                <a onclick="deleteThis(`research`,' . $ctr->id . ')"  href="javascript:;">
                                                                    <i class="icon-trash"></i> حذف  </a>
                                                            </li>
                                                            </ul>
                                                    </div>';
            })
            ->rawColumns(['action' => 'action', 'res_link' => 'res_link'])
            ->make(true);
    }

    public function show(Request $request, $id)
    {

        $research = Research::find($id);
        if ($research) {
            return response()->json([
                'research' => $research
            ]);
        }
        return response(['message' => 'فشلت العملية'], 500);

    }

    public function store(Request $request)
    {
        $data = $request->all();
        unset($data['id']);
        $data['user_id'] = Auth::id();
        $get_last_version = Version::latest()->first()['id'];
        if (!$get_last_version){
            return response()->json([
                'success' => FALSE,
                'message' => "لا يوجد إصدار لإضافة البحث عليه"

            ]);
        }
        if ($request->file()) {
            $fileName = time() . '_' . $request->res_link->getClientOriginalName();
            $filePath = $request->file('res_link')->storeAs('researches', $fileName);
            $data['res_link'] = '/storage/app/' . $filePath;

        }

        $data['version_id']=$get_last_version;
        $research = Research::create($data);

        if (!$research) {

            return response()->json([
                'success' => FALSE,
                'message' => "حدث حطأ أثناء الإدخال"

            ]);
        }
        return response()->json([
            'success' => TRUE,
            'message' => "تم الإدخال بنجاح"

        ]);
    }

    public function update_research(Request $request)
    {
        $data = $request->all();


        $research = research::find($data['id']);
        $research->update($data);

        if ($request->file()) {
            $fileName = time() . '_' . $request->res_link->getClientOriginalName();
            $filePath = $request->file('res_link')->storeAs('researches', $fileName);
            $data['res_link'] = '/storage/app/' . $filePath;

        }

        if (!$research) {
            return response()->json([
                'success' => TRUE,
                'message' => "حدث حطأ أثناء التعديل"

            ]);
        }
        return response()->json([
            'success' => TRUE,
            'message' => "تم التعديل بنجاح"
        ]);
    }

    public function destroy(Request $request, $id)
    {


        $research = Research::find($id)->delete();
        if ($research) {
            return response()->json([
                'message' => 'تمت العملية بنجاح',
            ]);
        }

        return response(['message' => 'فشلت العملية'], 500);
    }


}
