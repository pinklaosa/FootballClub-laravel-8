<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class RivalController extends Controller
{

    public function rivalPage()
    {
        return view('page.pageRivalMember');
    }

    public function rivalMembers(Request $request)
    {

        if (session()->has('LoggedUser')) {
            $id_rival = $request->get('id_rival');
            $rival = DB::table('rival')
                ->where('id_rival', $id_rival)
                ->first();
            $name = [
                'namerival' => $rival,
                'id_rival'=> $id_rival,
            ];
            $data = array(
                'list' => DB::table('member_rival')
                    // ->join('statistics_rival', 'id_member_rival', '=', 'id_member_rival')
                    ->where('id_rival', $id_rival)
                    ->get()
            );
        }
        return view('page.pageRivalMember', $data, $name);
    }

    public function getRiavalTeam()
    {
        $rival =  DB::table('rival')->get();
        
        if($rival){
            return response()->json([
                'status' => 200,
                'rival' => $rival,
            ]);
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'List not found',
            ]);
        }
    }
    public function rival()
    {
        return view('page.pageRival');
    }

    public function addRivalMember(Request $request)
    {
        $request->validate([
            'id_rival' => 'required',
            'name_mr' => 'required',
            'position_mr' => 'required'
        ]);
        if($request->position_mr == "none"){
            return back()->with('error','Something went wrong');
        }

        $query = DB::table('member_rival')
            ->insert([
                'name_mr'=>$request->name_mr,
                'position_mr'=>$request->position_mr,
                'id_rival'=>$request->id_rival,
            ]);

        if($query){
            return back()->with('success','Added Success fully');
        }
        return $request->input();
    }


    public function statistics($id_mr)
    {
        $staList = DB::table('statistics_rival')
            ->where('id_mr', $id_mr)
            ->get();
        
        $idMatch = DB::table('statistics_rival')
            ->where('id_mr', $id_mr)
            ->max('id_match');
        
        $position = DB::table('member_rival')
            ->where('id_mr', $id_mr)
            ->value('position_mr');
        
        $list = DB::table('list')
            ->join('position', 'list.id_position', '=', 'position.id_position')
            ->where('name_position', $position)
            ->get();

        if ($staList) {
            return response()->json([
                'status' => 200,
                'maxid' => $idMatch,
                'position' => $position,
                'list' => $list,
                'listSta' => $staList,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'List not found',
            ]);
        }
    }
    

    public function addRivalTeam(Request $request)
    {
        $request->validate([
            'rivalteam_name'=>'required',
            'photo_rival'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($img = $request->file('photo_rival')){
            $path = 'assets/img/rival/';
            $imgName = $request->rivalteam_name.'.png';
            $img->move($path,$imgName);
            $photo_rival = "$imgName";
        }

        $query = DB::table('rival')
            ->insert([
                'name_rival'=>$request->rivalteam_name,
                'photo_rival'=>$photo_rival,
            ]);

        if($query){
            return response()->json([
                'status'=>200,
                'msg'=>'Success fully',
            ]);
        }else{
            return response()->json([
                'status'=>0,
                'msg'=>'Someting went wrong.',
            ]);
        }
    }

    public function addStatRivalMember(Request $request)
    {
        $request->validate([
            'more.*.list' => 'required',
            'more.*.id' => 'required',
            'more.*.got' => 'required',
            'more.*.chance' => 'required',
            'id_member' => 'required',
            'id_rival'=>'required',
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
                'id_mr' => $request->id_member,
                'id_rival' => $request->id_rival,
            ];
        }
        if (count($statisticsInput) > 0) {
            $queryInsert = DB::table('statistics_rival')
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
