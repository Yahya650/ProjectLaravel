<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>{{ $name }}</title>
</head>

<body>
    <style>
        body {
            width: 100%;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            text-align: center;
        }

        .profile {
            padding: 20px;
            border-radius: 10px;
            /* width: 30%; */
            margin: 0 auto;
            margin-top: 20px;
        }

        .profile #img {
            width: 200px;
            padding: 10px;
            border: 1px solid black;
            border-radius: 50%;
        }

        .profile h1 {
            font-size: 24px;
            margin: 10px 0;
        }

        .profile p {
            font-size: 16px;
            margin: 5px 0;
        }

        table {
            border: 1px solid black;
        }

        table tr {
            border: 1px solid black;

        }

        table thead tr th {
            border: 1px solid black;

        }

        table tbody tr td {
            border: 1px solid black;

        }
    </style>
    <div class="profile">
        <img src="./{{ Storage::url($imageProfile) }}" id="img" alt="User Profile Image">
        <h1 class="h1"><strong><ins>{{ $name }}</ins></strong></h1>
        <p><i>Sexe : </i> {{ $sexe }}</p>
        <p><i>Email : </i> {{ $email }}</p>
        <br>
        @if ($computers->count() > 0)
            <table class="table text-center">
                <thead>
                    <tr class="text-center">
                        <th colspan='5' class="py-3">
                            My Computers
                        </th>
                    </tr>
                    <tr class="table-secondary p-4">
                        <th style="padding: 10px;" scope="col">Image</th>
                        <th style="padding: 10px auto;" scope="col">Name</th>
                        <th style="padding: 10px auto;" scope="col">Origin</th>
                        <th style="padding: 10px auto;" class="px-3" scope="col">Price</th>
                        <th style="padding: 10px auto;" scope="col">Created AT</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total = 0;
                    @endphp


                    @foreach ($computers as $computer)
                        <tr>
                            <td><img src="./{{ Storage::url($computer->imageComputer) }}" class="m-2 border"
                                    width="100px" alt=""></td>
                            <td>{{ $computer->nameComputer }}</td>
                            <td>{{ $computer->originComputer }}</td>
                            <td>{{ $computer->priceComputer }}$</td>
                            <td>{{ $computer->created_at }}</td>
                        </tr>
                        @php
                            $total += $computer->priceComputer;
                        @endphp
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="table-success">
                        <th colspan='3'>Price Total</th>
                        <th colspan='2' class="text text-center">{{ $total }} $</th>
                    </tr>
                </tfoot>
            </table>
        @else
        <p class="my-3">You don't have computers</p>
        @endif
    </div>
</body>

</html>
