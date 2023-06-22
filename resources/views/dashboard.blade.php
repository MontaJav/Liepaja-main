<x-app-layout>
    <script src="/dashboard.js"></script>

    <x-slot name="header">
        <div class="admin-header">
            <h1>Katalogs</h1>
            <h3>Administrācijas vide, kur iespējams pievienot, labot un dzēst bildes</h>
        </div>
        <a href="/form" id="add-new">+ Pievienot jaunu</a>
    </x-slot>

    <div>
        <div id="search-container">
            <input type="text" id="search" placeholder="Meklēt pēc nosaukuma" onchange="search()">
        </div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nosaukums</th>
                    <th>Gads</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="rows">
                {{--šis tiek aizpildīts ar js--}}
            </tbody>
        </table>
    </div>
</x-app-layout>
