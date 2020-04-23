<p>Message:</p>
<p>{{ $data['message'] }}</p>

@component('mail::table')
    <div class="tile-body">
        <table class="table table-hover table-bordered rwd-table" id="sampleTable">
            <thead>
            <tr>
                <th class="text-center">Client</th>
                <th class="text-center">Product</th>
                <th class="text-center">Total</th>
                <th class="text-center">Date</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data['orderProducts'] as $item)
                <tr>
                    <td data-th="Client">
                        {{ $item->client->client }}
                    </td>
                    <td data-th="Product">
                        <var class="price">{{ $item->product }}</var>
                    </td>
                    <td data-th="Total">
                        {{ str_replace(" ","",number_format($item->total, 2, '.', ' ')) }}
                    </td>
                    <td data-th="Date">
                        {{ \Carbon\Carbon::parse($item->date)->format('m/d/Y') }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endcomponent
