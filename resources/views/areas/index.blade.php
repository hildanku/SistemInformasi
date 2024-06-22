
<!DOCTYPE html>
<html>
<head>
    <title>Areas</title>
</head>
<body>
    <h1>Areas</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Area Name</th>
                <th>Area Facilities</th>
                <th>Created At</th>
                <th>Updated At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($areas as $area)
                <tr>
                    <td>{{ $area->id }}</td>
                    <td>{{ $area->areaName }}</td>
                    <td>{{ $area->areaFacilities }}</td>
                    <td>{{ $area->created_at }}</td>
                    <td>{{ $area->updated_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
