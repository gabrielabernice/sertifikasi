<?php

namespace App\Http\Controllers;

use App\Models\MemberModel;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function create(){
        $name = "";
        $email = "";
        $phone = "";

        if(isset($_POST['name'])){
            $name = $_POST['name'];
        }
        if(isset($_POST['email'])){
            $email = $_POST['email'];
        }
        if(isset($_POST['phone_number'])){
            $phone = $_POST['phone_number'];
        }

        $member = new MemberModel();
        $member->name = $name;
        $member->email = $email;
        $member->phone_number = $phone;
        $member->save();

        return redirect('members');
    }

    public function view(){
        $member = MemberModel::all();
        return view('members',[
            'members' => $member
        ]);
    }

    public function update(){
        $member = MemberModel::find($_POST['member_id']);

        if (!isset($_POST['name'])){
            return view('updateMember',[
                'member' => $member
            ]);
        }else{
            if(isset($_POST['name'])){
                $name = $_POST['name'];
            }
            if(isset($_POST['email'])){
                $email = $_POST['email'];
            }
            if(isset($_POST['phone_number'])){
                $phone = $_POST['phone_number'];
            }

            $member->name = $name;
            $member->email = $email;
            $member->phone_number = $phone;
            $member->save();

            return redirect('members');
        }
    }

    public function delete(){
        $member = MemberModel::find($_POST['member_id']);

        $member->delete();

        return redirect('members')->with('success', 'Member has been deleted successfully!');
    }
}
