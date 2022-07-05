<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css">
<div class="container">
    <div class="row">
        <div class="col-12">

            <table id="myTable">
                <thead>
                <tr>
                    <th>League Name</th>
                    <th>Location</th>
                    <th>Play Type</th>
                    <th>Gender</th>
                    <th>Ratings</th>
                    <th>Dates</th>
                    <th>Teams Registered</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                @foreach($leaguesData as $data)
                <tr>
                    <td class="text-center"><a href="{{$data->leagueid}}" class="text-primary"><b>{{$data->league_name}}</b></a></td>
                    <td class="text-center">{{$data->city}}</td>
                    <td class="text-center">{{$data->play_type}}</td>
                    <td class="text-center">{{$data->gender}}</td>
                    <td class="text-center">{{$data->rating}}</td>
                    <td class="text-center">{{$data->fromdate}} to {{$data->todate}}</td>
                    <td class="text-center">{{$data->max_team}}</td>
                    <td class="text-center">{{$data->status}}</td>
                </tr>
                @endforeach


                </tbody>
            </table>
        </div>
    </div>
</div>

</div>

<script>
    $(document).ready(function () {
        $(document).ready(function () {
            $('#myTable').dataTable();
        });

    });

</script>
