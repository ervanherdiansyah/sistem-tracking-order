@extends('src.layouts.karyawan.layout')
@section('title', 'Profile')
@section('content')
    <div class="card shadow-lg mx-4 card-profile-bottom">
        <div class="card-body p-3">
            <div class="row gx-4">
                <div class="col-auto">
                    <div class="avatar avatar-xl position-relative">
                        @if (isset($profile) && $profile->foto != null)
                            <img src="{{ asset('storage/' . $profile->foto) }}"
                                style="display:block; margin:auto; max-width: 100%" alt="profile_image"
                                class="w-100 border-radius-lg shadow-sm">
                        @else
                            <img src="{{ asset('argon') }}/assets/img/team-1.jpg" alt="profile_image"
                                class="w-100 border-radius-lg shadow-sm">
                        @endif
                    </div>
                </div>
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                            @if (isset($profile) && $profile->fullname != null)
                                {{ $profile->fullname }}
                            @else
                                Tasqira User
                            @endif
                        </h5>
                        <p class="mb-0 font-weight-bold text-sm">
                            @if (isset($profile) && $profile->nohp != null)
                                {{ $profile->nohp }}
                            @else
                                Tasqira User
                            @endif
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                    <div class="nav-wrapper position-relative end-0">
                        <ul class="nav nav-pills nav-fill p-1" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1 active d-flex align-items-center justify-content-center "
                                    href="{{ url('/karyawan/profile') }}" role="tab" aria-selected="true">
                                    <i class="fa fa-user"></i>
                                    <span class="ms-2">Profile</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center "
                                    href="{{ url('/karyawan/home') }}" role="tab" aria-selected="false">
                                    <i class="ni ni-tv-2"></i>
                                    <span class="ms-2">Home</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center "
                                    href="{{ url('/karyawan/changepassword') }}" role="tab" aria-selected="false">
                                    <i class="ni ni-settings-gear-65"></i>
                                    <span class="ms-2">Password</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0">Edit Profile</p>
                            @if ($profile != null)
                                <button type="button" class="btn btn-primary btn-sm ms-auto" data-bs-toggle="modal"
                                    data-bs-target="#update">
                                    Edit Profile
                                </button>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('/karyawan/profile/create') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Nama</label>
                                        <input name="fullname" class="form-control" type="text"
                                            value="{{ $profile->fullname ?? '' }} "
                                            @if (isset($profile) && $profile->fullname) readonly @endif>
                                        @error('fullname')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Nomor Whatsapp</label>
                                        <input name="nohp" class="form-control" type="number"
                                            value="{{ $profile->nohp ?? '' }}"
                                            @if (isset($profile) && $profile->nohp) readonly @endif>
                                        @error('nohp')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Email</label>
                                        <input name="email" class="form-control" type="email"
                                            value="{{ $profile->email ?? '' }}"
                                            @if (isset($profile) && $profile->email) readonly @endif>
                                        @error('email')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        @isset($profile->foto)
                                            <label for="example-text-input" class="form-control-label">Foto Profile</label>
                                            <img src="{{ asset('storage/' . $profile->foto) }}"
                                                style="display:block; margin:auto; max-width: 100%; border-radius: 50%;"
                                                width="200px">
                                        @endisset
                                        @empty($profile->foto)
                                            <label for="example-text-input" class="form-control-label">Foto Profile</label>
                                            <input name="foto" class="form-control" type="file">
                                        @endempty
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                {{-- <p class="mb-0">Edit Profile</p> --}}
                                @if ($profile == null)
                                    <button type="submit" class="btn btn-primary btn-sm ms-auto">
                                        Submit
                                    </button>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        <footer class="footer pt-3  ">
            @include('src.component.karyawan.footer.footer')
        </footer>

        @if (isset($profile))
            <div class="modal fade" id="update" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Update Profile</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ url('/karyawan/profile/update/' . $profile->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Nama</label>
                                            <input name="fullname" class="form-control" type="text"
                                                value="{{ $profile->fullname }} ">
                                            @error('neme')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Nomor
                                                Whatsapp</label>
                                            <input name="nohp" class="form-control" type="number"
                                                value="{{ $profile->nohp }}">
                                            @error('nohp')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Email
                                            </label>
                                            <input name="email" class="form-control" type="email"
                                                value="{{ $profile->email }}">
                                            @error('email')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Foto
                                                Profile</label>
                                            <input name="foto" class="form-control" type="file">
                                            @error('foto')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
