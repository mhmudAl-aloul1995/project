<?php

namespace App\Http\Controllers;

use App\user;

use Illuminate\Http\Request;
use phpDocumentor\Reflection\Project;
use Yajra\Datatables\Datatables;
use Yajra\Datatables\Enginges\EloquentEngine;
use Illuminate\Support\Facades\DB;
use View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class userController extends Controller
{


    public function index()
    {


        return View::make('user');

    }


    public function datatableUser(Request $request)
    {
        $data = $request->all();


        $users = User::where('id', '!=', 1)->get();
        $date_from = null;
        $date_to = null;
        /*      if (isset($data['date_from']) && $data['date_from'] != null) {
                  $date_from = $data['date_from'];
                  $date_to = $data['date_to'];

                  $users->whereHas('bills', function (Builder $query) use ($date_from, $date_to) {
                      $query->whereBetween('bill_date', [$date_from, $date_to]);
                  });

              }*/


        return Datatables::of($users)
            ->addColumn('action', function ($ctr) {

                return '<div class="btn-group">
                                                        <button  class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> إجراء
                                                            <i class="fa fa-angle-down"></i>
                                                        </button>
                                                        <ul  class="dropdown-menu" role="menu">
                                                            <li>
                                                                <a onclick="showModal(`user`,' . $ctr->id . ')" href="javascript:;">
                                                                    <i class="icon-pencil"></i> تعديل </a>
                                                            </li>
                                                            <li>
                                                                <a onclick="deleteThis(`user`,' . $ctr->id . ')"  href="javascript:;">
                                                                    <i class="icon-trash"></i> حذف  </a>
                                                            </li>
                                                            </ul>
                                                    </div>';
            })
            ->rawColumns(['action' => 'action', 'user_img' => 'user_img'])
            ->make(true);
    }

    public function show(Request $request, $id)
    {

        $user = User::find($id);
        if ($user) {
            return response()->json([
                'user' => $user
            ]);
        }
        return response(['message' => 'فشلت العملية'], 500);

    }

    public function store(Request $request)
    {
        $data = $request->all();
        unset($data['id']);
        //   $data['user_id'] = Auth::id();
        $user = User::create($data);

        if (!$user) {
            if (!Request::ajax()) {
                return redirect('signup');
            }
            return response()->json([
                'success' => FALSE,
                'message' => "حدث حطأ أثناء الإدخال"

            ]);
        }
        if (!Request::ajax()) {
            return redirect('research');
        }
        return response()->json([
            'success' => TRUE,
            'message' => "تم الإدخال بنجاح"

        ]);
    }

    public function update_user(Request $request)
    {
        $data = $request->all();
        $user = user::find($data['id']);
        $user->update($data);


        if (!$user) {
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

        if (user::find($id)->delete()) {
            return response()->json([
                'message' => 'تمت العملية بنجاح',
            ]);
        }

        return response(['message' => 'فشلت العملية'], 500);
    }


}
