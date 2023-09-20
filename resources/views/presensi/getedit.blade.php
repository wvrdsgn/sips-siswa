@foreach ($siswa as $data)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $data->nis }}</td>
        <td>{{ $data->nama_lengkap }}</td>
        <td>{{ $data->kode_kelas }}</td>
        <td>{{ $tanggal }}
            <input type="hidden" name="tanggal" value="{{ $tanggal }}">
        </td>
        @if ($izin->has($data->nis) && $izin[$data->nis]->status)
            <td>
                @if ($izin[$data->nis]->status === 'S')
                    <span class="badge bg-yellow text-center">Sakit</span>
                @elseif ($izin[$data->nis]->status === 'I')
                    <span class="badge bg-success text-center">Izin</span>
                @endif
            </td>
        @elseif ($presensi->has($data->nis) && $presensi[$data->nis]->status === 'H')
            <td><span class="badge bg-indigo text-center">Hadir</span></td>
        @elseif ($presensi->has($data->nis) && $presensi[$data->nis]->status === 'A')
            <td><span class="badge bg-red text-center">Alpha</span></td>
        @else
            <td><span class="badge bg-red-lt text-center">Belum Absen</span></td>
        @endif
        <td>
            <input type="checkbox" name="selected_siswa[]" value="{{ $data->nis }}">
        </td>
        <td>
            @if ($presensi->has($data->nis))
                <form action="{{ route('cancel.presensi', ['nis' => $data->nis]) }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm btn-pill">Cancel</button>
                </form>
            @endif
        </td>
    </tr>
@endforeach
