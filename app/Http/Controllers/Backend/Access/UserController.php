<?php
namespace App\Http\Controllers\Backend\Access;

use App\Exceptions\Access\GeneralException;
use App\Http\Controllers\Controller;
use App\Mail\Registration;
use App\Repositories\Backend\Access\Contracts\RoleRepository;
use App\Repositories\Backend\Access\Contracts\UserRepository;
use Illuminate\Http\Request;
use App\Contracts\Facades\ChannelLog as Log;
use Illuminate\Support\Facades\Mail;


class UserController extends Controller
{

    /**
     * Variável instancia do repositório
     *
     * @var $user
     */
    private $user;

    /**
     * Variável instancia do repositório
     *
     * @var $role
     */
    private $role;


    /**
     * RoleController constructor.
     * @param UserRepository $user
     */
    public function __construct(UserRepository $user, RoleRepository $role)
    {
        $this->middleware('auth');
        $this->user = $user;
        $this->role = $role;
    }

    /**
     * Método de exibição de dados principais
     *
     * @return mixed
     */
    public function index(Request $request)
    {
        if (($search = $request->get('search'))) {
            $data = $this->user->searchWithRoles('name', $search);
        } else {
            $data = $this->user->getAllWithRoles();
        }
        return view('backend.modules.access.users.index')
            ->withUsers($data);
    }

    /**
     * Criar novo registro
     *
     * @return mixed
     */
    public function create()
    {
        return view('backend.modules.access.users.create')
            ->withRoles($this->role->getAll());
    }

    /**
     * @param Request $request
     */
    public function store(Request $request)
    {
        try{

            if ($this->user->create($request->all())) {
                Log::write('event','Usuário '. $request->name .' foi criado por ' . auth()->user()->name);
                Mail::to($request->get('email'))->queue(new Registration($request->all()));
            }
            notify()->flash('Registro efetuado com sucesso!','success');
            return redirect()->route('admin.users.index');
        }catch (GeneralException $e){
            notify()->flash($e->getMessage(), 'danger');
            return redirect()->route('admin.users.index');
        }
    }

    /**
     * Método de alteração de registro
     *
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $user = $this->user->with('roles')->find($id);

        return view('backend.modules.access.users.edit')
            ->withUser($user)
            ->withRoles($this->role->all());
    }

    /**
     * Salva alterações no banco de dados
     *
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        try {
            if ($this->user->update($request->all(), $id)) {
                Log::write('event','Usuário '. $request->name .' foi alterado por ' . auth()->user()->name);
            }
            return redirect()->route('admin.users.index');
        } catch (GeneralException $e) {
            notify()->flash($e->getMessage(), 'danger');
            return redirect()->route('admin.users.index');
        }

    }

    public function viewChangePassword()
    {
        return view('backend.modules.access.users.password');
    }

    public function changePassword(Request $request)
    {
        try{

            if($this->user->changePassword($request->all())){
                Log::write('event','Usuário '. auth()->user()->name .' alterou a senha ');
            }
            notify()->flash('Senha alterada com sucesso! Saia do portal e acesse novamente','success');
            return redirect()->route('admin.users.password');

        }catch (GeneralException $e){
            notify()->flash($e->getMessage(),'danger');
            return redirect()->route('admin.users.password');
        }
    }

}