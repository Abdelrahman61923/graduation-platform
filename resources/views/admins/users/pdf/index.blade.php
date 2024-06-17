<!DOCTYPE html>
<html>

<head>
    <style>
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            text-align: center;
            margin: auto;
        }

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #7366ff;
            color: white;
        }
    </style>
</head>

<body>
    <h1 style="text-align: center">All Students</h1>
    <table id="customers">
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
                        <td>{{ $user->member? 'Yes' : 'No' }}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td>No Users Found</td>
                </tr>
            @endif
        </tbody>
    </table>

</body>

</html>
