@extends('layouts.app')

@section('title', 'Buat Pengaduan')

@section('css')
<style>
    .content {
        background-color: #fff;
        border-radius: 11px;
        text-align: left;
    }

    .content h1 {
        font-weight: 500;
        font-size: 22px;
    }

    .content p {
        font-weight: 300;
        font-size: 16px;
        color: #707070;
    }

</style>
@endsection

@section('jumbotron')
<div class="row justify-content-center">
    <div class="col-lg-5 col-md-11 col-11">
        <div class="content p-5">
            <h1>Edit Pengaduan Disini</h1>
            <p>Setelah pengaduan di edit, petugas sekolah<br>akan memverifikasi kembali kebenarannya terlebih dahulu!</p>
            <div class="mt-2">
                <form action="{{ route('call.laporanUpdate', $pengaduan->id_pengaduan) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="judul_laporan">Judul Laporan</label>
                        <input type="text" value="{{ $pengaduan->judul_laporan }}" name="judul_laporan" id="judul_laporan"
                            placeholder="Tulis Judul Pengaduan Anda" class="form-control @error('judul_laporan') is-invalid @enderror">
                        @error('judul_laporan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="isi_laporan">Isi Laporan</label>
                        <textarea name="isi_laporan" id="isi_laporan" rows="5" placeholder="Tulis Isi Pengaduan Anda" class="form-control @error('isi_laporan') is-invalid @enderror">{{ $pengaduan->isi_laporan }}</textarea>
                        @error('isi_laporan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="tgl_kejadian">Tanggal Kejadian</label>
                        <input type="text" value="{{ $pengaduan->tgl_kejadian->format('d-m-Y') }}" name="tgl_kejadian"
                            placeholder="Pilih Tanggal Kejadian" class="form-control @error('tgl_kejadian') is-invalid @enderror" onfocusin="(this.type='date')"
                            onfocusout="(this.type='text')">
                        @error('tgl_kejadian')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="lokasi_kejadian">Tulis Lokasi Kejadian</label>
                        <textarea name="lokasi_kejadian" id="lokasi_kejadian" rows="3" class="form-control @error('lokasi_kejadian') is-invalid @enderror mb-3"
                            placeholder="Tulis Lokasi Kejadian">{{ $pengaduan->lokasi_kejadian }}</textarea>
                        @error('lokasi_kejadian')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="kategori_kejadian">Pilih Kategori Kejadian</label>
                        <div class="input-group mb-3">
                            <select name="kategori_kejadian" id="kategori_kejadian" class="custom-select" required>
                                @if ($pengaduan->kategori_kejadian == 'agama')
                                <option selected value="agama">Agama</option>
                                <option value="hukum">Hukum</option>
                                <option value="lingkungan">Lingkungan</option>
                                <option value="sosial">Sosial</option>
                                @elseif ($pengaduan->kategori_kejadian == 'hukum')
                                <option value="agama">Agama</option>
                                <option selected value="hukum">Hukum</option>
                                <option value="lingkungan">Lingkungan</option>
                                <option value="sosial">Sosial</option>
                                @elseif ($pengaduan->kategori_kejadian == 'lingkungan')
                                <option value="agama">Agama</option>
                                <option value="hukum">Hukum</option>
                                <option selected value="lingkungan">Lingkungan</option>
                                <option value="sosial">Sosial</option>
                                @else
                                <option value="agama">Agama</option>
                                <option value="hukum">Hukum</option>
                                <option value="lingkungan">Lingkungan</option>
                                <option selected value="sosial">Sosial</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="foto">Tambahkan Bukti Foto</label>
                        <input type="file" value="{{ $pengaduan->foto }}" name="foto" id="foto" class="form-control @error('file') is-invalid @enderror">
                        @error('file')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-custom text-white mt-3" style="width: 100%">SIMPAN</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')

    @if (session()->has('pengaduan'))
        <script>
            Swal.fire({
                title: 'Pemberitahuan!',
                text: '{{ session()->get('pengaduan') }}',
                icon: '{{ session()->get('type') }}',
                confirmButtonColor: '#28B7B5',
                confirmButtonText: 'OK',
            });
        </script>
    @endif
@endsection