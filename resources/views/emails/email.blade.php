<h4>Здравствуйте,  {{ $user->name }}!</h4>

<p>Ваш аккаунт создан и доступен по <a href="http://localhost:8080/">ссылке</a>.</p>
<p>Ваш логин: {{ $user->email }}</p>
<p>Ваш временный пароль: {{ $password }}</p>
<h4>Вам необходимо сменить пароль после первой авторизации.</h4>

