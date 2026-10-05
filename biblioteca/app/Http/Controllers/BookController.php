<?php

namespace App\Http\Controllers;

use App\Models\Books;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public readonly Books $books;
   
    public function __construct()
    {   
        $this->books = new Books();
    }   

    public function index()
    {
        return view('index_books');
    }



    public function create()
    {
        return view('create_book');
    }


    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'published_year' => 'required|integer',
            // Add other validation rules as needed
        ]);

        // Create a new book record in the database
        $book = new Books();
        $book->title = $validatedData['title'];
        $book->author = $validatedData['author'];
        $book->published_year = $validatedData['published_year'];
        // Set other attributes as needed
        $book->save();

        // Redirect or return a response
        return redirect()->route('books.index')->with('success', 'Book created successfully.');
    }


    public function show($id)
    {
        // Retrieve the book by its ID
        $book = Books::findOrFail($id);

        // Return a view with the book details
        return view('show_book', compact('book'));
    }

    public function edit($id)
    {
        // Retrieve the book by its ID
        $book = Books::findOrFail($id);

        // Return a view with the book details for editing
        return view('edit_book', compact('book'));
    }

    public function update(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'published_year' => 'required|integer',
            // Add other validation rules as needed
        ]);

        // Retrieve the book by its ID
        $book = Books::findOrFail($id);

        // Update the book attributes
        $book->title = $validatedData['title'];
        $book->author = $validatedData['author'];
        $book->published_year = $validatedData['published_year'];
        // Update other attributes as needed
        $book->save();

        // Redirect or return a response
        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }

    public function destroy($id)
    {
        // Retrieve the book by its ID
        $book = Books::findOrFail($id);

        // Delete the book from the database
        $book->delete();

        // Redirect or return a response
        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }

}
