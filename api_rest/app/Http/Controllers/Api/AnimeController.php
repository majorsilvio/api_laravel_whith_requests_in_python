<?php
namespace App\Http\Controllers\Api;
use App\API\ApiError;
use App\AnimeController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class AnimeController extends Controller
{
	/**
	 * @var Anime
	 */
	private $anime;
	public function __construct(Anime $anime)
	{
		$this->anime = $anime;
	}
	public function index()
    {
    	return response()->json($this->anime->paginate(10));
    }
    public function show($id)
    {
    	$anime = $this->anime->find($id);
    	if(! $anime) return response()->json(['data' => ['msg' => 'Anime não encontrado!']], 404);
    	$data = ['data' => $anime];
	    return response()->json($data);
    }
    public function store(Request $request)
    {
		try {
			$animeData = $request->all();
			$this->anime->create($animeData);
			$return = ['data' => ['msg' => 'Anime criado com sucesso!']];
			return response()->json($return, 201);
		} catch (\Exception $e) {
			if(config('app.debug')) {
				return response()->json(ApiError::errorMessage($e->getMessage(), 1010));
			}
			return response()->json(ApiError::errorMessage('Houve um erro ao realizar operação de salvar', 1010));
		}
    }
	public function update(Request $request, $id)
	{
		try {
			$animeData = $request->all();
			$anime     = $this->anime->find($id);
			$anime->update($animeData);
			$return = ['data' => ['msg' => 'Anime atualizado com sucesso!']];
			return response()->json($return, 201);
		} catch (\Exception $e) {
			if(config('app.debug')) {
				return response()->json(ApiError::errorMessage($e->getMessage(), 1011));
			}
			return response()->json(ApiError::errorMessage('Houve um erro ao realizar operação de atualizar', 1011));
		}
	}
	public function delete(Anime $id)
	{
		try {
			$id->delete();
			return response()->json(['data' => ['msg' => 'Anime: ' . $id->name . ' removido com sucesso!']], 200);
		}catch (\Exception $e) {
			if(config('app.debug')) {
				return response()->json(ApiError::errorMessage($e->getMessage(), 1012));
			}
			return response()->json(ApiError::errorMessage('Houve um erro ao realizar operação de remover', 1012));
		}
	}
}