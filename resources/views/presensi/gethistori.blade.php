@if ($histori->isEmpty())
    <div class="p-2 text-danger border border-danger rounded">
        Data tidak ditemukan
    </div>
@endif
@foreach ($histori as $d)
    <ul class="listview image-listview">
        <li>
            <div class="item">
                @php
                    $path = Storage::url('uploads/absensi/' . $d->foto_in);
                @endphp

                @if (!empty($d->foto_in) && file_exists(public_path($path)))
                    <img src="{{ $path }}" alt="image" class="image">
                @else
                <div class="icon-box bg-danger">
                    <ion-icon name="close-circle-outline"></ion-icon>
                </div>
                @endif

                <div class="in">
                    <div><b>{{ date('d-m-Y', strtotime($d->tgl_presensi)) }}</b>
                        {{-- <br><small class="text-muted">{{ $d->jabatan }}</small> --}}
                    </div>
                    <span
                        class="badge {{ $d->jam_in < '07:10' ? 'bg-primary' : 'bg-danger' }}">{{ $d->jam_in }}</span>
                    <span class="badge bg-primary">{{ $d->jam_out }}</span>
                </div>
            </div>
        </li>
    </ul>
@endforeach
