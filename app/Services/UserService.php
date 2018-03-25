<?php
/**
 * Created by PhpStorm.
 * User: mermaid
 * Date: 16.03.18
 * Time: 21:07
 */

namespace App\Services;

use App\Http\Requests\StoreUserRequest;
use App\Models\Info;
use App\Models\Role;
use App\Models\User;
use App\Repositories\InfoRepository;
use App\Repositories\UserRepository;
use Illuminate\Database\DatabaseManager;
use Exception;

class UserService
{
    protected $databaseManager;
    protected $userRepository;
    protected $infoRepository;

    /**
     * UserService constructor.
     * @param DatabaseManager $databaseManager
     * @param UserRepository $userRepository
     * @param InfoRepository $infoRepository
     */
    public function __construct(
        DatabaseManager $databaseManager,
        UserRepository $userRepository,
        InfoRepository $infoRepository
    ) {
        $this->databaseManager = $databaseManager;
        $this->userRepository = $userRepository;
        $this->infoRepository = $infoRepository;
    }

    /**
     * Storing user, info and attaching role using transaction.
     *
     * @param array $data
     * @return bool|mixed
     * @throws Exception
     * @throws \Throwable
     */
    public function store(array $data)
    {
        $this->databaseManager->beginTransaction();

        try {
            $user = $this->userRepository->create($data);

            $info = $user->info()->firstOrNew([]);

            $info->fill($data);

            throw_unless($info->save(), new Exception('Profile was not stored'));

            $role = Role::where('name', $data['role'])->first();

            throw_unless($role, new Exception());

            $user->attachRole($role);

        } catch (Exception $exception) {
            $this->databaseManager->rollBack();
            return false;
        }
        $this->databaseManager->commit();
        return $user;
    }

    public function all()
    {
        return $this->userRepository->all();
    }

    /**
     * Returns user by id.
     *
     * @param int $id
     * @return mixed
     */
    public function find(int $id)
    {
        return $this->userRepository->find($id);
    }
}
