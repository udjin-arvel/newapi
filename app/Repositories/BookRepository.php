<?php

namespace App\Repositories;

use App\Models\Book;
use App\Exceptions\TBError;

/**
 * Class BookRepository
 * @package App\Repositories
 */
class BookRepository extends Repository implements Chaptered
{
    /**
     * @return mixed|string
     */
    protected function getModelClass() {
        return Book::class;
    }
    
    /**
     * Получить экземпляр книги
     *
     * @param int $id
     * @return \Eloquent
     * @throws TBError
     */
    public function one(int $id)
    {
        return $this->getModel($id);
    }
    
    /**
     * Получить список книг\
     * @return array
     */
    public function all()
    {
        return Book::orderBy('created_at', 'desc')->get();
    }
    
    /**
     * Получить главы истории
     *
     * @param int $id
     * @return array
     * @throws TBError
     */
    public function getChapters(int $id)
    {
        /**
         * @type Book $book
         */
        $book = $this->getModel($id);
        $chapters = [];
    
        if (!empty($book->stories)) {
            foreach ($book->stories as $story) {
                $chapters[] = [
                    'id'         => $story->id,
                    'title'      => $story->title,
                    'chapter'    => $story->chapter,
                    'is_project' => false,
                ];
            }
        }
        
        if (!empty($book->storyProjects)) {
            foreach ($book->storyProjects as $project) {
                $title = implode('|', $project->titles->map(function ($item) {
                    return $item['text'];
                })->toArray());
    
                $chapters[] = [
                    'id'         => $project->id,
                    'title'      => $title,
                    'chapter'    => $project->id,
                    'is_project' => true,
                ];
            }
        }
    
        return [
            'id'       => $book->id,
            'title'    => $book->title,
            'chapters' => $chapters,
        ];
    }
    
    /**
     * Сохранить книгу
     *
     * @param array $data
     * @return Book
     * @throws TBError
     */
    public function save(array $data)
    {
        /**
         * @type Book $model
         */
        $model = $this->getModel($data['id']);
    
        $model->title       = $data['title'];
        $model->description = $data['description'];
        $model->user_id     = $this->user->id;
        $model->poster      = ImageRepository::getLatestImage($data['poster'], $model->poster);
        
        if (!$model->save()) {
            throw new TBError(TBError::BOOK_SAVE_FAILED);
        }
        
        return $model;
    }
}
