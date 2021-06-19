<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\TBError;
use App\Models\Note;
use App\Repositories\BookRepository;
use App\Repositories\CorrectionRepository;
use App\Repositories\FragmentRepository;
use App\Repositories\ImageRepository;
use App\Repositories\LoreItemRepository;
use App\Repositories\NoteRepository;
use App\Repositories\StoryCommentRepository;
use App\Repositories\SubscriptionRepository;
use App\Repositories\TagRepository;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Repositories\StoryRepository;
use App\Repositories\NotionRepository;
use App\Repositories\SeriesRepository;
use Mockery\Exception;

/**
 * Class BookController
 * @package App\Http\Controllers\Api
 *
 * @property mixed $input
 */
class BookController extends Controller
{
    /**
     * @var mixed
     */
    protected $input;
    
    /**
     * BookController constructor.
     */
    public function __construct()
    {
        $this->input = request()->input();
    }
    
    /**
     * Получить базовые данные для TheBook
     */
    public function getBasicData()
    {
        return $this->sendSuccess([
            'note_types' => Note::getTypes(),
        ]);
    }
    
    // -------------  BOOKS --------------------------------------------------------------------------------------------

    /**
     * Получить список книг
     *
     * @param BookRepository $repository
     * @return Response
     */
    public function getBooks(BookRepository $repository)
    {
        return $this->sendSuccess($repository->all());
    }

    /**
     * Получить книгу
     *
     * @param BookRepository $repository
     * @param int $id
     * @return Response
     */
    public function getBook(BookRepository $repository, int $id)
    {
        return $this->sendSuccess($repository->one($id));
    }

    /**
     * Сохранить книгу
     *
     * @param BookRepository $repository
     * @return Response
     */
    public function saveBook(BookRepository $repository)
    {
        return $this->sendSuccess($repository->save($this->input));
    }
    
    /**
     * Удалить книгу
     *
     * @param BookRepository $repository
     * @param {integer} $id
     * @return Response
     * @throws TBError
     */
    public function deleteBook(BookRepository $repository, $id)
    {
        return $this->sendSuccess($repository->delete($id));
    }

    /**
     * Получить главы книги
     *
     * @param BookRepository $repository
     * @param int $id
     * @return Response
     * @throws TBError
     */
    public function getBookChapters(BookRepository $repository, $id)
    {
        return $this->sendSuccess($repository->getChapters($id));
    }
    
    // -------------  STORIES ------------------------------------------------------------------------------------------


	/**
	 * Получить доступные пользователю истории (каноничные и не каноничные)
	 *
	 * @param StoryRepository $repository
	 * @return Response
	 */
	public function getStories(StoryRepository $repository)
	{
        return $this->sendSuccess($repository->all());
	}

    /**
     * Получить информацию об истории
     *
     * @param StoryRepository $repository
     * @param int $id
     * @return Response
     * @throws TBError
     */
    public function getStory(StoryRepository $repository, $id)
    {
        return $this->sendSuccess($repository->getOne($id));
    }

    /**
     * Сохранить или изменить историю
     *
     * @param StoryRepository $repository
     * @return Response
     * @throws TBError
     */
    public function saveStory(StoryRepository $repository)
    {
        $storyId = $repository->save(request()->all());
        
        FragmentRepository::massSaveProvider($storyId, request()->get('fragments'));
        StoryCommentRepository::massSaveProvider($storyId, request()->get('comments'));
        NotionRepository::massSaveProvider($storyId, request()->get('notions'), 'story_notion', 'notion_id');
        TagRepository::massSaveProvider($storyId, request()->get('tags'), 'story_tag', 'tag_id');
        
        return $this->sendSuccess($repository->one($storyId));
    }

    /**
     * Удалить историю
     *
     * @param StoryRepository $repository
     * @param {integer} $id
     * @return Response
     * @throws TBError
     */
    public function deleteStory(StoryRepository $repository, $id)
    {
        return $this->sendSuccess($repository->delete($id));
    }

    // -------------  NOTIONS ------------------------------------------------------------------------------------------

	/**
     * Получить понятия
     *
	 * @param NotionRepository $repository
	 * @return Response
	 */
	public function getNotions(NotionRepository $repository)
	{
        return $this->sendSuccess($repository->all());
	}

    /**
     * Получить данные понятия
     *
     * @param NotionRepository $repository
     * @param int $id
     * @return Response
     * @throws TBError
     */
	public function getNotion(NotionRepository $repository, $id)
	{
        return $this->sendSuccess($repository->one($id));
	}

    /**
     * Получить изображения галлереи понятия
     *
     * @param NotionRepository $repository
     * @param int $id
     * @return Response
     * @throws TBError
     */
    public function getNotionGallery(NotionRepository $repository, $id)
    {
        return $this->sendSuccess($repository->getNotionGallery($id));
	}

    /**
     * Сохранить или изменить понятие
     *
     * @param NotionRepository $repository
     * @return Response
     * @throws TBError
     */
	public function saveNotion(NotionRepository $repository)
	{
		$data = $this->input;
        return $this->sendSuccess($repository->save($data));
	}

