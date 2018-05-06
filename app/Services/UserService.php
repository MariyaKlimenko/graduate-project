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
use App\Repositories\EducationRepository;
use App\Repositories\InfoRepository;
use App\Repositories\UserRepository;
use Illuminate\Database\DatabaseManager;
use Exception;

class UserService
{
    protected $databaseManager;
    protected $userRepository;
    protected $infoRepository;
    protected $educationRepository;


    /**
     * UserService constructor.
     * @param DatabaseManager $databaseManager
     * @param UserRepository $userRepository
     * @param InfoRepository $infoRepository
     * @param EducationRepository $educationRepository
     */
    public function __construct(
        DatabaseManager $databaseManager,
        UserRepository $userRepository,
        InfoRepository $infoRepository,
        EducationRepository $educationRepository
    ) {
        $this->databaseManager = $databaseManager;
        $this->userRepository = $userRepository;
        $this->infoRepository = $infoRepository;
        $this->educationRepository = $educationRepository;
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

            if (isset($data['education'])) {
                foreach ($data['education'] as $item) {
                    $education = $this->educationRepository->store($item);
                    throw_unless(
                        $user->education()->save($education),
                        new Exception('Education was not stored')
                    );
                }
            }

        } catch (Exception $exception) {
            $this->databaseManager->rollBack();
            return false;
        }
        $this->databaseManager->commit();
        return $user;
    }

    /**
     * Updating user's general info.
     *
     * @param array $data
     * @return bool|mixed
     * @throws Exception
     * @throws \Throwable
     */
    public function update(array $data)
    {
        $this->databaseManager->beginTransaction();

        try {
            $user = $this->userRepository->find($data['id']);

            throw_unless($user, new Exception('User not found.'));

            $user->fill($data);

            $user->info->fill($data);

            throw_unless($user->push(), new Exception('Profile was not stored'));



        } catch (Exception $exception) {
            $this->databaseManager->rollBack();
            return false;
        }
        $this->databaseManager->commit();
        return $user;
    }

    /**
     * Deletes user.
     *
     * @param $userId
     * @return bool|string
     * @throws Exception
     * @throws \Throwable
     */
    public function delete($userId)
    {
        $this->databaseManager->beginTransaction();

        try {
            $user = $this->userRepository->find($userId);

            throw_unless($user->delete(), new Exception('User is not deleted.'));
        } catch (Exception $exception) {
            $this->databaseManager->rollBack();
            return false;
        }
        $this->databaseManager->commit();
        return 'ok';
    }

}
