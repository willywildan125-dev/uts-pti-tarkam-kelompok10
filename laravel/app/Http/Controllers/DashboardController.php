<?php

namespace App\Http\Controllers;

use App\Models\Tim;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $user = Auth::user()?->load('tim');

        $teams = Tim::orderBy('Nama_tim')->get();

        $games = DB::table('game')
            ->orderBy('Ronde')
            ->orderBy('Jadwal')
            ->get()
            ->map(function ($game) {
                $participants = DB::table('bertanding')
                    ->join('tim', 'bertanding.Id_tim', '=', 'tim.id_tim')
                    ->where('bertanding.Id_game', $game->Id_game)
                    ->select('tim.id_tim', 'tim.Nama_tim', 'tim.asal', 'bertanding.Skor', 'bertanding.Penalti')
                    ->get();

                $game->participants = $participants;
                return $game;
            });

        $standings = $teams->map(function ($team) use ($games) {
            $played = 0;
            $wins = 0;
            $draws = 0;
            $losses = 0;
            $gf = 0;
            $ga = 0;

            foreach ($games as $game) {
                $p = $game->participants->firstWhere('id_tim', $team->id_tim);
                if (!$p || $p->Skor === null) {
                    continue;
                }

                $opponent = $game->participants->firstWhere('id_tim', '!=', $team->id_tim);
                if (!$opponent || $opponent->Skor === null) {
                    continue;
                }

                $played++;
                $gf += (int) $p->Skor;
                $ga += (int) $opponent->Skor;

                if ($p->Skor > $opponent->Skor) {
                    $wins++;
                } elseif ($p->Skor < $opponent->Skor) {
                    $losses++;
                } else {
                    if ($p->Penalti !== null && $opponent->Penalti !== null) {
                        if ($p->Penalti > $opponent->Penalti) {
                            $wins++;
                        } elseif ($p->Penalti < $opponent->Penalti) {
                            $losses++;
                        } else {
                            $draws++;
                        }
                    } else {
                        $draws++;
                    }
                }
            }

            return (object) [
                'id_tim' => $team->id_tim,
                'Nama_tim' => $team->Nama_tim,
                'asal' => $team->asal,
                'played' => $played,
                'wins' => $wins,
                'draws' => $draws,
                'losses' => $losses,
                'gf' => $gf,
                'ga' => $ga,
                'gd' => $gf - $ga,
                'points' => ($wins * 3) + $draws,
            ];
        })->sortByDesc('points')->sortByDesc('gd')->values();

        return view('dashboard', [
            'user' => $user,
            'gamesByRound' => $games->groupBy('Ronde'),
            'standings' => $standings,
        ]);
    }
}
