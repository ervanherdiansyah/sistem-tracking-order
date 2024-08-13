<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('argon') }}/assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo.png') }}">
    <title>
        WEBSITE KTA
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('argon') }}/assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="{{ asset('argon') }}/assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{{ asset('argon') }}/assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('argon') }}/assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
</head>

<body class="">
    <main class="main-content  mt-0">
        <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg"
            style="background-image: url('argon/assets/img/bgp.jpg'); background-position: top;">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10 text-center mx-auto">
                        <h1 class="text-white mb-2 mt-5">WEBSITE OPREC ANGGOTA</h1>
                        <p class="text-lead text-white">Forum OSIS Jawa Barat adalah organisasi binaan Dinas Pendidikan
                            Provinsi Jawa Barat, Suatu wadah perkumpulan dan pengembangan kualitas diri para pelajar
                            tingkat SMA/SMK/MA Se-Derajat yang tergabung dalam kepengurusan OSIS ditiap sekolah dengan
                            Visi “menjadi inkubator pemimpin muda Jawa Barat berkarakter STRONG untuk Indonesia Emas
                            Tahun 2045” FOJB ini Didirikan oleh 6 anak muda hebat asli Jawa Barat sejak 5 Januari 2013
                            menjadikan FOJB sebagai Perkumpulan OSIS tertua di Indonesia. Proses pengukuhannya secara
                            resmi dilakukan oleh Gubernur Jawa Barat saat itu. Dewasa kini Ikatan Alumni FOJB atau kerap
                            disebut IKAL telah mencapai 15.000 anggota yang tersebar di berbagai posisi strategis di
                            Jawa Barat bahkan Luar Negeri. Kedepannya Forum OSIS Jawa Barat akan terus berbenah hingga
                            alumni-alumni nya dapat terus berkarya dan bermanfaat untuk masyarakat Indonesia..</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
                <div id="register-form-container">
                    <div class="col-xl-6 col-lg-5 col-md-7 mx-auto">
                        <div class="card z-index-0">
                            <div class="card-header text-center pt-4">
                                <h5>Register Akun </h5>
                            </div>
                            <div class="card-body">
                                <form id="register-form" role="form" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3">
                                                <input name="name" type="text" class="form-control"
                                                    placeholder="Name" aria-label="Name" value="{{ old('name') }}">
                                                @error('name')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <input name="email" type="email" class="form-control"
                                                    placeholder="Email" aria-label="Email" value="{{ old('email') }}">
                                                @error('email')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <input name="password" type="password" class="form-control"
                                                    placeholder="Password" aria-label="Password">
                                                @error('password')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <input name="password_confirmation" type="password" class="form-control"
                                                    placeholder="Password Confirmation" aria-label="Password">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-check form-check-info text-start">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckDefault" checked>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            I agree the <a href="javascript:;"
                                                class="text-dark font-weight-bolder">Terms
                                                and Conditions</a>
                                        </label>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Sign
                                            up</button>
                                    </div>
                                    <p class="text-sm mt-3 mb-0">Already have an account? <a href="{{ url('/') }}"
                                            class="text-dark font-weight-bolder">Sign
                                            in</a></p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="registration-form-container" style="display: none;">
                    <div class="col-xl-8 col-lg-5 col-md-7 mx-auto">
                        <div class="card z-index-0">
                            <div class="card-header text-center pt-4">
                                <h5>Form Pendaftaran </h5>
                            </div>
                            <div class="card-body">
                                <form role="form" action="{{ url('/createform') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <input type="hidden" name="user_id" type="text" class="form-control"
                                            aria-label="Name" value="">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="example-text-input" class="form-control-label">Nama
                                                    Lengkap</label>
                                                <input name="nama_lengkap" type="text" class="form-control"
                                                    placeholder="Nama Lengkap" aria-label="Name"
                                                    value="{{ old('nama_lengkap') }}">
                                                @error('nama_lengkap')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="example-text-input" class="form-control-label">Tempat
                                                    Lahir</label>
                                                <input name="tempat_lahir" type="text" placeholder="Tempat lahir"
                                                    class="form-control" value="{{ old('tempat_lahir') }}">
                                                @error('tempat_lahir')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="example-text-input" class="form-control-label">Tanggal
                                                    Lahir</label>
                                                <input name="tanggal_lahir" type="date"
                                                    placeholder="Tanggal lahir" class="form-control"
                                                    value="{{ old('tanggal_lahir') }}">
                                                @error('tanggal_lahir')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="example-text-input" class="form-control-label">Jenis
                                                    Kelamin</label>
                                                <select name="jenis_kelamin" id=""
                                                    class="form-control form-select">
                                                    <option value="">Pilih</option>
                                                    <option value="Laki-laki"
                                                        @if (old('jenis_kelamin') == 'Laki-laki') selected @endif>
                                                        Laki-laki
                                                    </option>
                                                    <option value="Perempuan"
                                                        @if (old('jenis_kelamin') == 'Perempuan') selected @endif>
                                                        Perempuan
                                                    </option>
                                                </select>
                                                @error('jenis_kelamin')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="example-text-input"
                                                    class="form-control-label">Agama</label>
                                                <select name="agama" id=""
                                                    class="form-control form-select">
                                                    <option value="">Pilih</option>
                                                    <option value="Islam"
                                                        @if (old('agama') == 'Islam') selected @endif>Islam
                                                    </option>
                                                    <option value="Kristen Khatolik"
                                                        @if (old('agama') == 'Kristen Khatolik') selected @endif>
                                                        Kristen Khatolik
                                                    </option>
                                                    <option value="Kristen Protestan"
                                                        @if (old('agama') == 'Kristen Protestan') selected @endif>
                                                        Kristen Protestan
                                                    </option>
                                                    <option value="Budha"
                                                        @if (old('agama') == 'Budha') selected @endif>Budha
                                                    </option>
                                                    <option value="Hindu"
                                                        @if (old('agama') == 'Hindu') selected @endif>Hindu
                                                    </option>
                                                    <option value="konghuchu"
                                                        @if (old('agama') == 'konghuchu') selected @endif>konghuchu
                                                    </option>
                                                </select>
                                                @error('agama')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="example-text-input"
                                                    class="form-control-label">Email</label>
                                                <input name="email" placeholder="Email" class="form-control"
                                                    type="email" value="{{ old('email') }}">
                                                @error('email')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="example-text-input" class="form-control-label">No
                                                    Hp</label>
                                                <input name="hp" placeholder="No Hp" class="form-control"
                                                    type="text" value="{{ old('hp') }}">
                                                @error('hp')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="example-text-input"
                                                    class="form-control-label">Instagram</label>
                                                <input name="instagram" placeholder="Instagram" class="form-control"
                                                    type="text" value="{{ old('instagram') }}">
                                                @error('instagram')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="example-text-input"
                                                    class="form-control-label">Alamat</label>
                                                <textarea name="alamat" id="" class="form-control">{{ old('alamat') }}</textarea>
                                                @error('alamat')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="example-text-input" class="form-control-label">Asal
                                                    sekolah</label>
                                                <input name="asal_sekolah" placeholder="Asal Sekolah"
                                                    class="form-control" type="text"
                                                    value="{{ old('asal_sekolah') }}">
                                                @error('asal_sekolah')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="example-text-input" class="form-control-label">Kota atau
                                                    Kabupaten Sekolah</label>
                                                <select name="alamat_asal_sekolah" id="kota"
                                                    class="form-control form-select">
                                                    <option value="">Pilih Kab/Kota</option>
                                                </select>
                                                @error('alamat_asal_sekolah')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="example-text-input"
                                                    class="form-control-label">Kelas</label>
                                                <select name="kelas" id=""
                                                    class="form-control form-select">
                                                    <option value="">Pilih</option>
                                                    <option value="VII"
                                                        @if (old('kelas') == 'VII') selected @endif>
                                                        VII
                                                    </option>
                                                    <option value="VIII"
                                                        @if (old('kelas') == 'VIII') selected @endif>
                                                        VIII
                                                    </option>
                                                    <option value="IX"
                                                        @if (old('kelas') == 'IX') selected @endif>
                                                        IX
                                                    </option>
                                                    <option value="X"
                                                        @if (old('kelas') == 'X') selected @endif>
                                                        X
                                                    </option>
                                                    <option value="XI"
                                                        @if (old('kelas') == 'XI') selected @endif>
                                                        XI
                                                    </option>
                                                    <option value="XII"
                                                        @if (old('kelas') == 'XII') selected @endif>
                                                        XII
                                                    </option>
                                                    <option value="SLTP Sederajat"
                                                        @if (old('kelas') == 'SLTP Sederajat') selected @endif>
                                                        SLT Sederajat
                                                    </option>
                                                </select>
                                                @error('kelas')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="example-text-input" class="form-control-label">Jenjang
                                                    Pendidikan</label>
                                                <select name="jurusan" id=""
                                                    class="form-control form-select">
                                                    <option value="">Pilih</option>
                                                    <option value="SMA"
                                                        @if (old('jurusan') == 'SMA') selected @endif>
                                                        SMA
                                                    </option>
                                                    <option value="SMK"
                                                        @if (old('jurusan') == 'SMK') selected @endif>
                                                        SMK
                                                    </option>
                                                    <option value="MA"
                                                        @if (old('jurusan') == 'MA') selected @endif>
                                                        MA
                                                    </option>
                                                    <option value="SMP"
                                                        @if (old('jurusan') == 'SMP') selected @endif>
                                                        SMP
                                                    </option>
                                                    <option value="MTS"
                                                        @if (old('jurusan') == 'MTS') selected @endif>
                                                        MTS
                                                    </option>
                                                </select>
                                                @error('jurusan')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit"
                                            class="btn bg-gradient-dark w-100 my-4 mb-2">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!--   Core JS Files   -->
    <script src="{{ asset('argon') }}/assets/js/core/popper.min.js"></script>
    <script src="{{ asset('argon') }}/assets/js/core/bootstrap.min.js"></script>
    <script src="{{ asset('argon') }}/assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="{{ asset('argon') }}/assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('argon') }}/assets/js/argon-dashboard.min.js?v=2.0.4"></script>
    <script>
        // function getProvinces() {
        //     fetch('https://kanglerian.github.io/api-wilayah-indonesia/api/regencies/32.json')
        //         .then(response => response.json())
        //         .then(provinces => {
        //             const provinceSelect = document.getElementById('kota');
        //             provinceSelect.innerHTML = '<option value="">Pilih Provinsi</option>';
        //             provinces.forEach(province => {
        //                 const option = document.createElement('option');
        //                 option.text = province.name;
        //                 option.value = province.name; // Nilai dari opsi disetel menjadi nama provinsi
        //                 option.dataset.id = province.id; // Menyimpan ID provinsi ke dalam atribut data
        //                 provinceSelect.add(option);
        //             });
        //         });
        // }
        fetch('https://kanglerian.github.io/api-wilayah-indonesia/api/regencies/32.json')
            .then(response => response.json())
            .then(provinces => {
                var data = provinces;
                var tampung = '<option value="">Pilih Kota/Kabupaten</option>';
                data.forEach(element => {
                    tampung +=
                        `<option value="${element.name}">${element.name}</option>`
                });
                document.getElementById('kota').innerHTML = tampung;
            });
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Penanganan acara untuk tombol "Sign up"
        $(document).on('submit', '#register-form', function(event) {
            // Lakukan AJAX request untuk membuat akun
            $.ajax({
                url: '/createregister',
                method: 'POST',
                data: $(this).serialize(), // Serialize formulir untuk dikirimkan
                success: function(response) {

                    sessionStorage.setItem('registerData', JSON.stringify(response));
                    // Sembunyikan formulir register akun setelah berhasil membuat akun
                    $('#register-form-container').hide();
                    // Tampilkan formulir pendaftaran setelah berhasil mendaftar akun
                    $('#registration-form-container').show();
                    // Tampilkan pesan sukses atau lakukan tindakan lain yang sesuai
                    Swal.fire({
                        icon: 'success',
                        title: 'Registration Successful!',
                        text: 'You have successfully registered your account.',
                        showConfirmButton: false,
                        timer: 2000 // Menampilkan pesan selama 2 detik
                    });
                    // Mengambil ID pengguna dari respons server
                    console.log(response);
                    var userId = response.id;
                    // Menetapkan nilai ID pengguna ke input tersembunyi
                    $('input[name="user_id"]').val(userId);
                    // $('#register-form-container').show();
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    // Menampilkan pesan kesalahan kepada pengguna
                    var errors = xhr.responseJSON
                        .errors; // Mendapatkan semua pesan kesalahan dari respons JSON

                    // Menampilkan pesan kesalahan untuk setiap field inputan
                    if (errors) {
                        if (errors.email) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Email Error',
                                text: errors.email[
                                    0], // Menampilkan pesan kesalahan untuk email
                                showConfirmButton: false,
                                timer: 2000 // Menampilkan pesan selama 2 detik
                            });
                        }
                        if (errors.password) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Password Error',
                                text: errors.password[
                                    0], // Menampilkan pesan kesalahan untuk password
                                showConfirmButton: false,
                                timer: 2000 // Menampilkan pesan selama 2 detik
                            });
                        }
                        // Tambahan penanganan pesan kesalahan untuk field inputan lainnya
                    }
                }

            });

            // Jangan lakukan submit form secara default
            event.preventDefault();
        });

        // Saat dokumen dimuat
        $(document).ready(function() {
            // Periksa apakah ada data register akun dalam sesi
            var registerData = JSON.parse(sessionStorage.getItem('registerData'));
            if (registerData) {
                // Sembunyikan formulir register akun dan tampilkan formulir pendaftaran
                $('#register-form-container').hide();
                $('#registration-form-container').show();

                // Tampilkan data register akun di form pendaftaran (jika perlu)
                // contoh: $('#nama').val(registerData.nama);
                // sessionStorage.removeItem('registerData');

            }
            // Jika masih ada sesi 'registerData' tetapi validasi gagal, jangan hapus sesi
            else if (registerData === null) {
                // Hapus data register akun dari sesi (opsional)
            }
        });
    </script>
</body>

</html>
