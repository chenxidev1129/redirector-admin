<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    @vite(['resources/js/app.js'])
</head>

<body class="antialiased">
    <div class="table-responsive">
        <table class="table table-primary">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Name</th>
                    <th scope="col">Registration Date</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($userList as $index => $user)
                    <tr class="">
                        <td scope="row">{{ $index + 1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked1" onchange="setEnabled({{$user->id}}, event)" @checked($user->enabled)>
                                <label class="form-check-label" for="flexSwitchCheckChecked1">Checked switch checkbox
                                    input</label>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <button type="button" class="btn btn-primary" id="button">Button</button>
    </div>

    <script>
        document.getElementById("button").onclick = () => {
            $.ajax({
                type: "GET",
                url: "create-user",
                data: {
                    name: 'kkk'
                }
            })
            .done(function(response) {
                // alert("Data: " + response.user.created_at);
            });
        }

        function setEnabled(id, event) {
            $.ajax({
                type: "POST",
                url: "set-enabled",
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: id,
                    enabled: event.currentTarget.checked
                }
            })
            .done(function(response) {
                // alert("Data: " + response.user.created_at);
            });
        }
    </script>
</body>

</html>
