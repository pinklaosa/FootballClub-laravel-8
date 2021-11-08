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
                'namerival' => $rival
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


    public function statistics($id_mr)
    {
        $staList = DB::table('statistics_rival')
            ->where('id_mr', $id_mr)
            ->get();

        if ($staList) {
            return response()->json([
                'status' => 200,
                'listSta' => $staList,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'List not found',
            ]);
        }
    }

    public function addRivalTeam()
    {
        
    }
}
