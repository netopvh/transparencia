<?php

namespace App\Repositories\Backend\Application;

use App\Exceptions\Access\GeneralException;
use App\Models\Cidade;
use App\Models\Infraestrutura;
use App\Models\InfraestruturaAtuacao;
use App\Repositories\Backend\Application\Contracts\InfraestruturaRepository;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use GuzzleHttp\Client as GuzzHttpClient;

/**
 * Class BackendApplicationCasaRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class InfraestruturaRepositoryEloquent extends BaseRepository implements InfraestruturaRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Infraestrutura::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getAll($perPage)
    {
        return $this->model->newQuery()->with('atuacoes')
            ->join('casas', 'casas.id', '=', 'infraestruturas.codigo_entidade')
            ->select(
                'infraestruturas.id',
                'infraestruturas.unidade',
                'infraestruturas.cidade',
                'casas.name AS casa',
                'infraestruturas.nome_categoria',
                'infraestruturas.codigo_atuacao',
                'infraestruturas.nome_atuacao'
            )
            ->paginate($perPage);
    }

    /**
     * @param $attributes
     */
    public function import($attributes)
    {
        $this->cleanRegisters($attributes);

        $client = new GuzzHttpClient();
        $apiRequest = $client->request('GET', 'http://ws.sistemaindustria.org.br/api-basi/v1/transparencia/entidades/' . $attributes['casa'] . '/categoriaAtivoRegioes/' . $attributes['categoria'] . '/estados/ro/unidades');
        $registers = json_decode($apiRequest->getBody()->getContents());


        foreach ($registers as $register) {
            $model = $this->makeModel();
            $model->id = $register->id;
            $model->unidade = $register->nomeUnidade;
            $model->endereco = $register->nomeRua . ',' . $register->numeroEndereco;
            $model->bairro = $register->nomeBairro;
            $model->cidade = $register->nomeCidade;
            $model->cep = $register->cep;
            $model->telefone = $register->telefone;
            $model->codigo_categoria = $register->codigoCategoria;
            $model->nome_categoria = $register->nomeCategoria;
            $model->codigo_entidade = ($register->codigoEntidade == 2 ? 1 : 2);
            $model->codigo_atuacao = $register->codigoAtuacao;
            $model->nome_atuacao = $register->nomeAtuacao;
            if ($register->codigoAtuacao == 0) {
                foreach ($register->atuacoes as $atuacao) {
                    $infraAtua = new InfraestruturaAtuacao();
                    $infraAtua->infraestrutura_id = $model->id;
                    $infraAtua->codigo_entidade = $model->codigo_entidade;
                    $infraAtua->codigo_atuacao = $atuacao->codigoAtuacao;
                    $infraAtua->nome_atuacao = $atuacao->nomeAtuacao;
                    $infraAtua->save();
                }
            }
            $model->save();

        }
    }

    /**
     * @param $attributes
     */
    private function cleanRegisters($attributes)
    {
        $casa = $attributes['casa'] == 2 ? 1 : 2;

        $this->model->newQuery()
            ->where('codigo_entidade', $casa)
            ->where('codigo_categoria', $attributes['categoria'])
            ->delete();
    }

    /**
     * @param $casa
     * @param $categoria
     * @return int
     */
    public function getAllCasa($casa, $categoria)
    {
        return $this->model->newQuery()
            ->where('codigo_entidade', getCasaId($casa))
            ->where('codigo_categoria', $categoria)
            ->get()->count();
    }

    /**
     * @param $casa
     * @param $atuacao
     * @return int
     */
    public function getAllCasaAtuacao($casa, $atuacao)
    {
        $all = $this->model->newQuery()
            ->where('codigo_entidade', getCasaId($casa))
            ->where('codigo_categoria', 1)
            ->where('nome_atuacao', 'LIKE', '%' . $atuacao . '%')
            ->get()->count();

        $dependencia = $this->model->newQuery()
            ->join('infraestrutura_atuacao','infraestruturas.id','=','infraestrutura_atuacao.infraestrutura_id')
            ->where('infraestrutura_atuacao.codigo_entidade',getCasaId($casa))
            ->where('infraestrutura_atuacao.nome_atuacao','LIKE', '%' . $atuacao . '%')
            ->get()
        ->count();

        return $all + $dependencia;

    }

    public function getByAtuacao($casa, $atuacao, $categoria)
    {

        $all = $this->model->newQuery()
            ->where('codigo_entidade',$casa)
            ->where('nome_atuacao',$atuacao)
            ->where('codigo_categoria', $categoria)
            ->get()->toArray();

        $dependencia = $this->model->newQuery()
            ->join('infraestrutura_atuacao','infraestruturas.id','=','infraestrutura_atuacao.infraestrutura_id')
            ->where('infraestrutura_atuacao.codigo_entidade',$casa)
            ->where('infraestrutura_atuacao.nome_atuacao','LIKE', '%' . $atuacao . '%')
            ->get()->toArray();


        $arrayData = array_collapse([$all, $dependencia]);


        return $arrayData;

    }

}
