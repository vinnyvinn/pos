


    <div class="panel panel-default">

        // APPEND SEARCH BOX HERE

        <table class="table table-bordered table-hover" >
            <thead>
            <th>Name</th>
            </thead>
            <tbody>
            @foreach($offices as $office)
                <tr>
                    <td>{{ $office->name }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

