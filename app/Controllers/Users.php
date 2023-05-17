<?php

namespace App\Controllers;

use App\Models\ModelUser;
use \Myth\Auth\Entities\User;
use \Myth\Auth\Password;

class Users extends BaseController
{
    protected $auth, $config, $users, $user, $groups;
    public function __construct()
    {
        $this->auth  = service('authentication');
        $this->config = config('Auth');
        $this->user = new ModelUser();
        $this->users = new \Myth\Auth\Models\UserModel();
        $this->groups = new \Myth\Auth\Authorization\GroupModel;
    }

    public function index()
    {
        return view('users/users');
    }

    public function getData()
    {
        if ($this->request->isAJAX()) {
            $this->users->select('users.id as user_id, user_img, username, email, name as role');
            $this->users->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
            $this->users->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
            $data['users'] = $this->users->findAll();
            $msg = [
                'data' => view('users/view_data', $data)
            ];

            echo json_encode($msg);
        }
    }

    public function create()
    {
        $data['config'] = $this->config;
        return view('Auth/register', $data);
    }

    public function save()
    {
        $users = model(UserModel::class);

        $rules = [
            'username' => 'required|alpha_numeric_space|min_length[3]|max_length[30]|is_unique[users.username]',
            'email'    => 'required|valid_email|is_unique[users.email]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $rules = [
            'password'     => 'required|strong_password',
            'pass_confirm' => 'required|matches[password]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $allowedPostFields = array_merge(['password'], $this->config->validFields, $this->config->personalFields);
        $user = new User($this->request->getPost($allowedPostFields));

        $this->config->requireActivation === null ? $user->activate() : $user->generateActivateHash();

        if (!empty($this->config->defaultUserGroup)) {
            $users = $users->withGroup($this->config->defaultUserGroup);
        }

        if (!$users->save($user)) {
            return redirect()->back()->withInput()->with('errors', $users->errors());
        }

        if ($this->config->requireActivation !== null) {
            $activator = service('activator');
            $sent = $activator->send($user);

            if (!$sent) {
                return redirect()->back()->withInput()->with('error', $activator->error() ?? lang('Auth.unknownError'));
            }

            return redirect()->back()->with('message', lang('Auth.activationSuccess'));
        }

        return redirect()->back()->with('message', lang('Auth.registerSuccess'));
    }

    public function group_form()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            $this->users->select('users.id as user_id, user_img, username, email, name as role, group_id');
            $this->users->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
            $this->users->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
            $data = [
                'user'  => $this->users->find($id),
                'groups' => $this->groups->findAll(),
            ];
            $msg = [
                'data' => view('users/group_modal', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function setGroup()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $groupId = $this->request->getVar('group');

            $this->groups->removeUserFromAllGroups($id);
            $this->groups->addUserToGroup($id, $groupId);

            $msg = [
                'success' => 'Role users berhasil diperbarui',
            ];
            echo json_encode($msg);
        }
    }

    public function password_form()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            $data = [
                'user'  => $this->users->find($id),
            ];
            $msg = [
                'data' => view('users/password_modal', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function setPassword()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $rules = [
                'password'     => 'required|strong_password',
                'pass_confirm' => 'required|matches[password]',
            ];

            if (!$this->validate($rules)) {
                $msg = [
                    'errors' => [
                        'password' => $this->validator->getError('password'),
                        'pass_confirm' => $this->validator->getError('pass_confirm'),
                    ]
                ];
            } else {
                $data = [
                    'password_hash' => Password::hash($this->request->getVar('password')),
                    'reset_hash' => null,
                    'reset_at' => null,
                    'reset_expires' => null,
                ];
                $this->users->update($id, $data);

                $msg = [
                    'success' => 'Password berhasil diperbarui'
                ];
            }
            echo json_encode($msg);
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $user = $this->users->find($id);
            if ($user->user_img != 'default.png') {
                unlink('assets/images/users/' . $user->user_img);
            }
            $this->groups->removeUserFromAllGroups($id);
            $this->users->delete($id);

            $msg = [
                'success' => true
            ];
            echo json_encode($msg);
        }
    }

    public function profile()
    {
        $id = user()->id;
        $this->users->select('users.id as user_id, user_img, username, email, name as role, group_id');
        $this->users->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->users->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $data = [
            'profile' => $this->users->find($id),
        ];
        return view('users/profile', $data);
    }

    public function update($id)
    {
        $rules = [
            'user_img' => 'max_size[user_img,2048]|is_image[user_img]|mime_in[user_img,image/jpg,image/png]',
            'username' => 'required',
            'email'    => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        $fileImg = $this->request->getFile('user_img');
        $oldImg = $this->request->getVar('oldImg');
        if ($fileImg->getError() == 4) {
            $nameImg = $oldImg;
        } else {
            $nameImg = $fileImg->getRandomName();
            $fileImg->move('assets/images/users', $nameImg);
            if ($oldImg != 'default.png') {
                unlink('assets/images/users/' . $oldImg);
            }
        }

        $data = [
            'email' => $this->request->getPost('email'),
            'username' => $this->request->getPost('username'),
            'user_img' => $nameImg,
        ];
        $this->user->update($id, $data);

        return redirect()->back()->with('message', 'User updated successfully');
    }
}
