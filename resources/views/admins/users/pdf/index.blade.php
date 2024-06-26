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
            <h4>All Students In System:</h4>
            <table>
                <thead>
                    <tr>
                        <th>.NO</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Department</th>
                        <th>Phone</th>
                        <th>University ID</th>
                        <th>In Group</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($users))
                        @foreach ($users as $key => $user)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $user->full_name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->department?->name }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->student_id }}</td>
                                <td>{{ $user->member ? 'Yes' : 'No' }}</td>
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
