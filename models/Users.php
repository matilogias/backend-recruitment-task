<?php
class Users extends AgregatorModelBase
{
    private $usersPath = "dataset/users.json";

    public $page = null;
    public $pageSize = null;
    public $totalPages = null;
    public $totalRecords = null;

    

    protected $nestedAliases = [
        'id' => 'id',
        'name' => 'name',
        'username' => 'username',
        'email' => 'email',
        'street' => 'address.street',
        'suite' => 'address.suite',
        'city' => 'address.city',
        'zipcode' => 'address.zipcode',
        'lat' => 'address.geo.lat',
        'lng' => 'address.geo.lng',
        'phone' => 'phone',
        'website' => 'website',
        'companyName' => 'company.name',
        'catchPhrase' => 'company.catchPhrase',
        'bs' => 'company.bs'
    ];
    /**
     * constructor
     */
    public function __construct()
    {
        $users = $this->importUsers();
        foreach ($users as $user) {
            $this->data[] = new User($user);
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

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->data);
    }

    /**
     * get user by id
     * @param int $id
     * @return User
     */
    public function getUserById(int $id): User
    {
        foreach ($this->data as $user) {
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
        foreach ($this->data as $key => $user) {
            if ($user->id === $id) {
                unset($this->data[$key]);
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
        foreach ($this->data as $key => $user) {
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
    public function toArray(): array
    {
        $users = [];
        foreach ($this->data as $user) {
            $users[] = $user->toArray();
        }
        return $users;
    }

    /**
     * save users
     */
    public function saveUsers()
    {
        $users = json_encode($this->toArray());
        file_put_contents($this->usersPath, $users);
    }

    /**
     * getUniqueId
     * @return int
     */
    public function getUniqueId(): int
    {
        $ids = [];
        foreach ($this->data as $user) {
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
        } else {
            foreach ($this->data as $iterUser) {
                if ($user->id === $iterUser->id) {
                    return false;
                }
            }
        }

        $this->data[] = $user;
        $this->saveUsers();
    }

    /**
     * loadRequestData
     */
    protected static function loadRequestData($request = 'post')
    {
        $userArray = array(
            'id' => request('id', $request),
            'name' => request('name', $request),
            'username' => request('username', $request),
            'email' => request('email', $request),
            'address' => array(
                'street' => request('street', $request),
                'suite' => request('suite', $request),
                'city' => request('city', $request),
                'zipcode' => request('zipcode', $request),
                'geo' => array(
                    'lat' => request('lat', $request),
                    'lng' => request('lng', $request)
                )
            ),
            'phone' => request('phone', $request),
            'website' => request('website', $request),
            'company' => array(
                'name' => request('companyName', $request),
                'catchPhrase' => request('catchPhrase', $request),
                'bs' => request('bs', $request)
            )
        );
        return $userArray;
    }

   

    /**
     * loadPostData
     */
    public static function loadPostData()
    {
        return self::loadRequestData('post');
    }

    /**
     * loadGetData
     */
    public static function loadGetData()
    {
        return self::loadRequestData('get');
    }

    
}
