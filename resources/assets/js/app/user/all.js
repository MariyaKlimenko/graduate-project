
export default {
    bindEvents () {
        const body = $('body');

        $('#all-users-datatable').DataTable({
            columnDefs: [
                {
                    "targets": [ 0 ],
                    "visible": false,
                    "searchable": false
                }
            ],
            processing: true,
            serverSide: true,
            ajax: '/users/getDataTableData',
            columns: [
                {data: 'id', name: 'users.id'},
                {data: 'surname', name: 'users.surname'},
                {data: 'name', name: 'users.name'},
                {data: 'info.department', name: 'info.department'},
                {data: 'info.position', name: 'info.position'},
                {data: 'info.updated_at', name: 'info.updated_at'},
            ]
        });
    },

    init () {
        this.bindEvents();
    }
}