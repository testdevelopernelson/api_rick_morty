<thead>
    <tr>
         <th colspan="5">{{ __('saving_simulator.projection') }}</th>
    </tr>
     @foreach ($projection as $key => $item)
       @if($key == 0)
          <tr>
            <td>{{ $item['col1'] }}</td>
            <td>{{ $item['col2'] }}</td>
            <td>{{ $item['col3'] }}</td>
            <td>{{ $item['col4'] }}</td>
            <td>{{ $item['col5'] }}</td>
          </tr>
          @php
            break;
          @endphp
      @endif
    @endforeach
   </thead>
   <tbody>
    @foreach ($projection as $key => $item)
     @if($key > 0)
      <tr>
        <td>{{ $item['col1'] }}</td>
        <td>${{ $item['col2'] }}</td>
        <td>${{ $item['col3'] }}</td>
        <td>${{ $item['col4'] }}</td>
        <td>${{ $item['col5'] }}</td>
      </tr>
      @endif
    @endforeach
   	
</tbody>