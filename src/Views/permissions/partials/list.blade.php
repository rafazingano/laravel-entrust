<table class="table table-striped table-hover table-sm" id="permissions-table">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Nome do Display</th>
            <th>Description</th>
            <th>Criado</th>
            <th>Atualizado</th>
            <th>#</th>
        </tr>
    </thead>
</table>

@push('scripts')
    <script>
        $.noConflict();
        jQuery(document).ready(function($) {
            $('#permissions-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route("admin.permissions.datatables") }}',
                columns: [{
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'display_name',
                        name: 'display_name'
                    },
                    {
                        data: 'description',
                        name: 'description'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });
    </script>
@endpush
