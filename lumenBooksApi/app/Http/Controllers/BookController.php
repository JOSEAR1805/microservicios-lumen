<?php

namespace App\Http\Controllers;


use App\Models\Book;
use App\Traits\ApiResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class BookController extends Controller
{
    use ApiResponse;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Return books list
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();
        return $this->successResponse($books);
    }

    /**
     * Create an instance of Book
     * @return Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'price' => 'required|min:1',
            'author_id' => 'required|min:1',
        ];
        $this->validate($request, $rules);

        $book = Book::create($request->all());

        return $this->successResponse($book, Response::HTTP_CREATED);
    }

    /**
     * Return an specific Book
     * @return Illuminate\Http\Response
     */
    public function show($bookId)
    {
        $book = Book::findOrFail($bookId);

        return $this->successResponse($book);
    }

    /**
     * Update thejinformation of an existing Book
     * @return Illuminate\Http\Response
     */
    public function update(Request $request, $bookId)
    {
        $rules = [
            'title' => 'max:255',
            'description' => 'max:255',
            'price' => 'min:1',
            'author_id' => 'min:1',
        ];
        $this->validate($request, $rules);

        $book = Book::findOrFail($bookId);
        $book->fill($request->all());

        if ($book->isClean()) {
            return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $book->save();
        return $this->successResponse($book);
    }

    /**
     * Remove an existing Book
     * @return Illuminate\Http\Response
     */
    public function destroy($bookId)
    {
        $book = Book::findOrFail($bookId);
        $book->delete();
        return $this->successResponse($book);
    }
}
