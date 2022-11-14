<?php

namespace App\Http\Controllers;

use App\Services\AuthorService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    use ApiResponse;

    /**
     * The service consume the author service
     * @var AuthorService
     */
    public $authorService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }

        /**
     * Return authors list
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        return $this->successResponse($this->authorService->obtainAuthors());
    }

    /**
     * Create an instance of Author
     * @return Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->successResponse($this->authorService->createAuthor($request->all()));
    }

    /**
     * Return an specific Author
     * @return Illuminate\Http\Response
     */
    public function show($authorId)
    {
        return $this->successResponse($this->authorService->obtainAuthor($authorId));
    }

    /**
     * Update an instance of author
     * @return Illuminate\Http\Response
     */
    public function update(Request $request, $authorId)
    {
        return $this->successResponse($this->authorService->updateAuthor($request->all(), $authorId));
    }

    /**
     * Remove an instance of author
     * @return Illuminate\Http\Response
     */
    public function destroy($authorId)
    {
        return $this->successResponse($this->authorService->deleteAuthor($authorId));
    }
}
