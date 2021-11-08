<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use DataTables;

class AnalysisController extends Controller
{
    public function pAnalysis()
    {
        if (session()->has('LoggedUser')) {
            $rival = array(
                'list' => DB::table('rival')->get()
            );
        }
        return view('page.pageAnalysis', $rival);
    }

    public function selectedRival(Request $request)
    {
        $request->validate([
            'rival_team' => 'required',
            'plan_rivals' => 'required'
        ]);
        $id = $request->rival_team;
        $plan_rival = $request->plan_rivals;
        $goalkeeper = "goalkeeper";
        $midfield = "midfield";
        $forward = "forward";
        $defender = "defender";


        if ($id != 0) {

            $statRivalAll = DB::table('statistics_rival')
                ->join('member_rival', 'statistics_rival.id_mr', '=', 'member_rival.id_mr')
                ->where('statistics_rival.id_rival', $id)
                ->get();

            $statGoalkeeper = DB::table('statistics')
                ->join('player', 'statistics.id_m', '=', 'player.id_m')
                ->where('player.position', $goalkeeper)
                ->get();

            $stataDefender = DB::table('statistics')
                ->join('player', 'statistics.id_m', '=', 'player.id_m')
                ->where('player.position', $defender)
                ->get();

            $stataMidfield = DB::table('statistics')
                ->join('player', 'statistics.id_m', '=', 'player.id_m')
                ->where('player.position', $midfield)
                ->get();

            $statForward = DB::table('statistics')
                ->join('player', 'statistics.id_m', '=', 'player.id_m')
                ->where('player.position', $forward)
                ->get();

            function calculatePoint($got, $chance)
            {
                return ($got / $chance) * 100;
            }

            function findPoint($point)
            {
                return array_search(max(array_values($point)), $point);
            }

            function findRec($count, $position)
            {
                $keyPosition = array();
                $keyRec = array();
                arsort($position);
                $keyPosition = array_keys($position);
                for ($i = 0; $i < $count; $i++) {
                    $keyRec[$i] = $keyPosition[$i];
                }
                return $keyRec;
            }

            //ประตู
            $pointGoalkeeper = array();
            $pointSaveCal = array();
            $pointPassingCal = array();
            $pointSavePenaltyCal = array();
            $pointDuelCal  = array();

            foreach ($statGoalkeeper as $data) {
                $id_m = $data->id_m;
                $list = $data->list;
                $got = $data->got;
                $chance = $data->chance;
                $pointGoalkeeper[$id_m] = 0;
                switch ($list) {
                    case 'Save':
                        $calPoint = calculatePoint($got, $chance);
                        $pointSaveCal[$id_m] = $calPoint;
                        break;
                    case 'Passing':
                        $calPoint = calculatePoint($got, $chance);
                        $pointPassingCal[$id_m] = $calPoint;
                        break;
                    case 'Save Penalty':
                        $calPoint = calculatePoint($got, $chance);
                        $pointSavePenaltyCal[$id_m] = $calPoint;
                        break;
                    case 'Duel 1-1':
                        $calPoint = calculatePoint($got, $chance);
                        $pointDuelCal[$id_m] = $calPoint;
                        break;
                    default:
                        # code...
                        break;
                }
            }

            $idPointPass = findPoint($pointPassingCal);
            $idPointSavePenalty = findPoint($pointSavePenaltyCal);
            if ($idPointPass) {
                $pointGoalkeeper[$idPointPass]++;
            }
            if ($idPointSavePenalty) {
                $pointGoalkeeper[$idPointSavePenalty]++;
            }

            //กองหลัง
            $pointDefender = array();
            $pointPassCal = array();
            $pointInterceptCal = array();
            $pointHeadingCal = array();
            $pointTackleCal = array();

            foreach ($stataDefender as $data) {
                $id_m = $data->id_m;
                $list = $data->list;
                $got = $data->got;
                $chance = $data->chance;
                $pointDefender[$id_m] = 0;
                switch ($list) {
                    case 'Passing':
                        $calPoint = calculatePoint($got, $chance);
                        $pointPassCal[$id_m] = $calPoint;
                        break;
                    case 'Intercept':
                        $calPoint = calculatePoint($got, $chance);
                        $pointInterceptCal[$id_m] = $calPoint;
                        break;
                    case 'Heading':
                        $calPoint = calculatePoint($got, $chance);
                        $pointHeadingCal[$id_m] = $calPoint;
                        break;
                    case 'Tackle':
                        $calPoint = calculatePoint($got, $chance);
                        $pointTackleCal[$id_m] = $calPoint;
                        break;
                    default:
                        break;
                }
            }

            $idPointPassD = findPoint($pointPassCal);
            $idPointIntercept = findPoint($pointInterceptCal);
            $idPointTackle = findPoint($pointTackleCal);
            $idPointHeading = findPoint($pointHeadingCal);

            if ($idPointPassD) {
                $pointDefender[$idPointPassD]++;
            }
            if ($idPointIntercept) {
                $pointDefender[$idPointIntercept]++;
            }
            if ($idPointTackle) {
                $pointDefender[$idPointTackle]++;
            }
            if ($idPointHeading) {
                $pointDefender[$idPointHeading]++;
            }


            //กองกลาง
            $pointMidfield = array();
            $pointPassMCal = array();
            $pointDribblingMCal = array();
            $pointInterceptMCal = array();
            $pointShootingMCal = array();
            $pointHeadingMCal = array();

            foreach ($stataMidfield as $data) {
                $id_m = $data->id_m;
                $list = $data->list;
                $got = $data->got;
                $chance = $data->chance;
                $pointMidfield[$id_m] = 0;
                switch ($list) {
                    case 'Passing':
                        $calPoint = calculatePoint($got, $chance);
                        $pointPassMCal[$id_m] = $calPoint;
                        break;
                    case 'Dribbling':
                        $calPoint = calculatePoint($got, $chance);
                        $pointDribblingMCal[$id_m] = $calPoint;
                        break;
                    case 'Intercept':
                        $calPoint = calculatePoint($got, $chance);
                        $pointInterceptMCal[$id_m] = $calPoint;
                        break;
                    case 'Shooting':
                        $calPoint = calculatePoint($got, $chance);
                        $pointShootingMCal[$id_m] = $calPoint;
                        break;
                    case 'Heading':
                        $calPoint = calculatePoint($got, $chance);
                        $pointHeadingMCal[$id_m] = $calPoint;
                        break;
                    default:
                        break;
                }
            }

            $idPointPassM = findPoint($pointPassMCal);
            $idPointDribblingM = findPoint($pointDribblingMCal);
            $idPointInterceptM = findPoint($pointInterceptMCal);
            $idPointShootingM = findPoint($pointShootingMCal);
            $idPointHeadingM = findPoint($pointHeadingMCal);

            if ($idPointPassM) {
                $pointMidfield[$idPointPassM]++;
            }
            if ($idPointDribblingM) {
                $pointMidfield[$idPointDribblingM]++;
            }
            if ($idPointInterceptM) {
                $pointMidfield[$idPointInterceptM]++;
            }
            if ($idPointShootingM) {
                $pointMidfield[$idPointShootingM]++;
            }
            if ($idPointHeadingM) {
                $pointMidfield[$idPointHeadingM]++;
            }

            //กองหน้า
            $pointForward = array();
            $pointPassFCal = array();
            $pointShootingFCal = array();
            $pointHeadingFCal = array();
            $pointDribblingFCal = array();

            foreach ($statForward as $data) {
                $id_m = $data->id_m;
                $list = $data->list;
                $got = $data->got;
                $chance = $data->chance;
                $pointForward[$id_m] = 0;
                switch ($list) {
                    case 'Passing':
                        $calPoint = calculatePoint($got, $chance);
                        $pointPassFCal[$id_m] = $calPoint;
                        break;
                    case 'Shooting':
                        $calPoint = calculatePoint($got, $chance);
                        $pointShootingFCal[$id_m] = $calPoint;
                        break;
                    case 'Heading':
                        $calPoint = calculatePoint($got, $chance);
                        $pointHeadingFCal[$id_m] = $calPoint;
                        break;
                    case 'Dribbling':
                        $calPoint = calculatePoint($got, $chance);
                        $pointDribblingFCal[$id_m] = $calPoint;
                        break;
                    default:
                        # code...
                        break;
                }
            }
            $idPointPassF = findPoint($pointPassFCal);
            $idPointShootingF = findPoint($pointShootingFCal);
            $idPointHeadingF = findPoint($pointHeadingFCal);
            $idPointDribblingF = findPoint($pointDribblingFCal);
            if ($idPointPassF) {
                $pointForward[$idPointPassF]++;
            }
            if ($idPointShootingF) {
                $pointForward[$idPointShootingF]++;
            }
            if ($idPointHeadingF) {
                $pointForward[$idPointHeadingF]++;
            }
            if ($idPointDribblingF) {
                $pointForward[$idPointDribblingF]++;
            }


            foreach ($statRivalAll as $item) {
                $list_mr = $item->list;
                $got_mr = $item->got;
                $chance_mr = $item->chance;
                switch ($list_mr) {
                    case 'Intercept':
                        $calPointMr = calculatePoint($got_mr, $chance_mr);
                        foreach ($pointPassCal as $k => $v) {
                            if ($v > $calPointMr) {
                                $pointDefender[$k]++;
                            }
                        }
                        foreach ($pointPassMCal as $k => $v) {
                            if ($v > $calPointMr) {
                                $pointMidfield[$k]++;
                            }
                        }
                        foreach ($pointDribblingMCal as $k => $v) {
                            if ($v > $calPointMr) {
                                $pointMidfield[$k]++;
                            }
                        }
                        foreach ($pointShootingMCal as $k => $v) {
                            if ($v > $calPointMr) {
                                $pointMidfield[$k]++;
                            }
                        }
                        foreach ($pointPassFCal as $k => $v) {
                            if ($v > $calPointMr) {
                                $pointForward[$k]++;
                            }
                        }
                        foreach ($pointShootingFCal as $k => $v) {
                            if ($v > $calPointMr) {
                                $pointForward[$k]++;
                            }
                        }
                        foreach ($pointDribblingFCal as $k => $v) {
                            if ($v > $calPointMr) {
                                $pointForward[$k]++;
                            }
                        }
                        break;
                    case 'Passing':
                        $calPointMr = calculatePoint($got_mr, $chance_mr);
                        foreach ($pointInterceptCal as $k => $v) {
                            if ($v > $calPointMr) {
                                $pointDefender[$k]++;
                            }
                        }
                        foreach ($pointTackleCal as $k => $v) {
                            if ($v > $calPointMr) {
                                $pointDefender[$k]++;
                            }
                        }
                        foreach ($pointInterceptMCal as $k => $v) {
                            if ($v > $calPointMr) {
                                $pointMidfield[$k]++;
                            }
                        }
                        break;
                    case 'Dribbling':
                        $calPointMr = calculatePoint($got_mr, $chance_mr);
                        foreach ($pointDuelCal as $k => $v) {
                            if ($v > $calPointMr) {
                                $pointGoalkeeper[$k]++;
                            }
                        }
                        foreach ($pointInterceptCal as $k => $v) {
                            if ($v > $calPointMr) {
                                $pointDefender[$k]++;
                            }
                        }
                        foreach ($pointInterceptMCal as $k => $v) {
                            if ($v > $calPointMr) {
                                $pointMidfield[$k]++;
                            }
                        }
                        break;
                    case 'Heading':
                        $calPointMr = calculatePoint($got_mr, $chance_mr);
                        foreach ($pointHeadingCal as $k => $v) {
                            if ($v > $calPointMr) {
                                $pointDefender[$k]++;
                            }
                        }
                        foreach ($pointHeadingMCal as $k => $v) {
                            if ($v > $calPointMr) {
                                $pointMidfield[$k]++;
                            }
                        }
                        foreach ($pointHeadingFCal as $k => $v) {
                            if ($v > $calPointMr) {
                                $pointForward[$k]++;
                            }
                        }
                        break;
                    case 'Save':
                        $calPointMr = calculatePoint($got_mr, $chance_mr);
                        foreach ($pointShootingMCal as $k => $v) {
                            if ($v > $calPointMr) {
                                $pointMidfield[$k]++;
                            }
                        }
                        foreach ($pointShootingFCal as $k => $v) {
                            if ($v > $calPointMr) {
                                $pointForward[$k]++;
                            }
                        }
                        break;
                    case 'Shooting':
                        $calPointMr = calculatePoint($got_mr, $chance_mr);
                        foreach ($pointSaveCal as $k => $v) {
                            if ($v > $calPointMr) {
                                $pointGoalkeeper[$k]++;
                            }
                        }
                        break;
                    default:
                        # code...
                        break;
                }
            }

            if ($plan_rival != 0) {
                // $namePlan = $plan_rival;
                // if ($plan_rival == "4-4-2D") {
                //     $plan_rival = "4-4-2";
                // } else if ($plan_rival == "4-4-1-1") {
                //     $plan_rival = "4-4-2";
                // }
                switch ($plan_rival) {
                    case '4-4-2':
                        $planOne = "4-4-1-1";
                        $planTwo = "4-1-3-2";
                        break;
                    case '4-4-2D':
                        $planOne = "4-5-1";
                        $planTwo = "4-3-1-2";
                        break;
                    case '4-3-3':
                        $planOne = "5-3-2";
                        $planTwo = "4-4-2";
                        break;
                    case '4-4-1-1':
                        $planOne = "4-4-2D";
                        $planTwo = "4-3-1-2";
                        break;
                    case '3-4-3':
                        $planOne = "4-1-3-2";
                        $planTwo = "4-4-2D";
                        break;
                    case '5-3-2':
                        $planOne = "3-4-3";
                        $planTwo = "4-4-2";
                        break;
                    default:
                        break;
                }

                //recommended
                $namePlanOne = $planOne;
                $namePlanTwo = $planTwo;

                //change plan 1
                if ($planOne == "4-4-2D") {
                    $planOne = "4-4-2";
                } else if ($planOne == "4-4-1-1") {
                    $planOne = "4-4-2";
                } else if ($planOne == "4-1-3-2") {
                    $planOne = "4-4-2";
                }

                //change plan 2
                if ($planTwo == "4-4-2D") {
                    $planTwo = "4-4-2";
                } else if ($planTwo == "4-4-1-1") {
                    $planTwo = "4-4-2";
                } else if ($planTwo == "4-3-1-2") {
                    $planTwo = "4-4-3";
                }else if ($planTwo == "4-1-3-2") {
                    $planTwo = "4-4-2";
                }


                $pointPlanOne = str_replace('-', '', $planOne);
                $countPlanOne = str_split($pointPlanOne);

                $pointPlanTwo = str_replace('-', '', $planTwo);
                $countPlanTwo = str_split($pointPlanTwo);
                if ($countPlanOne) {
                    $GoalkeeperOne = findRec(1, $pointGoalkeeper);
                    $DefenderOne = findRec((int)$countPlanOne[0], $pointDefender);
                    $MidfieldOne = findRec((int)$countPlanOne[1], $pointMidfield);
                    $ForwardOne = findRec((int)$countPlanOne[2], $pointForward);
                }
                if ($countPlanTwo) {
                    $GoalkeeperTwo = findRec(1, $pointGoalkeeper);
                    $DefenderTwo = findRec((int)$countPlanTwo[0], $pointDefender);
                    $MidfieldTwo = findRec((int)$countPlanTwo[1], $pointMidfield);
                    $ForwardTwo = findRec((int)$countPlanTwo[2], $pointForward);
                }

                $playerRecommendOne = array_merge($GoalkeeperOne, $DefenderOne, $MidfieldOne, $ForwardOne);
                $playerRecommendTwo = array_merge($GoalkeeperTwo, $DefenderTwo, $MidfieldTwo, $ForwardTwo);

                if (
                    $GoalkeeperOne && $DefenderOne && $MidfieldOne && $ForwardOne &&
                    $GoalkeeperTwo && $DefenderTwo && $MidfieldTwo && $ForwardTwo
                ) {
                    $recommendOne = array(
                        'listOne' => DB::table('player')
                            ->whereIn('id_m', $playerRecommendOne)
                            ->get()
                    );
                    $recommendTwo = array(
                        'listTwo' => DB::table('player')
                            ->whereIn('id_m', $playerRecommendTwo)
                            ->get()
                    );
                    // return view(
                    //     'page.pageRecommend',
                    //     $recommendOne,
                    //     ['plan01' => $namePlanOne],
                    //     $recommendTwo,
                    //     ['plan02' => $namePlanTwo]
                    // );
                    return view('page.pageRecommend')
                        ->with($recommendOne)
                        ->with($recommendTwo)
                        ->with('plan01', $namePlanOne)
                        ->with('plan02', $namePlanTwo);
                }
            }
        } else {
            echo "404 Not found";
        }
    }

    public function getMemberRival($id_mr)
    {
        $mr = DB::table('member_rival')->where('id_rival', $id_mr)->get();
        if ($mr) {
            return response()->json([
                'status' => 200,
                'data' => $mr,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'List not found',
            ]);
        }
    }
}
