@extends('layouts.app')

@section('content')
    <div class="main-heading">
        <h2>Все пользователи</h2>
    </div>
    <div class="main-body">
        <div class="users-datatable-block">
            <table id="all-users-datatable" class="uk-table uk-table-middle uk-table-responsive uk-table-small">
                <thead>
                <tr >
                    <th>ID</th>
                    <th class="datatable-th">Фамилия</th>
                    <th class="datatable-th">Имя</th>
                    <th class="datatable-th">Позиция</th>
                    <th class="datatable-th">Отдел</th>
                    <th class="datatable-th">Обновлено</th>
                    <th class="datatable-th">Level</th>
                    <th class="datatable-th">Роль</th>
                    <th class="datatable-options-column">Действия</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>

@endsection