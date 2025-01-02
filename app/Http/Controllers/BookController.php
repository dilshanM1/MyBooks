<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller
{
    // Display a list of books based on search query
    public function index(Request $request)
    {
        // Get search query
        $query = $request->query('query', '');

        // Fetch books from the Google Books API
        $books = $this->fetchBooks($query);

        return view('books.index', compact('books'));
    }

    // Add book to the favorites list
    public function addToFavorites(Request $request)
    {
        $book = json_decode($request->input('book'), true);

        $favorites = session()->get('favorites', []);

        if (!$this->isBookInFavorites($book, $favorites)) {
            $favorites[] = $book;
            session()->put('favorites', $favorites);
        }

        return redirect()->route('favorites');
    }

    // Show the favorites page
    public function showFavorites()
    {
        $favorites = session()->get('favorites', []);

        return view('books.favorites', compact('favorites'));
    }

    private function fetchBooks($query)
    {
        $url = 'https://www.googleapis.com/books/v1/volumes?q=' . urlencode($query);
        $response = file_get_contents($url);
        $data = json_decode($response, true);

        return $data['items'] ?? [];
    }

    private function isBookInFavorites($book, $favorites)
    {
        foreach ($favorites as $favorite) {
            if ($favorite['id'] == $book['id']) {
                return true;
            }
        }
        return false;
    }
}
//correct