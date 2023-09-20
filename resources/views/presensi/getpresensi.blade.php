    @foreach ($siswa as $data)
        @php
            $foto_in = Storage::url('uploads/absensi/' . ($presensi[$data->nis]->foto_in ?? ''));
            $foto_out = Storage::url('uploads/absensi/' . ($presensi[$data->nis]->foto_out ?? ''));
        @endphp
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $data->nis }}</td>
            <td>{{ $data->nama_lengkap }}</td>
            <td>{{ $data->kode_kelas }}</td>
            @if ($presensi->has($data->nis))
                <td>{{ $presensi[$data->nis]->jam_in }}</td>
                <td><img src="{{ url($foto_in) }}" class="avatar" alt=""></td>
                <td>
                    @if ($presensi[$data->nis]->jam_out)
                        {{ $presensi[$data->nis]->jam_out }}
                    @else
                        <span class="badge bg-danger">Belum Absen</span>
                    @endif
                </td>
                <td>
                    @if ($presensi[$data->nis]->jam_out)
                        <img src="{{ url($foto_out) }}" class="avatar" alt="">
                    @else
                        <span>-</span>
                    @endif
                </td>
                <td>
                    @if ($presensi[$data->nis]->jam_in === null)
                    <span class="badge">Tidak Hadir</span>
                    @elseif ($presensi[$data->nis]->jam_in >= '07:00')
                        <span class="badge bg-danger">Terlambat</span>
                    @else
                        <span class="badge bg-primary">Tepat Waktu</span>
                    @endif
                </td>
            @else
                <td><span class="badge bg-danger text-center">Belum Absen</span></td>
                <td class="text-center">-</td>
                <td><span class="badge bg-danger text-center">Belum Absen</span></td>
                <td class="text-center">-</td>
                <td class="text-center">-</td>
            @endif
            <td>
                <a href="#" class="btn btn-outline-indigo btn-icon tampilkanpeta"
                    style="border-radius: 100% !important;" data-id="{{ $presensi[$data->nis]?->id ?? '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-map-pin-filled"
                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path
                            d="M18.364 4.636a9 9 0 0 1 .203 12.519l-.203 .21l-4.243 4.242a3 3 0 0 1 -4.097 .135l-.144 -.135l-4.244 -4.243a9 9 0 0 1 12.728 -12.728zm-6.364 3.364a3 3 0 1 0 0 6a3 3 0 0 0 0 -6z"
                            stroke-width="0" fill="currentColor"></path>
                    </svg>
                </a>
                {{-- <a href="#" class="btn btn-outline-green btn-icon editstatus"
                    style="border-radius: 100% !important;" data-id_editstatus="{{ $presensi[$data->nis]?->id ?? '' }}"
                    data-nis="{{ $data->nis }}" data-tanggal="{{ $tanggal }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24"
                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                        <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                        <path d="M16 5l3 3"></path>
                    </svg>
                </a> --}}
            </td>

        </tr>
    @endforeach
    <script>
        $(function() {
            $(".tampilkanpeta").click(function(e) {
                var id = $(this).data("id");
                $.ajax({
                    type: 'POST',
                    url: '/tampilkanpeta',
                    cache: false,
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id
                    },
                    success: function(respond) {
                        $("#loadmap").html(respond);
                    }
                });
                $("#modal-tampilkanpeta").modal("show");
            });

            //         $(".editstatus").click(function(e) {
            //             e.preventDefault();
            // var nis = $(this).data("nis");
            // var tanggal = $(this).data("tanggal");
            // var id_editstatus = $(this).data("id_editstatus");
            //             var tanggal_presensi = $("#tanggal").val();
            //             var nis = $(this).closest("tr").find("td:nth-child(2)").text();
            //             var nama_siswa = $(this).closest("tr").find("td:nth-child(3)").text();
            //             var nama_kelas = $(this).closest("tr").find("td:nth-child(4)").text();

            //             $("#id_editstatus_form").val(id_editstatus);
            //             $("#tanggal_presensi").val(
            //             tanggal_presensi); // Set the value of the 'tanggal_presensi' field
            //             $("#modal-tanggal-izin").text(tanggal_presensi);
            //             $("#modal-nama-siswa").text(nama_siswa);
            //             $("#modal-nama-kelas").text(nama_kelas);

            //             $("#modal-editpresensi").modal("show");
            //         });
        });
    </script>
