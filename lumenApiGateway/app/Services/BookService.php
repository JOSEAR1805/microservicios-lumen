<?php
namespace App\Services;

use App\Traits\ConsumesExternalService;

class BookService
{
    use ConsumesExternalService;

    /**
     * The base uri to be used to consume the books service
     * @var string
     */
    public $baseUri;

    /**
     * The base uri to be used to consume the books service
     * @var string
     */
    public $secret;

    public function __construct()
    {
        $this->baseUri = config('services.books.base_uri');
        $this->secret = config('services.books.secret');
    }

    /**
     * Get the full List of books from the books service
     * @return string
     */
    public function obtainBooks()
    {
        return $this->performRequest('GET', '/books');
    }

    /**
     * Create an instance of book using the books service
     * @return string
     */
    public function createBook($data)
    {
        return $this->performRequest('POST', '/books', $data);
    }

    /**
     * Get a single book from the books service
     * @return string
     */
    public function obtainBook($bookId)
    {
        return $this->performRequest('GET', "/books/{$bookId}");
    }

    /**
     * Update an instance of book using the books service
     * @return string
     */
    public function updateBook($data, $bookId)
    {
        return $this->performRequest('PUT', "/books/{$bookId}", $data);
    }

    /**
     * Delete an instance of book using the books service
     * @return string
     */
    public function deleteBook($bookId)
    {
        return $this->performRequest("DELETE", "/books/{$bookId}");
    }
}