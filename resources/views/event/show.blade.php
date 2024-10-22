<x-app-layout>
    <style>
        h1{
            font-size: 50px;
            font-weight:bold;
            text-align: center;
        }
    </style>
    
    <section class="bg-white dark:bg-gray-900">
        <button onclick="history.back()" class="ms-5 inline-flex items-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:focus:ring-primary-900">
            &laquo; kembali
        </button>
        <h1>Rincian Event</h1>
        <div class="gap-8 py-8 px-4 mx-auto max-w-screen-xl xl:gap-16 md:grid md:grid-cols-2 sm:py-16 lg:px-6">
            <img class="w-full dark:hidden" src="{{ asset('storage/' . $event->foto) }}" alt="{{ $event->foto }}">
            {{-- <img class="w-full hidden dark:block" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/cta/cta-dashboard-mockup-dark.svg" alt="dashboard image"> --}}
            <div class="mt-4 md:mt-0">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">{{ $event->nama_event }}</h2>
                <h4 class="mb-4 text-2xl tracking-tight font-extrabold text-gray-900 dark:text-white">Tanggal: {{ date('l, M-d-Y', strtotime($event->tanggal)) }}</h4>
                <h4 class="mb-4 text-2xl tracking-tight font-extrabold text-gray-900 dark:text-white">Lokasi: {{ $event->lokasi }}</h4>
                <p class="mb-6 text-gray-500 md:text-lg dark:text-gray-400">{{ $event->deskripsi }}</p>
            </div>
        </div>
    </section>
    

    
</x-app-layout>