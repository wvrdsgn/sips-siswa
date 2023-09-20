<form action="/siswa/{{ $siswa->nis}}/update" method="POST" id="formSiswa" enctype="multipart/form-data">
    @csrf
    <div class="row mb-3 align-items-end">
        <div class="col">
            <label class="form-label mb-2">Foto Siswa</label>
            <input type="file"  name="foto" id="foto" class="form-control btn-pill"/>
            <input type="hidden" name="old_foto" value="{{ $siswa->foto}}">
        </div>

        <div class="col">
            <label class="form-label">Nomor Induk Siswa (NIS)</label>
            <input type="text" name="nis" id="nis" class="form-control form-control-rounded" value="{{ $siswa->nis }}" disabled/>
        </div>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" autocomplete="off" value="{{ $siswa->nama_lengkap }}">
        <label for="floating-input">Nama Lengkap</label>
    </div>
    <div class="form-floating mb-3">
        <select class="form-select" id="jk" name="jk">
            <option value=""></option>
            <option {{ $siswa->jk == 'L' ? 'selected' : '' }} value="L">Laki-laki</option>
            <option {{ $siswa->jk == 'P' ? 'selected' : '' }} value="P">Perempuan</option>
        </select>
        <label for="floatingSelect">Jenis Kelamin</label>
    </div>
    <div class="form-floating mb-3">
        <select class="form-select" id="kode_kelas" name="kode_kelas">
            <option value=""></option>
            @foreach ($kelas as $d)
                <option {{ $siswa->kode_kelas == $d->kode_kelas ? 'selected' : '' }}
                    value="{{ $d->kode_kelas }}">
                    {{ $d->nama_kelas }}</option>
            @endforeach
        </select>
        <label for="floatingSelect">Kelas</label>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="no_hp" name="no_hp" autocomplete="off" value="{{ $siswa->no_hp}}">
        <label for="floating-input">Nomor HP</label>
    </div>
    <div class="form-floating mb-3">
        <textarea type="text" class="form-control" id="alamat" name="alamat" autocomplete="off" rows="3"> {{ $siswa->alamat}}</textarea>
        <label for="floating-input">Alamat</label>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-indigo btn-pill"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-reload" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <path d="M19.933 13.041a8 8 0 1 1 -9.925 -8.788c3.899 -1 7.935 1.007 9.425 4.747"></path>
            <path d="M20 4v5h-5"></path>
         </svg>Update</button>
    </div>
</form>
@push('myscript')
{{-- UPLOAD-FILE/PHOTO-DATA-SISWA --}}
<script>
    const uploadInput = document.getElementById("foto");
    const avatarUpload = document.querySelector(".avatar-upload");

    uploadInput.addEventListener("change", function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();

            reader.addEventListener("load", function() {
                const imgData = this.result;
                const img = document.createElement("img");
                img.src = imgData;
                avatarUpload.innerHTML = "";
                avatarUpload.appendChild(img);
            });

            reader.readAsDataURL(file);
        }
    });
</script>
@endpush
