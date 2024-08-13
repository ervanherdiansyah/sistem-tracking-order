@extends('src.layouts.owner.layout')
@section('title', 'Status Order')
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
                            <h6>Status Order</h6>
                            <button type="button" class="btn btn-primary btn-sm ms-auto" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                Tambah Status Order
                            </button>
                        </div>
                    </div>
                    <div class="card-body px-4 pt-0 pb-2">
                        <div class="table-responsive-sm p-0">
                            <table id="myTable" class="table table-borderless display align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xs font-weight-bolder">
                                            Status Order</th>
                                        <th class="text-uppercase text-secondary text-xs font-weight-bolder">Aksi
                                        </th>
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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Status Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('/owner/tracking/create') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Status Order</label>
                                    <input name="nama_tracking" class="form-control" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
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
                    url: "{{ url('/owner/tracking') }}",
                },
                columns: [{
                        data: "nama_tracking",
                        name: "nama_tracking"
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
                                            <h5 class="modal-title" id="exampleModalLabel">Delete Data</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ url('/owner/tracking/destroy/') }}/${data.id}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <p>Apakah anda yakin ingin menghapus status order ${data.nama_tracking}?</p>
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
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Update Status Order</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ url('/owner/tracking/update/') }}/${data.id}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="example-text-input" class="form-control-label">Status Order</label>
                                                            <input name="nama_tracking" class="form-control" type="text" value="${data.nama_tracking}">
                                                            @error('nama_tracking')
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
                        `);
                    });
                }
            });
        }
    </script>
@endpush
