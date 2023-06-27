<?php
class Users implements IteratorAggregate {
    public $users = [];
    private $usersPath = "dataset/users.json";
    /**
     * constructor
     */
    public function __construct()
    {
        $users = $this->importUsers();
        foreach ($users as $user) {
            $this->users[] = new User($user);
        }
    }

    /**
     * import users from json file
     */
    private function importUsers()
    {
        $users = file_get_contents($this->usersPath);
        return json_decode($users);
    }

    public function getIterator() : ArrayIterator
    {
        return new ArrayIterator($this->users);
    }

    /**
     * get user by id
     * @param int $id
     * @return User
     */
    public function getUserById(int $id) : User
    {
        foreach ($this->users as $user) {
            if ($user->id === $id) {
                return $user;
            }
        }
        throw new Exception("User with id $id does not exist");
    }

    /**
     * delete user by id
     * @param int $id
     */
    public function deleteUser(int $id)
    {
        $result = false;
        foreach ($this->users as $key => $user) {
            if ($user->id === $id) {
                unset($this->users[$key]);
                $result = true;
            }
        }
        $this->saveUsers();
        return $result;
    }

    /**
     * update user by id
     * @param int $id
     * @param array $data
     */
    public function updateUser(int $id, array $data)
    {
        $result = false;
        foreach ($this->users as $key => $user) {
            if ($user->id === $id) {
                $users[$key] = $data;
                $result = true;
            }
        }
        $this->saveUsers();
        return $result;
    }

    /**
     * toArray method
     * @return array
     */
    public function toArray() : array
    {
        $users = [];
        foreach ($this->users as $user) {
            $users[] = $user->toArray();
        }
        return $users;
    }

    /**
     * save users
     */
    public function saveUsers() {
        $users = json_encode($this->toArray());
        file_put_contents($this->usersPath, $users);
    }

    /**
     * getUniqueId
     * @return int
     */
    public function getUniqueId() : int
    {
        $ids = [];
        foreach ($this->users as $user) {
            $ids[] = $user->id;
        }
        return max($ids) + 1;
    }

    /**
     * addUser
     * @param array $data
     */
    public function addUser(User $user)
    {
        //if id = null, generate new id
        if ($user->id === null) {
            $user->id = $this->getUniqueId();
        }else {
            foreach ($this->users as $iterUser) {
                if ($user->id === $iterUser->id) {
                    return false;
                }
            }
        }

        $this->users[] = $user;
        $this->saveUsers();
    }
}