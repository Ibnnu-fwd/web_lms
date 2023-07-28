<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\UserInterface;
use App\Interfaces\VerificatorInterface;
use Illuminate\Http\Request;

class VerificatorController extends Controller
{
    private $verificator;
    private $user;

    public function __construct(VerificatorInterface $verificator, UserInterface $user) {
        $this->verificator = $verificator;
        $this->user        = $user;
    }

    public function index()
    {
        return view('admin.verificator.index', [
            'verificators' => $this->verificator->getAll()
        ]);
    }

    public function create()
    {
        return view('admin.verificator.create', [
            'users' => $this->user->getAll()
        ]);
    }
}
