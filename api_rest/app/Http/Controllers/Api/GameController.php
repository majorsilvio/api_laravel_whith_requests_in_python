<?php
namespace App\Http\Controllers\Api;
use App\API\ApiError;
use App\Game;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class GameController extends Controller
{
	/**
	 * @var Game
	 */
	private $game;
	public function __construct(Game $game)
	{
		$this->game = $game;
	}
	public function index()
    {
    	sleep(2);
    	return response()->json($this->game->paginate(10));
    }
    public function show($id)
    {
    	$game = $this->game->find($id);
    	if(! $game) return response()->json(['data' => ['msg' => 'Jogo não encontrado!']], 404);
    	$data = ['data' => $game];
	    return response()->json($data);
    }
    public function store(Request $request)
    {
		try {
			$gameData = $request->all();
			$this->game->create($gameData);
			$return = ['data' => ['msg' => 'Jogo criado com sucesso!']];
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
			$gameData = $request->all();
			$game     = $this->game->find($id);
			$game->update($gameData);
			$return = ['data' => ['msg' => 'Jogo atualizado com sucesso!']];
			return response()->json($return, 201);
		} catch (\Exception $e) {
			if(config('app.debug')) {
				return response()->json(ApiError::errorMessage($e->getMessage(), 1011));
			}
			return response()->json(ApiError::errorMessage('Houve um erro ao realizar operação de atualizar', 1011));
		}
	}
	public function delete(Game $id)
	{
		try {
			$id->delete();
			return response()->json(['data' => ['msg' => 'Jogo: ' . $id->name . ' removido com sucesso!']], 200);
		}catch (\Exception $e) {
			if(config('app.debug')) {
				return response()->json(ApiError::errorMessage($e->getMessage(), 1012));
			}
			return response()->json(ApiError::errorMessage('Houve um erro ao realizar operação de remover', 1012));
		}
	}

	public function drop()
	{
		try {
			$product = $this->game->get();
        foreach($product as $item){
            $teste = $product->find($item['id']);
            $teste->delete();
        }
			return response()->json(['data' => ['msg' => 'Jogo: ' . $id->name . ' removido com sucesso!']], 200);
		}catch (\Exception $e) {
			if(config('app.debug')) {
				return response()->json(ApiError::errorMessage($e->getMessage(), 1012));
			}
			return response()->json(ApiError::errorMessage('Houve um erro ao realizar operação de remover', 1012));
		}
	}
}