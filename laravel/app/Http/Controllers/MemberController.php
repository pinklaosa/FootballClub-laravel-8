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
            'position' => 'required',
            'number' => 'required',
            'status' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($img = $request->file('photo')) {
            $path = 'assets/img/profile/';
            $imgName = $request->name . '.png';
            $img->move($path, $imgName);
            $photo = "$imgName";
        }

        $query = DB::table('player')
            ->insert([
                'name' => $request->name,
                'position' => $request->position,
                'nickname' => $request->nickname,
                'number' => $request->number,
                'photo' => $photo,
                'status' => $request->status,
            ]);

        if ($query) {
            return response()->json([
                'code' => 200,
                'msg' => "Success fully",
            ]);
        } else {
            return response()->json([
                'code' => 0,
                'msg' => "Something went wrong",
            ]);
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
                'list' => DB::table('player')->get()
            );
        }
        return view('page.member', $data, $name);
    }

    public function getEditMember($id_m)
    {
        $member = DB::table('player')
            ->where('id_m', $id_m)
            ->get();

        if ($member) {
            return response()->json([
                'status' => 200,
                'player' => $member
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'List not found',
            ]);
        }
    }

    public function updateMember(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'nickname' => 'required',
            'number' => 'required',
            'status' => 'required',
            'position' => 'required',
            'id' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($request->photo == null) {
            $photo = $request->name + '.png';
        } else {
            if ($img = $request->file('photo')) {
                $path = 'assets/img/profile/';
                $imgName = $request->rivalteam_name . '.png';
                $img->move($path, $imgName);
                $photo = "$imgName";
            }
        }

        $update = DB::table('player')
            ->where('id_m', $request->id)
            ->update([
                'name' => $request->name,
                'position' => $request->position,
                'nickname' => $request->nickname,
                'number' => $request->number,
                'photo' => $photo,
                'status' => $request->status,
            ]);

        if ($update) {
            return response()->json([
                'code' => 200,
                'msg' => 'Updated successfully'
            ]);
        } else {
            return response()->json([
                'code' => 0,
                'msg' => 'Something went wrong'
            ]);
        }
    }

    public function deletedPlayer($id_m)
    {
        $deleted = DB::table('player')
            ->where('id_m',$id_m)
            ->delete();

        if($deleted){
            return response()->json([
                'code'=>200,
                'msg'=>'The record had deleted.'
            ]);
        }    
        else{
            return response()->json([
                'code'=>0,
                'msg'=>'Something went wrong.'
            ]);
        }
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

            if ($request->more[$i]['got'] > $request->more[$i]['chance']) {
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
