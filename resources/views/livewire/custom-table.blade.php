<table class="table">
    <thead>
        <tr>
            @foreach($columns as $column)
                <th>{{ $column->text }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($rows as $row)
            <tr>
                @foreach($columns as $column)
                    <td>{{ $column->render($row) }}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>
