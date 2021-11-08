<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
    public function addM()
    {
        if (session()->has('LoggedUser')) {
            //    $user = User::where('id','=',session('LoggedUser'))->first();
            $user = DB::table('users')
                ->where('id', session('LoggedUser'))
                ->first();

            $data = [
                'LoggedUserInfo' => $user
            ];
        }
        return view('page.addMember', $data);
    }

    public function addedMember(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'nickname' => 'required',
            'username' => 'required',
            'position' => 'required',
            'number' => 'required',
            'status' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($img = $request->file('photo')) {
            $path = 'assets/img/';
            $imgName = $request->name . '.jpg';
            $img->move($path, $imgName);
            $photo = "$imgName";
        }

        $query = DB::table('user_details')
            ->insert([
                'name' => $request->name,
                'nickname' => $request->nickname,
                'username' => $request->username,
                'position' => $request->position,
                'number' => $request->number,
                'status' => $request->status,
                'photo' => $photo
            ]);

        if ($query) {
            return back()->with('added', 'Member added successfully');
        } else {
            return back()->with('error', 'Something wrong');
        }
    }

    public function member()
    {
        if (session()->has('LoggedUser')) {
            //    $user = User::where('id','=',session('LoggedUser'))->first();
            $user = DB::table('users')
                ->where('id', session('LoggedUser'))
                ->first();

            $name = [
                'LoggedUserInfo' => $user
            ];

            $data = array(
                'list' => DB::table('user_details')->get()
            );
        }
        return view('page.member', $data, $name);
    }

    public function usStatistics()
    {
        if (session()->has('LoggedUser')) {
            $player = DB::table('player')->get();

            if ($player) {
                return response()->json([
                    'status' => 200,
                    'player' => $player
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'List not found',
                ]);
            }
        }
    }

    public function showStatistics()
    {
        return view('page.pageStat');
    }

    public function detailStatistics($id_m)
    {
        $statistics = DB::table('statistics')
            ->where('id_m', $id_m)
            ->get();

        $idMatch = DB::table('statistics')
            ->where('id_m', $id_m)
            ->max('id_match');

        $position = DB::table('player')
            ->where('id_m', $id_m)
            ->value('position');

        $list = DB::table('list')
            ->join('position', 'list.id_position', '=', 'position.id_position')
            ->where('name_position', $position)
            ->get();


        if ($statistics) {
            return response()->json([
                'status' => 200,
                'maxid' => $idMatch,
                'position' => $position,
                'list' => $list,
                'statistics' => $statistics,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'List not found',
            ]);
        }
    }

    public function getIdMatch($id_m)
    {
        $idMatch = DB::table('statistics')
            ->where('id_m', $id_m)
            ->max('id_match');

        if ($idMatch) {
            return response()->json([
                'status' => 200,
                'max_id_match' => $idMatch
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'List not found',
            ]);
        }
    }

    public function addStatistics(Request $request)
    {
        $request->validate([
            'more.*.list' => 'required',
            'more.*.id' => 'required',
            'more.*.got' => 'required',
            'more.*.chance' => 'required',
            'id_member' => 'required',
        ]);

        $len  = count($request->more);
        $statisticsInput = [];
        for ($i = 0; $i < $len; $i++) {
            
            if($request->more[$i]['got'] > $request->more[$i]['chance']){
                return response()->json([
                    'code' => 0,
                    'msg' => '"got" must more than "chance"',
                ]);
            }

            $statisticsInput[] = [
                'list' => $request->more[$i]['list'],
                'got' => $request->more[$i]['got'],
                'chance' => $request->more[$i]['chance'],
                'id_match' => $request->more[$i]['id'],
                'id_m' => $request->id_member,
            ];
        }
        if (count($statisticsInput) > 0) {
            $queryInsert = DB::table('statistics')
                ->insert($statisticsInput);

            if ($queryInsert) {
                return response()->json([
                    'code' => 200,
                    'msg' => "Success fully",
                ]);
            }
        }
    }
}
