<?php

namespace App\Http\Livewire\StudentProfile\Profile;

use Livewire\Component;
use App\Models\StudentWishlist;
use App\Models\Student;
use App\Models\InstituteContact;
use App\Models\InstituteReview;

class DeleteProfile extends Component
{
    public function render()
    {
        return view('livewire.student-profile.profile.delete-profile');
    }


    public function deleteProfile(){

        $studentid = \Auth::guard('students')->user()->id;

        \Auth::guard('students')->logout();

        session()->invalidate();
        StudentWishlist::where('student_id',$studentid)->delete();
        Student::where('id',$studentid)->delete();
        // InstituteContact::where('student_id',$studentid)->delete();
        // InstituteReview::where('student_id',$studentid)->delete();


        return redirect()->route('homepage');

    }
}
