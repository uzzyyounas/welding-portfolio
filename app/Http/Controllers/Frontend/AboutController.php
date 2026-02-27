<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Certificate;
use Illuminate\Routing\Controller;

class AboutController extends Controller
{
    public function index()
    {
        $certificates = Certificate::active()->get()->groupBy('category');

        $timeline = [
            ['year' => '2008', 'title' => 'Started Teaching Career', 'description' => 'Began as a Secondary School Teacher', 'icon' => 'bi-mortarboard'],
            ['year' => '2011', 'title' => 'Certified Teacher Trainer', 'description' => 'Received national certification for teacher training programs', 'icon' => 'bi-award'],
            ['year' => '2014', 'title' => 'Masters in Education', 'description' => 'Completed M.Ed from University of Education', 'icon' => 'bi-book'],
            ['year' => '2016', 'title' => 'Digital Learning Pioneer', 'description' => 'Launched first online teacher training program', 'icon' => 'bi-laptop'],
            ['year' => '2018', 'title' => 'Motivational Speaking', 'description' => 'Started professional speaking engagements nationally', 'icon' => 'bi-mic'],
            ['year' => '2020', 'title' => 'Doctoral Studies', 'description' => 'PhD in Educational Leadership & Technology', 'icon' => 'bi-star'],
            ['year' => '2023', 'title' => 'International Recognition', 'description' => 'Recognized as Top 50 Educationists in South Asia', 'icon' => 'bi-globe'],
        ];

        $education = [
            ['degree' => 'PhD Educational Leadership', 'institution' => 'University of Education, Lahore', 'year' => '2023', 'grade' => 'Distinction'],
            ['degree' => 'M.Ed (Educational Technology)', 'institution' => 'Allama Iqbal Open University', 'year' => '2014', 'grade' => 'First Class'],
            ['degree' => 'B.Ed (Hons)', 'institution' => 'University of Punjab', 'year' => '2008', 'grade' => 'First Class'],
        ];

        return view('frontend.about.index', compact('certificates', 'timeline', 'education'));
    }
}
