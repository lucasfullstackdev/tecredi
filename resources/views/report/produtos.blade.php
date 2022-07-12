<table>
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
                        @if ($key == 'categoria')
                            <td>{{ $value['nome'] ?? '' }}</td>
                        @else
                            <td>{{ $value }}</td>
                        @endif
                    @endif
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>
