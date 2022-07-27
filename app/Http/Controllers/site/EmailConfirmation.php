<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class EmailConfirmation extends Controller
{
    public function verifyEmail($id){
        $toSave=User::find($id);
        $toSave->flag=1;
        $toSave->save();
        return view('site.account.redirect-user-page');
    }
}
