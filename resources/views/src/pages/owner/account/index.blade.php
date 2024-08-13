@extends('src.layouts.owner.layout')
@section('title', 'User Account')
@section('css')
    {{-- <link rel="stylesheet" href="//cdn.datatables.net/2.0.1/css/dataTables.dataTables.min.css" /> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />

@endsection
@section('content')
    <div class="container-fluid py-4 ">
        <div class="row">
            <div class="col-12 ">
                <div class="card mb-4 ">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <h6>User Account</h6>
                            <button type="button" class="btn btn-primary btn-sm ms-auto" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                Tambah User
                            </button>
                        </div>
                    </div>
                    <div class="card-body px-4 pt-0 pb-2">
                        <div class="table-responsive-sm p-0">
                            <table id="myTable" class="table table-borderless display align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-xs font-weight-bolder">
                                            Name</th>
                                        <th class="text-uppercase text-xs font-weight-bolder">
                                            Email</th>
                                        <th class="text-uppercase text-xs font-weight-bolder">
                                            Role</th>
                                        <th class="text-uppercase text-xs font-weight-bolder">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="text-sm">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer pt-3  ">
            @include('src.component.owner.footer.footer')
        </footer>
    </div>

    <!-- Modal Create Data-->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('/owner/account/create') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Nama</label>
                                    <input name="name" class="form-control" type="text">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Email
                                        address</label>
                                    <input name="email" class="form-control" type="email">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Password</label>
                                    <input name="password" class="form-control" type="password">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Role</label>
                                    <select class="form-control form-select" name="role"
                                        aria-label=".form-select-sm example" id="">
                                        <option selected>Pilih Role</option>
                                        <option value="owner">Owner</option>
                                        <option value="karyawan">Karyawan</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- End Modal Create Data-->

    <div id="modals-container"></div>


@endsection
@push('script')
    <!-- Tautkan file JavaScript jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            loadData();
        });

        function loadData() {
            $('#myTable').DataTable({
                processing: true,
                pagination: true,
                responsive: true,
                serverSide: true,
                searching: true,
                ordering: false,
                ajax: {
                    url: "{{ url('/owner/account') }}",
                },
                columns: [{
                        data: "name",
                        name: "name"
                    },
                    {
                        data: "email",
                        name: "email"
                    },
                    {
                        data: "role",
                        name: "role"
                    },
                    {
                        data: "action",
                        name: "action"
                    },
                ],
                drawCallback: function(settings) {
                    var api = this.api();
                    $('#modals-container').empty();
                    api.rows().every(function(rowIdx, tableLoop, rowLoop) {
                        var data = this.data();
                        var userName = $('<div>').html(data.user_id).text()
                            .trim(); // Decode HTML entities and trim spaces
                        $('#modals-container').append(`
                            <!-- Delete Modal -->
                            <div class="modal fade" id="delete${data.id}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Delete User ${userName}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ url('/owner/account/destroy/') }}/${data.id}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <p>Apakah anda yakin ingin menghapus data ini?</p>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Delete</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Update Modal -->
                            <div class="modal fade" id="update${data.id}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Update Password</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ url('/owner/account/update/') }}/${data.id}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="example-text-input" class="form-control-label">Nama</label>
                                                            <input name="name" class="form-control" type="text" value="${data.name}">
                                                            @error('name')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="example-text-input" class="form-control-label">Jumlah pembayaran</label>
                                                            <input name="email" class="form-control" type="email" value="${data.email}">
                                                            @error('email')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="role${data.id}" class="form-control-label">Status</label>
                                                            <select name="role" class="form-control form-select" id="role${data.id}">
                                                                <option value="owner" ${data.role === 'owner' ? 'selected' : ''}>Owner</option>
                                                                <option value="karyawan" ${data.role === 'karyawan' ? 'selected' : ''}>Karyawan</option>
                                                            </select>
                                                            @error('role')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Update Password Modal -->
                            <div class="modal fade" id="updatepassword${data.id}" tabindex="-1" aria-labelledby="updatePasswordLabel${data.id}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="updatePasswordLabel${data.id}">Update Password</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ url('/owner/account/changepassword') }}/${data.id}" method="POST">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label for="password${data.id}" class="form-control-label">Password</label>
                                                        <input type="password" name="password" class="form-control" id="password${data.id}">
                                                        @error('password')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="password_confirmation${data.id}" class="form-control-label">Password Confirmation</label>
                                                        <input type="password" name="password_confirmation" class="form-control" id="password_confirmation${data.id}">
                                                        @error('password_confirmation')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        <button type="submit" class="btn btn-primary btn-sm ms-auto">Submit</button>
                                                    </div>
                                                </div>
                                                <hr class="horizontal dark">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `);
                    });
                }
            });
        }
    </script>
@endpush
