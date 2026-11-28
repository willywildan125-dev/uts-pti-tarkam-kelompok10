@extends('layouts.app')
@section('title', 'Dashboard - Tarkam Bola')

@section('content')
@auth
<div class="card shadow-sm mb-4">
    <div class="card-body">
        <h5 class="mb-3">Selamat datang, {{ $user->Nama_user }}</h5>
        <table class="table table-bordered table-sm mb-0" style="max-width: 480px">
            <tr><th style="width:140px">Email</th><td>{{ $user->email }}</td></tr>
            <tr><th>Role</th><td>{{ ucfirst($user->role) }}</td></tr>
            <tr><th>Tim</th><td>{{ $user->tim->Nama_tim ?? '-' }}</td></tr>
        </table>
    </div>
</div>
@else
<div class="alert alert-success d-flex justify-content-between align-items-center shadow-sm mb-4">
    <div>
        <strong>Selamat datang di Dashboard Tarkam Bola!</strong>
        <span class="d-block small">Pantau klasemen tim dan bagan pertandingan secara langsung.</span>
    </div>
</div>
@endauth

<div class="row g-4">
    <div class="col-lg-6">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-white fw-semibold">
                Klasemen &amp; Daftar Tim
            </div>
            <div class="card-body p-0">
                @if ($standings->isEmpty())
                    <p class="text-muted text-center py-4 mb-0">Belum ada data tim.</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-striped table-hover mb-0 align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Tim</th>
                                    <th>Asal</th>
                                    <th class="text-center">Main</th>
                                    <th class="text-center">M</th>
                                    <th class="text-center">S</th>
                                    <th class="text-center">K</th>
                                    <th class="text-center">SG</th>
                                    <th class="text-center">Poin</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($standings as $index => $team)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td class="fw-medium">{{ $team->Nama_tim }}</td>
                                        <td class="text-muted small">{{ $team->asal }}</td>
                                        <td class="text-center">{{ $team->played }}</td>
                                        <td class="text-center">{{ $team->wins }}</td>
                                        <td class="text-center">{{ $team->draws }}</td>
                                        <td class="text-center">{{ $team->losses }}</td>
                                        <td class="text-center">{{ $team->gd }}</td>
                                        <td class="text-center fw-bold">{{ $team->points }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-white fw-semibold">
                Bagan &amp; Jadwal Pertandingan
            </div>
            <div class="card-body">
                @if ($gamesByRound->isEmpty())
                    <p class="text-muted text-center py-3 mb-0">Belum ada jadwal pertandingan.</p>
                @else
                    @foreach ($gamesByRound as $ronde => $games)
                        <h6 class="text-success fw-semibold mt-2 mb-2">Ronde {{ $ronde }}</h6>
                        <div class="list-group mb-3">
                            @foreach ($games as $game)
                                @php
                                    $t1 = $game->participants->get(0);
                                    $t2 = $game->participants->get(1);
                                @endphp
                                <div class="list-group-item">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <span class="badge bg-secondary">{{ $game->lapangan }}</span>
                                        <small class="text-muted">{{ $game->Jadwal }}</small>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center fw-medium">
                                        <span>{{ $t1->Nama_tim ?? 'TBD' }}</span>
                                        <span class="px-2">
                                            @if ($t1 && $t2 && $t1->Skor !== null && $t2->Skor !== null)
                                                {{ $t1->Skor }} - {{ $t2->Skor }}
                                                @if ($t1->Penalti !== null && $t2->Penalti !== null)
                                                    <small class="text-muted">({{ $t1->Penalti }}-{{ $t2->Penalti }} P)</small>
                                                @endif
                                            @else
                                                vs
                                            @endif
                                        </span>
                                        <span>{{ $t2->Nama_tim ?? 'TBD' }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
