<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel 7 PDF Example</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center mb-3">Analysis Users Report</h2>
        <table class="table table-bordered mb-5">
            <thead>
                <tr class="table-danger">
                    <th scope="col">'#  '</th>
                    <th scope="col">Name   </th>
                    <th scope="col">Tweet Nunmber</th>
                    <th scope="col">Tweet avg</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users?? '' as $user)
                <tr>
                    <th scope="row">{{ $user->id }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->tweets_count }}</td>
                    <td>{{ $user->avg }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>


</body>

</html>
