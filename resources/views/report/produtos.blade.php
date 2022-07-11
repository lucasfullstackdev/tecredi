<table>
    <thead>
        <tr>
            @foreach ($data[0] as $key => $value)
                <th>{{ ucfirst($key) }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $row)
            <tr>
                @foreach ($row as $key => $value)
                    @if ($key == 'categoria')
                        <td>{{ $value['nome'] ?? '' }}</td>
                    @else
                        <td>{{ $value }}</td>
                    @endif
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>
