<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <section class="bg-gray-50 antialiased dark:bg-gray-900">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            <!-- Heading & Filters -->
            <div class="bg-white relative shadow-sm sm:rounded-lg overflow-hidden mb-10">
            <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
            <div class="w-full md:w-1/2">
              <form class="flex items-center" action="{{ route('dashboard') }}" method="GET">
                  <label for="simple-search" class="sr-only">Search</label>
                  <div class="relative w-full">
                      <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                          <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                              <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                          </svg>
                      </div>
                      <button onclick="clearInput()" type="button" class="absolute inset-y-0 right-1 flex items-center pl-3">
                          <svg  class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24">
                              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"/>
                          </svg>
                      </button>
                      <input value="{{ $searchTerm }}" type="text" id="search2" name="search2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Search" autocomplete="off">
                  </div>
                  <button type="submit" class="m-5 flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                      Search
                  </button>
              </form>
          </div>
          </div>
            <php class="ms-4">
              @php
              // dump(request('search'));
              $msg;
              $searchTerm = $searchTerm ?? null;
              
              if ($count == 0 && !isset($searchTerm)) {
                $msg = "<span style='color:red;'>Data Belum Tersedia</span>";
              }
              elseif ($count == 0 && isset($searchTerm)) {
                  $msg = "Data Yang Anda Cari \"<span style='color:red;'> $searchTerm </span>\" Tidak Ada";
                }
                elseif ($count > 0 && isset($searchTerm)) {
                  $msg = "Menampilkan <span style='color:green;'>$count</span> hasil pada pencarian \"<span style='color:green;'> $searchTerm </span>\"";
                }
                else {
                  $msg = "";
                };   
                echo $msg;
                $no = 1;
                @endphp
            </php>
          

              <div class="mt-5 mb-4 grid gap-4 sm:grid-cols-2 md:mb-8 lg:grid-cols-3 xl:grid-cols-4">

                  @foreach ($events as $event)
                  <p hidden>{{ $no++ }}</p>

                  <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                  <div class="h-56 w-full">
                    {{-- <a href="{{ route('products.show', $event->id) }}"> --}}
                      <img class="mx-auto h-full dark:hidden" src="{{ asset('storage/'.$event->foto) }}" alt="{{ $event->foto }}" />
                    {{-- </a> --}}
                  </div>
                  <div class="pt-6">
                      <div class="mb-4 flex items-center justify-between gap-4">
                      {{-- <span class="me-2 rounded bg-primary-100 px-2.5 py-0.5 text-xs font-medium text-primary-800 dark:bg-primary-900 dark:text-primary-300"> Up to 35% off </span> --}}

                      {{-- <div class="flex items-center justify-end gap-1">
                        <a href="{{ route('products.show', $event->id) }}" type="button" data-tooltip-target="tooltip-quick-look" class="rounded-lg p-2 text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                          <span class="sr-only"> Lihat </span>
                          <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-width="1.3" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z"/>
                            <path stroke="currentColor" stroke-width="1.3" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                          </svg>
                        </a>

                        <a href="{{ route('products.edit', $event->id) }}" type="button" data-tooltip-target="tooltip-add-to-favorites" class="rounded-lg p-2 text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                            <span class="sr-only"> Edit </span>
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.3" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"/>
                              </svg>
                          </a>

                        @method('DELETE')
                        <a onclick="event.preventDefault(); if(confirm('Yakin ingin menghapus data ini?')) document.getElementById('delete-form-{{ $event->id }}').submit();" type="button" data-tooltip-target="tooltip-add-to-favorites" class="rounded-lg p-2 text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                          <span class="sr-only"> Hapus </span>
                          <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.3" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
                          </svg>

                        <form id="delete-form-{{ $event->id }}" action="{{ route('products.destroy', $event->id) }}" method="POST" style="display:none;">
                            @csrf
                            @method('DELETE')
                        </form>

                        </a>
                      </div> --}}
                    </div>

                    <a class="text-lg font-semibold leading-tight text-gray-900 hover:underline dark:text-white">{{ $event->nama_event }}</a>

                    
                    <ul class="mt-2 flex items-center gap-4">
                      <li class="flex items-center gap-2">
                        <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M20 10V7C20 5.89543 19.1046 5 18 5H6C4.89543 5 4 5.89543 4 7V10M20 10V19C20 20.1046 19.1046 21 18 21H6C4.89543 21 4 20.1046 4 19V10M20 10H4M8 3V7M16 3V7" stroke="#000000" stroke-width="2" stroke-linecap="round"></path> <rect x="6" y="12" width="3" height="3" rx="0.5" fill="#000000"></rect> <rect x="10.5" y="12" width="3" height="3" rx="0.5" fill="#000000"></rect> <rect x="15" y="12" width="3" height="3" rx="0.5" fill="#000000"></rect> </g></svg>                      
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ date('l, M-d-Y', strtotime($event->tanggal)) }}</p>
                      </li>
                    </ul>
                    <ul class="mt-2 flex items-center gap-4">
                      <li class="flex items-center gap-2">
                        <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M12 21C15.5 17.4 19 14.1764 19 10.2C19 6.22355 15.866 3 12 3C8.13401 3 5 6.22355 5 10.2C5 14.1764 8.5 17.4 12 21Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M12 12C13.1046 12 14 11.1046 14 10C14 8.89543 13.1046 8 12 8C10.8954 8 10 8.89543 10 10C10 11.1046 10.8954 12 12 12Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>                       
                      <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ Str::limit($event->lokasi, 30) }}</p>
                      </li>
                    </ul>

                    <ul class="mt-2 flex items-center gap-4">
                      <li class="flex items-center gap-2">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11h2v5m-2 0h4m-2.592-8.5h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                        </svg>                        
                      <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ Str::limit($event->deskripsi, 30) }}</p>
                      </li>
                    </ul>

                    <div class="mt-4 flex items-center justify-between gap-4">
                      {{-- <p class="text-1xl font-extrabold leading-tight text-gray-900 dark:text-white">{{ 'Rp ' . number_format($event->price, 2, ',', '.') }}</p> --}}

                      <a href="{{ route('event.show', $event->id) }}"  type="button" class="inline-flex items-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4  focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                        <svg style="margin-right:15px; color:white;" class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                          <path stroke="currentColor" stroke-width="1.3" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z"/>
                          <path stroke="currentColor" stroke-width="1.3" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                        </svg>
                        Lihat Lebih Lanjut
                      </a>
                </div>
            </div>
        </div>
        @endforeach
        
        </div>
        {{ $events->links() }}
    </div>
</section>
</x-app-layout>

<script>
  function clearInput(){
      document.getElementById('search2').value = '';
      form.submit(); // Menghapus nilai input
  };
</script>
