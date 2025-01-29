<x-app-layout>
    @section('content')
    <h1>Hasil Pencarian untuk: {{ $query }}</h1>

    @foreach ($results as $model => $items)
        <h2 class="mt-4">{{ ucfirst($model) }}</h2>
        @if($items->isEmpty())
            <p>Tidak ada hasil ditemukan untuk {{ $model }}.</p>
        @else
            <ul>
                @foreach($items as $item)
                    <li>
                        @if($model === 'produk')
                            <a href="{{ route('produks.show', $item->id) }}">{{ $item->product_name }}</a>
                        @elseif($model === 'penawaran')
                            <a href="{{ route('penawaran.show', $item->id) }}">{{ $item->title }}</a>
                        @elseif($model === 'detail_penawaran')
                            <a href="{{ route('detail_penawaran.show', $item->id) }}">{{ $item->description }}</a>
                        @endif
                    </li>
                @endforeach
            </ul>
        @endif
    @endforeach
@endsection

</x-app-layout>