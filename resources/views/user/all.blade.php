@extends('layouts.app')

@section('content')
    <h2>Все пользователи</h2>

    <table id="all-users-datatable" class="uk-table uk-table-divider uk-table-responsive uk-table-small">
        <thead>
        <tr >
            <th>ID</th>
            <th class="uk-table-shrink">Фамилия</th>
            <th class="uk-table-expand">Имя</th>
            <th class="uk-table-shrink">Отдел</th>
            <th class="uk-table-shrink">Позиция</th>
            <th class="uk-table-expand">Обновлено</th>
            <th class="uk-table-shrink">Действия</th>

        </tr>
        </thead>
    </table>

@endsection