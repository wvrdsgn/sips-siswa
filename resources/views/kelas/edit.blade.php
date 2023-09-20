<form action="/kelas/{{ $kelas->kode_kelas }}/update" method="POST" id="formKelas">
    @csrf
    <div class="row mb-3 align-items-end">
        <div class="col">
            <label class="form-label">Kode Kelas</label>
            <input type="text" name="kode_kelas" id="kode_kelas"
                class="form-control form-control-rounded" value="{{ $kelas->kode_kelas }}" disabled/>
        </div>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="nama_kelas" name="nama_kelas"
            autocomplete="off" value="{{ $kelas->nama_kelas }}">
        <label for="floating-input">Nama Kelas</label>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-indigo btn-pill"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-reload" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <path d="M19.933 13.041a8 8 0 1 1 -9.925 -8.788c3.899 -1 7.935 1.007 9.425 4.747"></path>
            <path d="M20 4v5h-5"></path>
         </svg>Update</button>
    </div>
</form>
