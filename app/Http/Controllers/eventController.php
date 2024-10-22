<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\event;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class eventController extends Controller
{
    // public function index(){
    //     // Ambil semua data siswa dari database
    // $events = event::all();


    // // Kirim data siswa ke view index.blade.php
    // return view('event.index', compact('events'));
    // }

    // public function index(Request $request): View{
    //     $searchTerm = $request->input('search'); // Mendapatkan query pencarian dari input

    //     $page = null;

    //     if ($page == 'dashboard') {
    //         $data = event::all(); // Data khusus untuk dashboard
    //     } elseif ($page == 'event') {
    //         $data = event::all(); // Data khusus untuk event
    //     }


    //     // Melakukan pencarian berdasarkan term pencarian
    //     $events = event::where('nama_event', 'like', '%' . $searchTerm . '%')
    //                        ->latest()
    //                        ->paginate(10); // Menggunakan pagination jika perlu

        
        

    //     return view('event.index', compact('events', 'searchTerm'), ['searchTerm' => $searchTerm]);
    // }

    public function index(Request $request): View{
    // Mendapatkan term pencarian dari input
    $searchTerm = $request->input('search'); 

    // Mendapatkan nama halaman dari route atau request
    // $page = $request->route()->getName(); 

    // Data default kosong
    // $data = null;

    // Tentukan data berdasarkan halaman
    // if ($page == 'dashboard') {
    //     $data = event::where('nama_event', 'like', '%' . $searchTerm . '%')
    //                           ->latest()
    //                           ->paginate(10); // Data khusus untuk dashboard
    //     $view = 'dashboard'; // View untuk dashboard
    // } elseif ($page == 'event') {
    //     $data = event::where('nama_event', 'like', '%' . $searchTerm . '%')
    //                  ->latest()
    //                  ->paginate(10); // Data khusus untuk event
    //     $view = 'event.index'; // View untuk event
    // } else {
        $data = event::where('nama_event', 'like', '%' . $searchTerm . '%')
                     ->latest()
                     ->paginate(10);

    //     $view = 'dashboard';
    // }

    // Return view berdasarkan halaman
    return view('event.index', [
        'events' => $data, // Data untuk foreach di view
        'searchTerm' => $searchTerm,
        // 'day' => $day // Menyimpan term pencarian untuk input di view
    ]);
}

public function index2(Request $request): View{
    // Mendapatkan term pencarian dari input
    $searchTerm = $request->input('search2'); 

    // // Mendapatkan nama halaman dari route atau request
    // $page = $request->route()->getName(); 

    // // Data default kosong
    // $data = null;

    // // Tentukan data berdasarkan halaman
    // if ($page == 'dashboard') {
    //     $data = event::where('nama_event', 'like', '%' . $searchTerm . '%')
    //                           ->latest()
    //                           ->paginate(10); // Data khusus untuk dashboard
    //     $view = 'dashboard'; // View untuk dashboard
    // } elseif ($page == 'event') {
    //     $data = event::where('nama_event', 'like', '%' . $searchTerm . '%')
    //                  ->latest()
    //                  ->paginate(10); // Data khusus untuk event
    //     $view = 'event.index'; // View untuk event
    // } else {
        $data = event::where('nama_event', 'like', '%' . $searchTerm . '%')
            ->latest()
            ->paginate(10);
        $count = count($data);

    //     $view = 'dashboard';
    // }




    // Return view berdasarkan halaman
    return view('dashboard', [
        'events' => $data, // Data untuk foreach di view
        'searchTerm' => $searchTerm,
        'count' => $count,
        // 'day' => $day // Menyimpan term pencarian untuk input di view
    ]);
}


    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nama_event'=> 'required|string',
            'deskripsi'=> 'required|string',
            'tanggal'=> 'required|string',
            'lokasi'=> 'required|string',
            'foto'=> 'required|image|mimes:jpeg,jpg,png,afiv|max:2048',
        ]);

        // $foto = $request->file('foto');
        // $foto->store('public/bukti', $foto->hashName(), 'public');

        $foto = $request->file('foto')->store('foto', 'public');


        event::create([
            'nama_event'=> $request->nama_event,
            'deskripsi'=> $request->deskripsi,
            'tanggal'=> $request->tanggal,
            'lokasi'=> $request->lokasi,
            'foto'=> $foto ?? null,
        ]);


        return redirect('/event');
    }

    public function show(string $id): view {
        // mengatur/ambil data berdasarkan ID
        $event = event::findOrFail($id);
        // findOrFail : untuk mengambil sebuah record dari db berdasarkan id
        // mengirimkan data event ke view

        return view('event.show', compact('event'));
    }


    public function edit(string $id): view {
        // mengatur/ambil data berdasarkan ID
        $events = event::findOrFail($id);
        // findOrFail : untuk mengambil sebuah record dari db berdasarkan id
        // mengirimkan data event ke view

        return view('event.edit', compact('events'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        //validate form
        $request->validate([
            'nama_event'=> 'required|string',
            'deskripsi'=> 'required|string',
            'tanggal'=> 'required|string',
            'lokasi'=> 'required|string',
            'foto'=> 'image|mimes:jpeg,jpg,png,afiv|max:2048',
        ]);

        //get event by ID
        $event = event::findOrFail($id);

        //check if image is uploaded
        if ($request->hasFile('foto')) {

            //upload new image
            // $foto = $request->file('foto');
            $foto = $request->file('foto')->store('foto', 'public');

            //delete old foto
            Storage::delete('public/foto/'.$event->foto);

            //update event with new foto
            $event->update([
                'nama_event'=> $request->nama_event,
                'deskripsi'=> $request->deskripsi,
                'tanggal'=> $request->tanggal,
                'lokasi'=> $request->lokasi,
                'foto'=> $request->foto,
            ]);

        } else {

            //update event without image
            $event->update([
                'nama_event'=> $request->nama_event,
                'deskripsi'=> $request->deskripsi,
                'tanggal'=> $request->tanggal,
                'lokasi'=> $request->lokasi,
            ]);
        }

        //redirect to index
        return redirect()->route('event')->with(['success' => 'Data Berhasil Diubah!']);
    }


    public function destroy($id): RedirectResponse{
        //get event by id
        $event = event::findOrFail($id);

        //delete image
        Storage::delete('public/foto/'. $event->foto);

        //delete event
        $event->delete();

        //redirect to index
        return redirect()->route('event')->with(['success' => 'Data Berhasil Dihapus!']);
    }

}
