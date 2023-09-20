@foreach ($laporan as $d)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $d->nis }}</td>
        <td>{{ $d->nama_lengkap }}</td>
        <td>{{ $d->kode_kelas }}</td>
        <td>{{ $d->jumlah_hadir }}</td>
        <td>{{ $d->jumlah_sakit }}</td>
        <td>{{ $d->jumlah_izin }}</td>
        <td>{{ $d->jumlah_alpha }}</td>
        <td></td>
    </tr>
@endforeach
