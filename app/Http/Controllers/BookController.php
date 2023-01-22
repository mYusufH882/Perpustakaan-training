<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index()
    {
        if (auth()->user()->hasRole('operator')) {
            $books = Book::where('user_id', auth()->user()->id)->get();
        } else {
            $books = Book::all();
        }

        return view('books.index', compact('books'));
    }

    public function create()
    {
        return view('books.create');
    }

    public function save(Request $req)
    {
        $data = $req->validate([
            'title' => 'required',
            'description' => 'required',
            'author' => 'required',
            'cover' => 'mimes:jpg,png',
            'file_buku' => 'mimes:pdf|max:2048',
            'user_id' => 'required'
        ]);

        if ($req->file('cover')) {
            $path_cover = $req->cover->store('public');
        } else {
            $path_cover = "public/default.jpg";
        }

        $data['cover'] = str_replace("public/", "", $path_cover);

        if ($req->file('file_buku')) {
            $path_buku = $req->file_buku->store('public/file_buku');
        } else {
            $path_buku = '';
        }

        $data['file_buku'] = str_replace("public/file_buku", "", $path_buku);

        Book::create($data);

        return redirect('books')->with('success', 'Buku berhasil di buat');
    }

    public function edit($id)
    {
        $book = Book::find($id);

        return view('books.edit', compact('book'));
    }

    public function update(Request $req, $id)
    {
        $data = $req->validate([
            'title' => 'required',
            'description' => 'required',
            'author' => 'required',
        ]);

        if ($req->file('cover')) {
            $data = $req->validate([
                'cover' => 'mimes:jpg,png'
            ]);

            $path_cover = $req->cover->store('public');
            $data['cover'] = str_replace("public/", "", $path_cover);
        }

        if ($req->file('file_buku')) {
            $data = $req->validate([
                'file_buku' => 'mimes:pdf|max:2048'
            ]);

            $path_buku = $req->file_buku->store('public/file_buku');
            $data['file_buku'] = str_replace("public/file_buku", "", $path_buku);
        }


        Book::where('id', $id)->update($data);

        return redirect('books')->with('success', 'Buku berhasil di ubah');
    }

    public function destroy($id)
    {
        $book = Book::find($id);
        $book->delete();

        return redirect('books')->with('success', 'Buku berhasil di hapus');
    }

    public function download($id)
    {
        $buku = Book::find($id);
        $path_buku = 'public/file_buku' . $buku->file_buku;

        return Storage::download($path_buku);
    }
}
