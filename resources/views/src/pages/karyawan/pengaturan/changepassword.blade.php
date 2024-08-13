@extends('src.layouts.karyawan.layout')
@section('title', 'Change Password')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="mb-4">
                    {{-- <div class="card-header pb-0">
                        <h6>User Account</h6>
                    </div> --}}
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="container-fluid py-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header pb-0">
                                            <div class="d-flex align-items-center">
                                                <p class="mb-0">Change Password</p>
                                                {{-- <button class="btn btn-primary btn-sm ms-auto">Settings</button> --}}
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            {{-- <p class="text-uppercase text-sm">User Information</p> --}}
                                            <form action="{{ Route('changepassword-karyawan') }}" method="POST">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="current_password" class="form-control-label">Current
                                                                Password</label>
                                                            <input type="password" name="current_password"
                                                                class="form-control" id="current_password">
                                                            @error('current_password')
                                                                <div class="alert alert-danger mt-2 text-white">
                                                                    {{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="password" class="form-control-label">
                                                                Password</label>
                                                            <input type="password" name="password" class="form-control"
                                                                id="password">
                                                            @error('password')
                                                                <div class="alert alert-danger mt-2 text-white">
                                                                    {{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="password_confirmation" class="form-control-label">
                                                                Password Confirmation</label>
                                                            <input type="password" name="password_confirmation"
                                                                class="form-control" id="password_confirmation">
                                                            @error('password_confirmation')
                                                                <div class="alert alert-danger mt-2 text-white">
                                                                    {{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        {{-- <p class="mb-0">Edit Profile</p> --}}
                                                        <button type="submit"
                                                            class="btn btn-primary btn-sm">Submit</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer pt-3  ">
            @include('src.component.karyawan.footer.footer')
        </footer>
    </div>
@endsection
