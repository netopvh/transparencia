<?php

namespace App\Repositories\Backend\Application;

use App\Models\Infraestrutura;
use App\Models\InfraestruturaAtuacao;
use App\Repositories\Backend\Application\Contracts\InfraestruturaRepository;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use GuzzleHttp\Client as GuzzHttpClient;
use Illuminate\Container\Container as Application;

/**
 * Class BackendApplicationCasaRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class InfraestruturaRepositoryEloquent extends BaseRepository implements InfraestruturaRepository
{

    private $atuacao;

    public function __construct(Application $app, InfraestruturaAtuacao $atuacao)
    {
        parent::__construct($app);
        $this->atuacao = $atuacao;
    }

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

        $client = new GuzzHttpClient();
        $apiRequest = $client->request('GET', 'http://ws.sistemaindustria.org.br/api-basi/v1/transparencia/entidades/' . $attributes['casa'] . '/categoriaAtivoRegioes/' . $attributes['categoria'] . '/estados/ro/unidades');
        $registers = json_decode($apiRequest->getBody()->getContents());

        $this->cleanRegisters($attributes, $registers);

        foreach ($registers as $register) {
            $infra = $this->model->newInstance([
                'id' => $register->id,
                'unidade' => $register->nomeUnidade,
                'endereco' => $register->nomeRua . ',' . $register->numeroEndereco,
                'bairro' => $register->nomeBairro,
                'cidade' => $register->nomeCidade,
                'cep' => $register->cep,
                'telefone' => $register->telefone,
                'codigo_categoria' => $register->codigoCategoria,
                'nome_categoria' => $register->nomeCategoria,
                'codigo_entidade' => ($register->codigoEntidade == 2 ? 1 : 2),
                'codigo_atuacao' => $register->codigoAtuacao,
                'nome_atuacao' => $register->nomeAtuacao
            ]);
            if ($register->codigoAtuacao == 0) {
                foreach ($register->atuacoes as $atuacao) {
                    $infraAtua = $this->atuacao->newInstance([
                        'infraestrutura_id' => $infra->id,
                        'codigo_entidade' => $infra->codigo_entidade,
                        'codigo_atuacao' => $atuacao->codigoAtuacao,
                        'nome_atuacao' => $atuacao->nomeAtuacao
                    ]);
                    $infraAtua->save();
                }
            }
            $infra->save();

        }
    }

    /**
     * @param $attributes
     */
    private function cleanRegisters($attributes,$api)
    {
        $casa = $attributes['casa'] == 2 ? 1 : 2;

        $itens =[];
        foreach ($api as $item) {
            $itens[] = $item->id;
        }

        $this->model->newQuery()->where('codigo_entidade', $casa)->where('codigo_categoria', $attributes['categoria'])->delete();

        $this->atuacao->newQuery()->where('codigo_entidade',$casa)->whereIn('infraestrutura_id',$itens)->delete();
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
            ->join('infraestrutura_atuacao', 'infraestruturas.id', '=', 'infraestrutura_atuacao.infraestrutura_id')
            ->where('infraestrutura_atuacao.codigo_entidade', getCasaId($casa))
            ->where('infraestrutura_atuacao.nome_atuacao', 'LIKE', '%' . $atuacao . '%')
            ->get()
            ->count();

        return $all + $dependencia;

    }

    public function getByAtuacao($casa, $atuacao, $categoria)
    {

        $all = $this->model->newQuery()
            ->where('codigo_entidade', $casa)
            ->where('nome_atuacao', $atuacao)
            ->where('codigo_categoria', $categoria)
            ->get()->toArray();

        $dependencia = $this->model->newQuery()
            ->join('infraestrutura_atuacao', 'infraestruturas.id', '=', 'infraestrutura_atuacao.infraestrutura_id')
            ->where('infraestrutura_atuacao.codigo_entidade', $casa)
            ->where('infraestrutura_atuacao.nome_atuacao', 'LIKE', '%' . $atuacao . '%')
            ->get()->toArray();


        $arrayData = array_collapse([$all, $dependencia]);


        return $arrayData;

    }

}
