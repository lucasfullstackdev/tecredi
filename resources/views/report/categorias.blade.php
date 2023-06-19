<table style="table-layout: fixed;">
    <thead>
        <tr>
            @foreach ($headers as $key => $header)
                <th>{{ ucfirst($header) }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $row)
            <tr>
                @foreach ($row as $key => $value)
                    @if (in_array($key, $headers))
                        <td>{{ $value }}</td>
                    @endif
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>
