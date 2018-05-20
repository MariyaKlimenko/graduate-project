import UIkit from './../../uikit.min.js';

export default {
    bindEvents () {
        const body = $('body');

        const prev = $.parseHTML('<i class="icon ion-chevron-left pagination-arrows"></i>');
        const next = $.parseHTML('<i class="icon ion-chevron-right pagination-arrows"></i>');
        let authLevel;
        let moderatorLevel;
        let administratorLevel;

        let dt = $('#all-users-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '/users/getDataTableData',
                dataSrc: function (json) {
                    authLevel = json.authLevel;
                    moderatorLevel = json.moderatorLevel;
                    administratorLevel = json.administratorLevel;
                    return json.data;
                }
            },
            columns: [
                {data: 'id', name: 'id', visible: false, searchable: false},
                {data: 'surname', name: 'surname'},
                {data: 'name', name: 'name'},
                {data: 'position', name: 'position'},
                {data: 'department', name: 'department'},
                {data: 'updated_at', name: 'updated_at'},
                {data: 'level', name: 'level', visible: false, searchable: false},
                {data: 'role_name', name: 'role_name'},
                {data: 'id', name: 'id', render(data, type, row, meta) {
                         let html = '<i class="icon ion-clipboard table-icon-button table-show-button" data-id="' + data + '"></i>' +
                             '<i class="icon ion-archive table-icon-button table-save-button" data-id="' + data + '"></i>';
                         if(authLevel >= row.level && authLevel >= moderatorLevel) {
                             html += '<i class="icon ion-compose table-icon-button table-edit-button" data-id="' + data + '"></i>' +
                                 '<i class="icon ion-trash-b table-icon-button table-delete-button" data-id="' + data + '"' +
                                 ' data-surname="' + row.surname + '" data-name="' + row.name + '"></i>';
                         }
                        return html;
                    }}
            ],
            language: {
                search:         'Поиск: ',
                lengthMenu:     'Показать _MENU_ ',
                processing:     'Обработка...',
                emptyTable:     'Нет данных',
                info:           'Показано с _START_ по _END_ из _TOTAL_ записей',
                infoEmpty:      'Показано с 0 по 0 из 0 записей',
                infoFiltered:   '(выбрано из _MAX_ записей)',
                infoPostFix:    '',
                thousands:      ',',
                loadingRecords: 'Загрузка...',
                zeroRecords:    'Поданному запросу ничего не найдено',
                paginate: {
                    first:      'Первая',
                    last:       'Последняя',
                    next:       next,
                    previous:   prev
                },
            },
            initComplete() {
                this.api().columns([7]).visible(authLevel == administratorLevel);
            }
        });

        $('#all-users-datatable_length :input').addClass('uk-select all-users-datatable-select');

        $('#all-users-datatable_filter input').addClass('uk-input all-users-datatable-input');

        $('#all-users-datatable_previous a').addClass('datatable-pagination');

        $('#all-users-datatable_paginate').addClass('all-users-datatable-block');

        body.on('click', '.table-show-button', function () {
            window.location ="/users/show/" + $(this).data('id');
        });

        body.on('click', '.table-save-button', function () {
            window.location ="/users/pdf/" + $(this).data('id');
        });

        body.on('click', '.table-edit-button', function () {
            window.location ="/user/update/" + $(this).data('id');
        });

        body.on('click', '.table-delete-button', function (e) {
            const surname = $(this).data('surname');
            const name = $(this).data('name');
            const id = $(this).data('id');
            e.preventDefault();
            e.target.blur();

            UIkit.modal.confirm('Удалить пользователя ' + surname + ' ' + name + '?',
                {labels: {'ok': 'Да', 'cancel': 'Отмена'},
                stack: true}).then(function () {
                    $.ajax({
                        url: "/users/delete/" + id,
                        type: "get",
                        success: function(data) {
                            dt.ajax.reload();
                            UIkit.notification({message: 'Пользователь ' + surname + ' ' + name + ' удален.',
                                status: 'success', pos: 'top-right'});
                        },
                        error: function (data) {
                            UIkit.modal.alert('Не удалось удалить пользователя ' + surname + ' ' + name + '.').then(function () {
                            });
                        }
                    });
            }, function () {
            });
        });

    },

    init () {
        this.bindEvents();
    }
}