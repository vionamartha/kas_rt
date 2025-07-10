<?php  
namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        return view('auth/login');
    }

    public function doLogin()
    {
        $model = new UserModel();
        $user = $model->where('username', $this->request->getPost('username'))->first();

        if ($user && password_verify($this->request->getPost('password'), $user['password'])) {
            // Set session untuk menandakan user sudah login
            session()->set('logged_in', true);

            // Set session untuk username
            session()->set('username', $user['username']); // Menyimpan username di session

            session()->set('popupShown', false); 

            return redirect()->to('/dashboard');
        }

        return redirect()->back()->with('error', 'Login gagal');
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to('/login')->with('clear_popup', true); 
    }
}
