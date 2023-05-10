@push('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script charset="utf8" src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#measuresTable').DataTable({
                'serverSide': true,
                'ajax': "{{route('admin.datatable.measures')}}",
                'columns': [
                    {data: 'customer_id'},
                    {data: 'language'},
                    {data: 'name'},
                    {data: 'email'},
                    {data: 'updated_at_formatted'},
                    {data: 'btn'},
                ],
                'fixedColumns': true,
                'autoWidth': false,
                'ordering': true
            });
        });

        function callDeleteAlert(id) {
            let url = "{{ route('admin.measures.destroy', ":id") }}";
            url = url.replace(':id', id);
            Swal.fire({
                title: "Are you sure?",
                text: "This action is irreversible.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "Yes delete!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id": id,
                        },
                        type: "DELETE",
                        dataType: "json",
                        url: url,
                    })
                        .done(function (data, textStatus, jqXHR) {
                            if (data.success) {
                                $('#measuresTable').DataTable().ajax.reload(null, false);
                                Swal.fire(
                                    "Deleted!",
                                    data.message,
                                    'success'
                                )
                            } else {
                                console.log(data)
                            }
                        })
                        .fail(function (jqXHR, textStatus, errorThrown) {
                            if (console && console.log) {
                                console.log("Error " + textStatus);
                            }
                        });
                }
            })
        }
    </script>
@endpush
