<h3> Before </h3>
<p> Make sure that docker and docker compose are installed on your machine. </p>

<h3> If you use Windows </h3>
<ul>
  <li> Install portable console emulator for Windows http://cmder.net/ and use it for executing commands </li>
  <li> Install GNUWin32 http://gnuwin32.sourceforge.net/packages/make.htm. </li>
  <li> Add GNUWin32 to your PATH env variable. </li>
</ul>

<h3> Environment setup </h3>

<ol>
  <li> Create your local configuration file <code> cp ./env.local ./env </code> </li>
  <li> Start docker containers <code> make start </code> </li>
  <li> Install composer dependencies <code> make composer-install </code> </li>
  <li> Install npm packapges <code> make npm-install </code> </li>
  <li> Migrate database with seeds <code> make migrate seed </code> </li>
  <li> Build front-end <code> make npm-dev </code> </li>
  <li> Open your app in browser http://localhost:8080 </li>
</ol>

<h3> Useful commands </h3>
<ul>
  <li> Database cleanup <code> make truncate </code> </li>
  <li> Stop/Restart docker containers <code> make stop </code> or <code> make restart </code> </li>
  <li> SSH connect <code> make ssh </code> </li>
  <li> To enable npm watche use <code> make npm-watch </code>
  <li> PHPUnit <code> make phpunit </code>
</ul>