    /**
     * @param NotionRepository $repository
     * @param {integer} $id
     * @return Response
     * @throws TBError
     */
    public function deleteNotion(NotionRepository $repository, $id)
    {
        return $this->sendSuccess($repository->delete($id));
    }

    // -------------  NOTES --------------------------------------------------------------------------------------------

    /**
     * Получить заметки
     *
     * @param NoteRepository $repository
     * @return Response
     */
	public function getNotes(NoteRepository $repository)
	{
        return $this->sendSuccess($repository->all());
	}

    /**
     * Сохранить заметку
     *
     * @param NoteRepository $repository
     * @return Response
     */
	public function saveNote(NoteRepository $repository)
	{
        return $this->sendSuccess($repository->save($this->input));
	}

    /**
     * Удалить заметку
     *
     * @param NoteRepository $repository
     * @param int $id
     * @return Response
     * @throws TBError
     */
	public function deleteNote(NoteRepository $repository, $id)
	{
        return $this->sendSuccess($repository->delete($id));
	}

	/**
     * Получить все тэги
     *
	 * @param TagRepository $repository
	 * @return Response
	 */
	public function getTags(TagRepository $repository)
	{
        return $this->sendSuccess($repository->getAll());
	}

    /**
     * Сохранить тег
     *
     * @param TagRepository $repository
     * @return Response
     * @throws TBError
     */
	public function saveTag(TagRepository $repository)
    {
        $data = $this->input;
        return $this->sendSuccess($repository->save($data));
    }

    /**
     * @param LikeRepository $repository
     * @return Response
     * @throws TBError
     */
    public function like(LikeRepository $repository)
    {
        $data = $this->input;
        return $this->sendSuccess($repository->save($data));
	}

    /**
     * Получить комментарии к истории
     *
     * @param CommentRepository $repository
     * @param {integer} $id (Story Id)
     * @return Response
     * @throws TBError
     */
    public function comments(CommentRepository $repository, $id)
    {
        return $this->sendSuccess($repository->getStoryComments($id));
	}

    /**
     * Сохранить или отредактировать комментарий
     *
     * @param CommentRepository $repository
     * @return Response
     * @throws TBError
     */
    public function comment(CommentRepository $repository)
    {
        $data = $this->input;
        return $this->sendSuccess($repository->save($data));
    }

    /**
     * Удалить комментарий
     *
     * @param CommentRepository $repository
     * @param {integer} $id (Comment Id)
     * @return Response
     * @throws TBError
     */
    public function deleteComment(CommentRepository $repository, $id)
    {
        return $this->sendSuccess($repository->delete($id));
    }

    /**
     * Выбрать клан
     *
     * @return Response
     * @throws TBError
     */
    public function chooseClan()
    {
        $data = $this->input;
        $user = Auth::user();

        return $this->sendSuccess($user->player->chooseClan($data['clanType']));
    }

    /**
     * Получить диалоги пользователя
     *
     * @param DialogRepository $repository
     * @return Response
     */
    public function getDialogs(DialogRepository $repository)
    {
        return $this->sendSuccess($repository->getDialogs());
    }

    /**
     * Создать диалог
     *
     * @param DialogRepository $repository
     * @return Response
     * @throws TBError
     */
    public function createDialog(DialogRepository $repository)
    {
        $dialog = $this->input;
        return $this->sendSuccess($repository->createDialog($dialog));
    }

    /**
     * Добавить сообщение в диалог
     *
     * @param DialogRepository $repository
     * @return Response
     * @throws TBError
     */
    public function sendMessage(DialogRepository $repository)
    {
        $data = $this->input;
        return $this->sendSuccess($repository->addMessage($data));
    }

    /**
     * Сделать сообщения указанного диалога прочитанными
     *
     * @param DialogRepository $repository
     * @return Response
     * @throws TBError
     */
    public function messagesRead(DialogRepository $repository)
    {
        $data = $this->input;
        return $this->sendSuccess($repository->messagesRead($data));
    }

    /**
     * Удалить диалог
     *
     * @param DialogRepository $repository
     * @param {integer} $id (Dialog Id)
     * @return Response
     * @throws TBError
     */
    public function deleteDialog(DialogRepository $repository, $id)
    {
        return $this->sendSuccess($repository->deleteDialog($id));
    }

    /**
     * Подписаться на пользователя или книгу
     *
     * @param SubscriptionRepository $repository
     * @return Response
     * @throws TBError
     */
    public function subscribe(SubscriptionRepository $repository)
    {
        $data = $this->input;
        return $this->sendSuccess($repository->subscribe($data));
    }

    /**
     * Исправить орфографию или пунктуацию
     *
     * @param CorrectionRepository $repository
     * @return Response
     * @throws TBError
     */
    public function correct(CorrectionRepository $repository)
    {
        $data = $this->input;
        return $this->sendSuccess($repository->save($data));
    }

    /**
     * Отправить багрепорт
     *
     * @param BugreportRepository $repository
     * @return Response
     * @throws TBError
     */
    public function report(BugreportRepository $repository)
    {
        $data = $this->input;
        return $this->sendSuccess($repository->save($data));
    }

