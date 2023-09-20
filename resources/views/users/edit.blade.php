<form action="/users/{{ $user->id }}/update" method="POST" id="formUser" enctype="multipart/form-data">
    @csrf
    <div class="row mb-3 align-items-end">
        <div class="col">
            <label class="form-label mb-2">Foto User</label>
            <input type="file"  name="foto" id="foto" class="form-control btn-pill"/>
            <input type="hidden" name="old_foto" value="{{ $user->foto}}">
        </div>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="name" name="name"
            autocomplete="off" value="{{ $user->name }}">
        <label for="floating-input">Nama Lengkap</label>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="email" name="email"
            autocomplete="off" value="{{ $user->email }}">
        <label for="floating-input">Email</label>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="jabatan" name="jabatan"
            autocomplete="off" value="{{ $user->jabatan }}">
        <label for="floating-input">Jabatan</label>
    </div>
    <div class="form-floating mb-3">
        <select class="form-select" id="role_id" name="role_id">
            <option value=""></option>
            @foreach ($roles as $d)
                <option {{ $user->role_id == $d->role_id ? 'selected' : '' }}
                    value="{{ $d->role_id }}">
                    {{ $d->nama_role }}</option>
            @endforeach
        </select>
        <label for="floatingSelect">Role</label>
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
