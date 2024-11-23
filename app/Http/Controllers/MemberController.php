<?php

namespace App\Http\Controllers;

use App\Models\MemberModel;
use Illuminate\Http\Request;

class MemberController extends Controller
{

    // function to create members
    public function create(){
        $name = "";
        $email = "";
        $phone = "";

        // check whether all data has been filled
        if(isset($_POST['name'])){
            $name = $_POST['name'];
        }
        if(isset($_POST['email'])){
            $email = $_POST['email'];
        }
        if(isset($_POST['phone_number'])){
            $phone = $_POST['phone_number'];
        }

        // make new member
        $member = new MemberModel();
        $member->name = $name;
        $member->email = $email;
        $member->phone_number = $phone;
        $member->save();

        return redirect('members');
    }

    // function to read member
    public function view(){
        $member = MemberModel::all();
        return view('members',[
            'members' => $member
        ]);
    }

    // function to update member
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

            // update old data to new data
            $member->name = $name;
            $member->email = $email;
            $member->phone_number = $phone;
            $member->save();

            return redirect('members');
        }
    }

    // function to delete member
    public function delete(){
        $member = MemberModel::find($_POST['member_id']);

        $member->delete();

        return redirect('members')->with('success', 'Member has been deleted successfully!');
    }
}