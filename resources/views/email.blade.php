<html>
<head>
    <title>

    </title>
</head>
<body>
    <h5>Dear {{$details[0]->user_name}}</h5>
    <table>
        <tr>
            <th> Book Name</th>
            <th> Book Type</th>
            <th> User Type</th>
            <th> Borrow Date</th>
            <th> Overdue Days</th>
            <th> Payment</th>
        </tr>

            @foreach($details as $dataDetails)
            <tr>
            <td>{{$dataDetails->book_name}}</td>
            <td>{{$dataDetails->book_type}}</td>
            <td>{{$dataDetails->u_type}}</td>
            <td>{{$dataDetails->borrow_date}}</td>
            <td>{{$dataDetails->days}}</td>
            <td>{{$dataDetails->payment}}</td>
            </tr>
            @endforeach



    </table>
</body>
</html>
