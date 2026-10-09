<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\JsonResponse;

class BookController extends Controller
{
    public function index(): JsonResponse
    {
        $books = Book::query()
            ->orderBy('id')
            ->get()
            ->map(fn (Book $book): array => $this->bookData($book));

        return response()->json([
            'data' => $books,
        ]);
    }

    public function show(int $book): JsonResponse
    {
        $bookModel = Book::find($book);

        if ($bookModel === null) {
            return response()->json([
                'message' => 'Book not found',
                'errors' => null,
            ], 404);
        }

        return response()->json([
            'data' => $this->bookData($bookModel),
        ]);
    }

    private function bookData(Book $book): array
    {
        return [
            'id' => $book->id,
            'title' => $book->title,
            'isbn' => $book->isbn,
            'available' => (bool) $book->available,
            'created_at' => $book->created_at?->toISOString(),
        ];
    }
}