@extends('layouts.app')

@section('content')
<div class="users-datatable-block">
    <h2>Все пользователи</h2>
    <table id="all-users-datatable" class="uk-table uk-table-middle uk-table-responsive uk-table-small">
        <thead>
        <tr >
            <th>ID</th>
            <th class="datatable-th uk-table-small">Фамилия</th>
            <th class="datatable-th uk-table-small">Имя</th>
            <th class="datatable-th uk-table-small">Позиция</th>
            <th class="datatable-th uk-table-small">Отдел</th>
            <th class="datatable-th">Обновлено</th>
            <th class="datatable-th">Level</th>
            <th class="">Действия</th>
        </tr>
        </thead>
    </table>

</div>

@endsection