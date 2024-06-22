<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Graduation Projects Management System</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            box-shadow: 0px 3px 6px #00000029;
            border-radius: 10px;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            text-align: center;
            margin-bottom: 20px;
        }

        .header-center {
            text-align: center;
            margin-top: 30px;
        }

        h1 {
            color: #003366;
            font-size: 24px;
            margin: 5px 0;
        }

        h2 {
            color: #003366;
            font-size: 20px;
            margin: 5px 0;
        }

        h4 {
            margin-top: 40px;
            color: #003366;
            font-size: 20px;
        }

        table {
            border-collapse: collapse;
            margin: 20px 0;
        }

        table tr th {
            background-color: #7366ff;
            color: white;
        }

        table,
        th,
        td {
            border: 1px solid #0000004a;
        }

        th,
        td {
            padding: 8px;
            text-align: center;
            font-size: 13px;
        }
    </style>
</head>

<body>
    <div class="container">
        <header>
            <div class="header-center">
                <h1>Graduation Projects Management System</h1>
                <h2>(Graduation platform)</h2>
            </div>
        </header>
        <section>
            @if (auth()->user()->role == \App\Models\User::ROLE_ADMIN)
                <h4>All Teams In System:</h4>
            @else
                <h4>My Teams:</h4>
            @endif
            <table>
                <thead>
                    <tr>
                        <th>.NO</th>
                        <th>Team Number</th>
                        <th>Leader</th>
                        <th>Project Title</th>
                        <th>project Description</th>
                        @if (auth()->user()->role == \App\Models\User::ROLE_ADMIN)
                            <th>Supervisor</th>
                        @endif
                        <th>status</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($teams))
                        @foreach ($teams as $key => $team)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $team->team_number }}</td>
                                <td>{{ $team->leader->full_name }}</td>
                                <td>{{ $team->project_title }}</td>
                                <td>{{ $team->project_description }}</td>
                                @if (auth()->user()->role == \App\Models\User::ROLE_ADMIN)
                                    <td>{{ $team->supervisor->full_name ?? "--" }}</td>
                                @endif
                                <td>{{ $team->status }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td>No Users Found</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </section>
    </div>
</body>

</html>