    // -------------  CONTENT ------------------------------------------------------------------------------------------

    /**
     * Получить все карточки контента
     *
     * @param ContentRepository $repository
     * @return Response
     */
    public function getContent(ContentRepository $repository)
    {
        return $this->sendSuccess($repository->getAll());
    }

    /**
     * Добавить карточку контента
     *
     * @param ContentRepository $repository
     * @return Response
     * @throws TBError
     */
    public function addCard(ContentRepository $repository)
    {
        $data = $this->input;
        return $this->sendSuccess($repository->save($data));
    }

    /**
     * Добавить карточку контента
     *
     * @param ContentRepository $repository
     * @return Response
     * @throws TBError
     */
    public function deleteCard(ContentRepository $repository, $id)
    {
        return $this->sendSuccess($repository->delete($id));
    }

    /**
     * Получить карточку контента
     *
     * @param ContentRepository $repository
     * @param int $id
     * @return Response
     * @throws TBError
     */
    public function getCard(ContentRepository $repository, $id)
    {
        return $this->sendSuccess($repository->getOne($id));
    }

    /**
     * Купить карчточку контента
     *
     * @param ContentRepository $repository
     * @param int $id
     * @return Response
     * @throws TBError
     */
    public function buyCard(ContentRepository $repository, $id)
    {
        return $this->sendSuccess($repository->buyCard($id));
    }

    /**
     * Купить высокоуровневую историю
     *
     * @param ContentRepository $repository
     * @param int $id
     * @return Response
     * @throws TBError
     */
    public function buyStory(ContentRepository $repository, $id)
    {
        return $this->sendSuccess($repository->buyStory($id));
    }

    /**
     * Обмен икскоинов на опыт
     *
     * @param PurchaseRepository $repository
     * @param int $xcoins
     * @return Response
     * @throws TBError
     */
    public function exchangeExperience(PurchaseRepository $repository, $xcoins)
    {
        return $this->sendSuccess($repository->exchangeExperience($xcoins));
    }

    /**
     * Получить линии историйф
     *
     * @param LineRepository $repository
     * @return Response
     */
    public function getLines(LineRepository $repository)
    {
        return $this->sendSuccess($repository->getLineTrees());
    }

    /**
     * Изменить название линии
     *
     * @param LineRepository $repository
     * @return Response
     */
    public function changeLineName(LineRepository $repository)
    {
        $data = $this->input;
        return $this->sendSuccess($repository->changeLineName($data));
    }

    /**
     * Получить статистику по пользователям
     *
     * @param UserRepository $repository
     * @return Response
     * @throws TBError
     */
    public function getStatistic(UserRepository $repository)
    {
        return $this->sendSuccess($repository->getAllUserData());
    }

    // -------------  LORE ITEM ----------------------------------------------------------------------------------------

    /**
     * Получить lore-записи
     *
     * @param LoreItemRepository $repository
     * @return Response
     */
    public function getLoreItems(LoreItemRepository $repository)
    {
        return $this->sendSuccess($repository->all());
    }

    /**
     * Добавить lore-запись
     *
     * @param LoreItemRepository $repository
     * @return Response
     */
    public function saveLoreItem(LoreItemRepository $repository)
    {
        return $this->sendSuccess($repository->save($this->input));
    }

    /**
     * Удалить lore-запись
     *
     * @param LoreItemRepository $repository
     * @param int $id
     * @return Response
     * @throws TBError
     */
    public function deleteLoreItem(LoreItemRepository $repository, $id)
    {
        return $this->sendSuccess($repository->delete($id));
    }

    // -------------  IMAGE --------------------------------------------------------------------------------------------

    /**
     * Сохранить изображение
     *
     * @param ImageRepository $repository
     * @return Response
     * @throws TBError
     */
    public function addImage(ImageRepository $repository)
    {
        $data = $this->input;
        return $this->sendSuccess($repository->save($data));
    }

    /**
     * Сохранить изображение
     *
     * @param ImageRepository $repository
     * @param int $id
     * @return Response
     * @throws TBError
     */
    public function deleteImage(ImageRepository $repository, $id)
    {
        return $this->sendSuccess($repository->delete($id));
    }

    // -------------  SERIES -------------------------------------------------------------------------------------------

    /**
     * Получить список серий
     *
     * @param SeriesRepository $repository
     * @return Response
     */
    public function getSeries(SeriesRepository $repository)
    {
        return $this->sendSuccess($repository->all());
    }
    
    /**
     * Сохранить серию
     *
     * @param SeriesRepository $repository
     * @return Response
     */
    public function saveSeries(SeriesRepository $repository)
    {
        return $this->sendSuccess($repository->save($this->input));
    }
    
    /**
     * Удалить серию
     *
     * @param SeriesRepository $repository
     * @param {integer} $id
     * @return Response
     * @throws TBError
     */
    public function deleteSeries(SeriesRepository $repository, $id)
    {
        return $this->sendSuccess($repository->delete($id));
    }
}
