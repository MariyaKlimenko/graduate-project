<?php
/**
 * Created by PhpStorm.
 * User: mermaid
 * Date: 16.03.18
 * Time: 21:07
 */

namespace App\Services;

use App\Models\Role;
use App\Repositories\EducationRepository;
use App\Repositories\ExperienceRepository;
use App\Repositories\InfoRepository;
use App\Repositories\LabelRepository;
use App\Repositories\ProjectRepository;
use App\Repositories\UserRepository;
use Illuminate\Database\DatabaseManager;
use Exception;

class UserService
{
    protected $databaseManager;
    protected $userRepository;
    protected $infoRepository;
    protected $educationRepository;
    protected $experienceRepository;
    protected $projectRepository;
    protected $labelRepository;

    /**
     * UserService constructor.
     * @param DatabaseManager $databaseManager
     * @param UserRepository $userRepository
     * @param InfoRepository $infoRepository
     * @param EducationRepository $educationRepository
     * @param ExperienceRepository $experienceRepository
     * @param ProjectRepository $projectRepository
     * @param LabelRepository $labelRepository
     */
    public function __construct(
        DatabaseManager $databaseManager,
        UserRepository $userRepository,
        InfoRepository $infoRepository,
        EducationRepository $educationRepository,
        ExperienceRepository $experienceRepository,
        ProjectRepository $projectRepository,
        LabelRepository $labelRepository
    ) {
        $this->databaseManager = $databaseManager;
        $this->userRepository = $userRepository;
        $this->infoRepository = $infoRepository;
        $this->educationRepository = $educationRepository;
        $this->experienceRepository = $experienceRepository;
        $this->projectRepository = $projectRepository;
        $this->labelRepository = $labelRepository;
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
                foreach ($data['education'] as $itemEducation) {
                    $education = $this->educationRepository->store($itemEducation);
                    throw_unless(
                        $user->education()->save($education),
                        new Exception('Education was not stored')
                    );
                }
            }

            if (isset($data['experience'])) {
                foreach ($data['experience'] as $itemExperience) {
                    $experience = $this->experienceRepository->store($itemExperience);
                    throw_unless(
                        $user->experiences()->save($experience),
                        new Exception('Experience was not stored')
                    );
                }
            }

            if (isset($data['project'])) {
                foreach ($data['project'] as $itemProject) {
                    $itemProject['jira_id'] = 'none';
                    $project = $this->projectRepository->store($itemProject);
                    if (isset($itemProject['labels'])) {
                        foreach ($itemProject['labels'] as $labelData) {
                            $label = $this->labelRepository->store($labelData);
                            throw_unless(
                                $project->labels()->save($label),
                                new Exception('Label was not stored')
                            );
                        }
                    }

                    throw_unless(
                        $user->projects()->save($project),
                        new Exception('Project was not stored')
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
