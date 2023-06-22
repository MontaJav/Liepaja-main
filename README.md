<h2>Vispārīgi par darbu</h2>

<p>Uzdevuma izpildei nolemts izmantot <a href="https://laravel.com/">Laravel</a> satvaru, 
jo tas ļauj</p>
<ul>
    <li>ātri uzbūvēt datubāzes tabulas un to relācijas ar <a href="https://laravel.com/docs/10.x/migrations#main-content">migrāciju</a> palīdzību,</li>
    <li>ātri izveidot <a href="https://laravel.com/docs/10.x/starter-kits#breeze-and-blade">reģistrācijas un autorizācijas</a> formas </li>
    <li>papildināt jau gatavus skatus ar nepieciešamu informāciju, netērējot laiku uz priekšgala dizaina izstrādi.</li>
</ul>

<p>Projekta palaišanai ir nepieciešams</p>
<ul>
    <li>PHP 8</li>
    <li>NPM/Node 18</li>
    <li>tukša datubāze, un tās pieejām jābūt ieliktām <code>.env</code> faila attiecīgos <code>DB_</code> laukos</li>
    <li>Google maps projekts ar API atslēgu un map id, un šiem datiem jābūt ieliktiem <code>.env</code> faila attiecīgos <code>GOOGLE_MAP_</code> laukos</li>
    <li>palaist komandu <code>composer install</code>, lai uzinstalētu projekta failus</li>
    <li>palaist komandu <code>php artisan migrate</code>, lai izveidotu datubāzes tabulas</li>
    <li>palaist komandu <code>php artisan db:seed</code>, lai izveidotu admin lietotāju</li>
    <li>palaist komandu <code>npm install</code></li>
    <li>palaist komandu <code>npm run dev</code></li>
    <li>palaist komandu <code>php artisan serve</code> un atvērt izveidoto saiti</li>
</ul>

<h2>Izstrāde</h2>
<h3>Datubāze</h3>
<ul>
<li><code>users</code> tabulas migrācija pēc noklusējuma jau eksistē, 
pielikām pie tās <code>bool</code> kolonnu <code>is_admin</code> 
ar noklusējuma nozīmi <code>false</code>.</li>
<li>izveidojām migrāciju fotogrāfiju datiem ar komandu 
<code>php artisan make:migration CreatePhotosTable</code>. 
Tabula satur sekojošus laukus:<ul>
<li>Ieraksta identifikators</li>
<li>Nosaukums</li>
<li>Attēla adrese lokālajā glabātuvē</li>
<li>Apraksts (var būt tukšs)</li>
<li>Attēla uzņemšanas gads</li>
<li>Platums grādos (glabāsim to kā tekstu, lai nebūtu problēmas ar zīmēm pēc komata un liekām nullēm)</li>
<li>Garums grādos (arī teksta veidā)</li>
</ul></li>
</ul>
<p>Tabulas tiek izveidotas ar <code>php artisan migrate</code> komandu.</p>
<p>Pēc tabulu izveides, palaižot <code>php artisan db:seed</code> komandu,
izveidojam admin lietotāju, kura dati ir definēti <code>DatabaseSeeder</code> klasē.
Pēc komandas izpildes varēsim autorizēties sistēmā ar epastu <code>admin@lu.lv</code> 
un paroli <code>admin</code>.</p>

<h3>Back-end</h3>
<p>Pirmkārt, izveidojām modeļa klasi <code>Photo</code>, kas attēlo attiecīgu datubāzes tabulu.</p>
<p>Pēc modeļa izveides izveidojām jaunu <code>AdminMiddleware</code> klasi, kas ļaus pārbaudīt pieejas katram pieprasījumam.
Šo middleware izmantosim <code>is_admin</code> lauka pārbaudei, 
lai admina sadaļas būtu pieejamas tikai lietotājam ar <code>is_admin = true</code>.
Klasi reģistrējam <code>Kernel.php</code> failā klāt pie pārējiem middleware.
Loģiku gandrīz kopējam no <code>EnsureEmailIsVerified</code> klases, 
tikai epasta pārbaudi aizvietojam ar <code>is_admin</code> lauka pārbaudi.</p>
<p>Tālāk, izveidojam <code>AdminController</code> klasi, kura saturēs datu rediģēšanas loģiku:</p>
<ul>
<li><code>list</code> metodi attēlu datu izvadei sarakstā</li>
<li><code>create</code> metodi jauna attēla ieraksta saglabāšanai</li>
<li><code>update</code> esošā attēla izmaiņu saglabāšanai</li>
<li><code>delete</code> ieraksta dzešanai</li>
</ul>
<p><code>web.php</code> failā, kas satur aplikācijas saites, veicām sekojošas izmaiņas:</p>
<ul>
<li><code>/dashboard/{search?}</code> saiti pavirzam uz <code>AdminController</code> klases <code>list</code> metodi, kas atgriezīs datus, meklējot ar <a href="https://laravel.com/docs/10.x/queries">Query builder</a> palīdzību</li>
<li>pievienojām <code>/form/{id?}</code> GET pieprasījumu, kas uzreiz atgriezīs ieraksta formu, atradpot attiecīgo modeli un aizpildot formu ar modeļa datiem, ja tika padots korekts <code>id</code></li>
<li>pievienojām <code>/save</code> POST pieprasījumu, izsauks <code>AdminController</code> klases <code>save</code> metodi un saglabās izmaiņas</li>
<li>sākumlapu <code>/</code> pavirzām uz <code>Controller</code> klasi, kas pados frontendam maksimālo un minimālo pieejamo gadu</li>
<li>pievienojām <code>/photos/{from}/{to}</code> saiti, kas izsauks <code>Controller</code> klasi un dabūs datus attiecīgajā laika periodā</li>
</ul>
<p>Kā arī, <code>filesystems.php</code> failā definējām mapi, kurā saglabāsies augšuplādētas bildes: <code>public_path('images')</code> iekš <code>local</code> diska, t.i. paša projekta <code>public</code> mapē.</p>

<h2>Front-end</h2>
<p>Izmantojām Laravel iebūvēto satvaru Blade, kas ļauj apvienot PHP un HTML.</p>
<p>Admin bildes pievienošanas formai pielikts:</p>
<ul>
<li><code>@csrf</code>, kas izveido paslēptu lauku ar tokenu, kas nodrošina drošu datu pārsūtīšanu</li>
<li><code>enctype="multipart/form-data"</code> atribūtu, kas ļauj pārsūtīt failus</li>
<li><code>method="post"</code> atribūtu, lai dati droši sūtītos ar POST pieprasījumu</li>
<li>CSS fails <code>form.css</code>, kas atrodas <code>public</code> mapē</li>
<li>JS fails <code>form.js</code>, kas atrodas <code>public</code> mapē</li>
<li>Google Maps HTML un JS kods, kas tika paņemts no <a href="https://developers.google.com/maps/documentation/javascript/advanced-markers/accessible-markers#make_a_marker_draggable">oficiālās dokumentācijas</a></li>
<li>Google personīga <a href="https://developers.google.com/maps/documentation/javascript/get-api-key#restrict_key">API atslēga</a>, kas atļauj izmantot Google Maps, kā arī kartes id</li>
<li>Gadu izvelne ir izpildīta ar jQuery, <a href="https://jqueryui.com/slider/#range">izmantojot paraugu</a></li>
</ul>

<p>Meklēšanas laukiem katalogā un sākumlapā izmantojām Javascript <a href="https://www.w3schools.com/js/js_ajax_http_send.asp">AJAX</a> pieprasījumus</p>
