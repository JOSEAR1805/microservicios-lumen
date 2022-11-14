<?php
namespace App\Services;

use App\Traits\ConsumesExternalService;

class AuthorService
{
    use ConsumesExternalService;

    /**
     * The base uri to be used to consume the authors service
     * @var string
     */
    public $baseUri;

    /**
     * The secret to be used to consume the authors service
     * @var string
     */
    public $secret;

    public function __construct()
    {
        $this->baseUri = config('services.authors.base_uri');
        $this->secret = config('services.authors.secret');
    }

    /**
     * Get the full List of authors from the authors service
     * @return string
     */
    public function obtainAuthors()
    {
        return $this->performRequest('GET', '/authors');
    }

    /**
     * Create an instance of author using the authors service
     * @return string
     */
    public function createAuthor($data)
    {
        return $this->performRequest('POST', '/authors', $data);
    }

    /**
     * Get a single author from the authors service
     * @return string
     */
    public function obtainAuthor($authorId)
    {
        return $this->performRequest('GET', "/authors/{$authorId}");
    }

    /**
     * Update an instance of author using the authors service
     * @return string
     */
    public function updateAuthor($data, $authorId)
    {
        return $this->performRequest('PUT', "/authors/{$authorId}", $data);
    }

    /**
     * Delete an instance of author using the authors service
     * @return string
     */
    public function deleteAuthor($authorId)
    {
        return $this->performRequest("DELETE", "/authors/{$authorId}");
    }
}