@extends('layouts.presensi')
@section('header')
    <!-- App Header -->
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="javascript:;" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Data Izin</div>
        <div class="right"></div>
    </div>
    <!-- * App Header -->
@endsection
@section('content')
<style>
    .listview .item {
        border: 1px solid #ccc;
        border-radius: 10px;
        padding: 10px;
        margin-bottom: 10px;
    }
</style>

    <div class="row" style="margin-top: 72px">
        <div class="col">
            @php
                $messagesuccess = Session::get('success');
                $messageerror = Session::get('error');
            @endphp
            @if (Session::get('success'))
                <div class="alert alert-success">
                    {{ $messagesuccess }}
                </div>
            @endif
            @if (Session::get('error'))
                <div class="alert alert-danger">
                    {{ $messageerror }}
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col">
        @foreach ($dataizin as $d)
        <ul class="listview image-listview my-2">
            <li>
                <div class="shadow item">
                    <div class="in">
                        <div><b>{{ date('d-m-Y', strtotime($d->tgl_izin)) }} ({{$d->status== "S" ? "Sakit" : "Izin"}})</b></div>
                        @if ($d->status_approved == 0)
                            <span class="badge bg-warning">Menunggu...</span>
                        @elseif ($d->status_approved == 1)
                            <span class="badge bg-primary">Disetujui</span>
                        @elseif ($d->status_approved == 2)
                            <span class="badge bg-danger">Ditolak</span>
                        @endif
                    </div>
                </div>
            </li>
        </ul>

        @endforeach
    </div>
    </div>
    <div class="fab-button bottom-right" style="margin-bottom: 72px;">
        <a href="/presensi/getizin" class="fab">
            <ion-icon name="add"></ion-icon>
        </a>
    </div>
@endsection
