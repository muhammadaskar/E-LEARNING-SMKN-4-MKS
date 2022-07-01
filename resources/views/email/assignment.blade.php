@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            E-Learning SMK Negeri 4 Makassar
        @endcomponent
    @endslot

    {{-- Subcopy --}}
    @slot('subcopy')
        @component('mail::subcopy')
            # Halo {{ $data['name'] }}
            <h3>Tugas baru telah ditambahkan oleh guru di kelas</h3>
            <h4>Silahkan dikumpul sebelum hari {{ $data['due_date'] }} jam {{ $data['time'] }}</h4>
            <p>Jangan lupa dikerjakan</p>
            <p>Terima Kasih</p>
        @endcomponent
    @endslot


    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            E-Learning SMK Negeri 4 Makassar
        @endcomponent
    @endslot
@endcomponent
