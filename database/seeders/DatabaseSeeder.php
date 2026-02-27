<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Post;
use App\Models\Service;
use App\Models\Event;
use App\Models\Testimonial;
use App\Models\Certificate;
use App\Models\Gallery;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin User
        $user = User::updateOrCreate(
            ['email' => 'admin@portfolio.com'],
            [
                'name'     => 'Usman Younas',
                'email'    => 'admin@admin.com',
                'password' => Hash::make('admin'),
                'email_verified_at' => now(),
            ]
        );

        // Categories
        $categories = [
            ['name' => 'Teacher Training', 'description' => 'Articles about professional development for teachers'],
            ['name' => 'Digital Learning', 'description' => 'EdTech, e-learning, and digital classroom strategies'],
            ['name' => 'Motivation & Mindset', 'description' => 'Inspirational content for educators and learners'],
            ['name' => 'Curriculum Design', 'description' => 'Lesson planning, curriculum frameworks, and design'],
            ['name' => 'Leadership in Education', 'description' => 'Educational leadership and institutional management'],
        ];
        foreach ($categories as $cat) {
            Category::firstOrCreate(['name' => $cat['name']], $cat);
        }

        // Tags
        $tagNames = ['Education', 'Teaching', 'Learning', 'Pakistan', 'Professional Development', 'EdTech', 'Classroom', 'Motivation', 'Curriculum', 'Leadership', 'Training', 'Workshop'];
        foreach ($tagNames as $tag) {
            Tag::firstOrCreate(['name' => $tag]);
        }

        // Services
        $services = [
            [
                'title'   => 'Teacher Training Programs',
                'icon'    => 'bi-mortarboard-fill',
                'excerpt' => 'Comprehensive professional development programs that transform teaching practices and enhance student outcomes.',
                'description' => '<h3>About This Service</h3><p>Our teacher training programs are meticulously designed to equip educators with cutting-edge pedagogical strategies, classroom management techniques, and technology integration skills. We offer both in-person and online formats.</p><h3>What You Get</h3><p>Each participant receives personalized coaching, resource materials, and ongoing mentorship support. Our programs are aligned with national curriculum standards and international best practices.</p>',
                'features'    => ['Evidence-based methodologies', 'Hands-on practice sessions', 'Peer learning communities', 'Certificate of completion', 'Post-training support'],
                'deliverables' => ['Training manual & resources', 'Video recordings', 'Assessment tools', 'Follow-up coaching sessions'],
                'sort_order'  => 1,
            ],
            [
                'title'   => 'Motivational Speaking',
                'icon'    => 'bi-mic-fill',
                'excerpt' => 'Inspiring keynotes and talks that motivate individuals and organizations to unlock their full potential.',
                'description' => '<h3>About This Service</h3><p>Awais Iqbal Ch delivers powerful motivational talks for schools, universities, corporate organizations, and national conferences. Her talks blend personal stories, research insights, and actionable strategies.</p><h3>Popular Topics</h3><p>From "The Power of Growth Mindset" to "Building Resilient Classrooms," each talk is customized to the audience and their specific challenges.</p>',
                'features'    => ['Customized content', 'Interactive Q&A sessions', 'Workbook for participants', 'Available in Urdu & English', 'Virtual and in-person options'],
                'deliverables' => ['Customized presentation deck', 'Participant workbooks', 'Session recordings', 'Follow-up resources'],
                'sort_order'  => 2,
            ],
            [
                'title'   => 'Digital Learning Consultancy',
                'icon'    => 'bi-laptop-fill',
                'excerpt' => 'Cutting-edge EdTech strategies and digital transformation for 21st-century classrooms and institutions.',
                'description' => '<h3>About This Service</h3><p>In an era of rapid technological change, Awais Iqbal Ch helps schools and universities navigate the digital transformation journey. From LMS selection to blended learning design, she guides institutions through every step.</p>',
                'features'    => ['EdTech needs assessment', 'LMS selection & setup', 'Blended learning design', 'Teacher digital literacy training', 'Ongoing technical support'],
                'deliverables' => ['Digital transformation roadmap', 'LMS training sessions', 'E-learning content templates', 'Progress reports'],
                'sort_order'  => 3,
            ],
            [
                'title'   => 'Education Consultancy',
                'icon'    => 'bi-people-fill',
                'excerpt' => 'Strategic guidance for educational institutions to enhance learning outcomes and operational excellence.',
                'description' => '<h3>About This Service</h3><p>Awais Iqbal Ch provides comprehensive consulting services to schools, colleges, and educational NGOs. She helps institutions develop strategic plans, improve governance, and create cultures of continuous improvement.</p>',
                'features'    => ['Institutional assessment', 'Strategic planning workshops', 'Policy development', 'Staff capacity building', 'Quality assurance frameworks'],
                'deliverables' => ['Strategic plan document', 'Policy manuals', 'Training reports', 'Implementation timeline'],
                'sort_order'  => 4,
            ],
        ];
        foreach ($services as $svc) {
            Service::firstOrCreate(['title' => $svc['title']], $svc);
        }

        // Events
        $events = [
            [
                'title'       => 'Advanced Teacher Training Workshop 2025',
                'excerpt'     => 'A 3-day intensive workshop focusing on modern pedagogical approaches.',
                'description' => '<p>Join us for a transformative 3-day workshop designed specifically for experienced teachers looking to elevate their practice. This intensive program covers advanced classroom management, differentiated instruction, and assessment strategies.</p><h3>Who Should Attend</h3><p>Teachers with 3+ years of experience, school leaders, and curriculum coordinators.</p>',
                'start_date'  => now()->addMonth(),
                'end_date'    => now()->addMonth()->addDays(2),
                'venue'       => 'Pearl Continental Hotel',
                'city'        => 'Lahore',
                'country'     => 'Pakistan',
                'is_online'   => false,
                'is_free'     => false,
                'price'       => 5000,
                'max_participants' => 50,
                'status'      => 'upcoming',
            ],
            [
                'title'       => 'Digital Classroom: Free Webinar Series',
                'excerpt'     => 'Free weekly webinars on integrating technology in your classroom.',
                'description' => '<p>A free 4-week webinar series covering the fundamentals of digital teaching tools and strategies for online engagement.</p>',
                'start_date'  => now()->addWeek(),
                'end_date'    => now()->addWeeks(5),
                'is_online'   => true,
                'online_link' => 'https://zoom.us/j/example',
                'is_free'     => true,
                'price'       => 0,
                'status'      => 'upcoming',
            ],
            [
                'title'       => 'National Education Summit 2024',
                'excerpt'     => 'Annual summit bringing together educators from across Pakistan.',
                'description' => '<p>The National Education Summit brought together over 500 educators, policymakers, and researchers to discuss the future of education in Pakistan.</p>',
                'start_date'  => now()->subMonths(3),
                'end_date'    => now()->subMonths(3)->addDay(),
                'venue'       => 'Islamabad Convention Center',
                'city'        => 'Islamabad',
                'country'     => 'Pakistan',
                'is_online'   => false,
                'is_free'     => false,
                'price'       => 3000,
                'status'      => 'past',
            ],
        ];
        foreach ($events as $evt) {
            Event::firstOrCreate(['title' => $evt['title']], $evt);
        }

        // Testimonials
        $testimonials = [
            ['author_name' => 'Ms. Ayesha Malik', 'author_title' => 'Head of Department', 'author_organization' => 'LGS Paragon', 'content' => 'Awais Iqbal Ch\'s training completely transformed our department\'s approach to teaching. Her practical methodologies and infectious enthusiasm inspired every single teacher on our team. Six months later, we are still seeing remarkable improvements in student outcomes.', 'rating' => 5, 'is_featured' => true, 'sort_order' => 1],
            ['author_name' => 'Mr. Ahmed Raza', 'author_title' => 'Principal', 'author_organization' => 'Beaconhouse School System', 'content' => 'We invited Awais Iqbal Ch to deliver a keynote at our annual staff development day and the feedback was overwhelming. Teachers described it as the most impactful session they had attended in years. Highly recommend!', 'rating' => 5, 'is_featured' => true, 'sort_order' => 2],
            ['author_name' => 'Dr. Fatima Hassan', 'author_title' => 'Education Specialist', 'author_organization' => 'UNICEF Pakistan', 'content' => 'Working with Awais Iqbal Ch on our digital learning initiative was an absolute pleasure. Her expertise in EdTech and her ability to communicate complex ideas in simple terms made the entire project a success.', 'rating' => 5, 'is_featured' => true, 'sort_order' => 3],
            ['author_name' => 'Mr. Usman Shah', 'author_title' => 'Senior Teacher', 'author_organization' => 'Government High School, Faisalabad', 'content' => 'Before attending Awais Iqbal Ch\'s workshop, I felt stuck in my teaching routine. After just two days, I had a toolkit full of new strategies and the confidence to use them. My students have noticed the difference!', 'rating' => 5, 'is_featured' => true, 'sort_order' => 4],
            ['author_name' => 'Prof. Nadia Aziz', 'author_title' => 'Dean of Education', 'author_organization' => 'University of Education, Lahore', 'content' => 'We have collaborated with Awais Iqbal Ch on multiple curriculum design projects and she consistently delivers exceptional results. Her research-grounded approach and collaborative spirit make her an ideal partner.', 'rating' => 5, 'is_featured' => false, 'sort_order' => 5],
            ['author_name' => 'Ms. Sara Qureshi', 'author_title' => 'Teacher', 'author_organization' => 'Roots International School', 'content' => 'The motivational talk Awais Iqbal Ch gave at our school changed my perspective entirely. I was on the verge of leaving teaching but she helped me rediscover my passion. I am so grateful!', 'rating' => 5, 'is_featured' => true, 'sort_order' => 6],
        ];
        foreach ($testimonials as $t) {
            Testimonial::firstOrCreate(['author_name' => $t['author_name']], $t);
        }

        // Certificates
        $certs = [
            ['title' => 'Certified Teacher Trainer (CTT)', 'issuing_organization' => 'National Teacher Training Academy, Pakistan', 'year' => 2011, 'category' => 'Teaching'],
            ['title' => 'Cambridge International Certificate for Teachers', 'issuing_organization' => 'Cambridge Assessment International Education', 'year' => 2013, 'category' => 'Teaching'],
            ['title' => 'Google Certified Educator Level 2', 'issuing_organization' => 'Google for Education', 'year' => 2018, 'category' => 'Digital Learning'],
            ['title' => 'Microsoft Innovative Educator Expert', 'issuing_organization' => 'Microsoft Education', 'year' => 2019, 'category' => 'Digital Learning'],
            ['title' => 'Certified Professional Coach (CPC)', 'issuing_organization' => 'International Coach Federation', 'year' => 2020, 'category' => 'Leadership'],
            ['title' => 'Design Thinking for Education', 'issuing_organization' => 'IDEO.org (Online)', 'year' => 2021, 'category' => 'Leadership'],
            ['title' => 'Project-Based Learning Certification', 'issuing_organization' => 'Buck Institute for Education', 'year' => 2016, 'category' => 'Teaching'],
            ['title' => 'Child Protection in Education', 'issuing_organization' => 'UNICEF Online Courses', 'year' => 2022, 'category' => 'Teaching'],
        ];
        foreach ($certs as $c) {
            Certificate::firstOrCreate(['title' => $c['title']], $c);
        }

        // Blog Posts
        $cat1 = Category::where('name', 'Teacher Training')->first();
        $cat2 = Category::where('name', 'Digital Learning')->first();
        $posts = [
            [
                'user_id'      => $user->id,
                'category_id'  => $cat1->id,
                'title'        => '5 Evidence-Based Strategies Every Teacher Should Know',
                'excerpt'      => 'Discover the research-backed teaching strategies that have transformed classrooms across the globe.',
                'body'         => '<h2>The Science of Effective Teaching</h2><p>In over 15 years of working with educators, I have identified five strategies that consistently produce remarkable results regardless of grade level, subject area, or school context. These are not trends or fads — they are grounded in decades of educational research.</p><h3>1. Retrieval Practice</h3><p>Instead of simply rereading notes, students should regularly retrieve information from memory. This "testing effect" has been shown to dramatically improve long-term retention. Try starting each lesson with 5 quick questions about previous material.</p><h3>2. Spaced Practice</h3><p>Spreading learning over time is far more effective than cramming. Help students create study schedules that revisit material at increasing intervals.</p><h3>3. Interleaving</h3><p>Mix different types of problems or topics within a single study session. While it feels harder, interleaving improves students\' ability to discriminate between problem types and apply the right strategy.</p><h3>4. Elaborative Interrogation</h3><p>Ask students to explain why facts are true, not just what the facts are. "Why does a plant need sunlight?" is more powerful than "What does a plant need?"</p><h3>5. Concrete Examples</h3><p>Abstract concepts become memorable when paired with concrete examples. The more vivid and relatable the example, the better.</p><p>Implement even two of these strategies consistently and I guarantee you will see a difference within a month.</p>',
                'is_published' => true,
                'published_at' => now()->subDays(10),
                'views'        => 342,
            ],
            [
                'user_id'      => $user->id,
                'category_id'  => $cat2->id,
                'title'        => 'How to Create Engaging Online Lessons That Students Actually Enjoy',
                'excerpt'      => 'Moving your teaching online doesn\'t mean sacrificing engagement. Here are practical strategies to keep students hooked.',
                'body'         => '<h2>The Challenge of Online Engagement</h2><p>When I first started conducting online training sessions, I noticed something troubling: after about 20 minutes, participants would start disappearing — not physically, but mentally. Their cameras would remain on but their eyes would glaze over. Sound familiar?</p><p>Over the past four years, I have developed and tested dozens of strategies for maintaining engagement in virtual environments. Here are the ones that work.</p><h3>1. The 10-Minute Rule</h3><p>Break your lesson into 10-minute segments. Every 10 minutes, change the activity — from listening to discussing, from watching to creating.</p><h3>2. Collaborative Annotation</h3><p>Use tools like Jamboard or Padlet to have students annotate documents or images together in real time. This transforms passive viewing into active participation.</h3><h3>3. Breakout Rooms With Clear Tasks</h3><p>Breakout rooms fail when students do not know what to do. Always give a specific, time-bound task with a deliverable to share when they return.</p>',
                'is_published' => true,
                'published_at' => now()->subDays(5),
                'views'        => 218,
            ],
        ];
        foreach ($posts as $p) {
            Post::firstOrCreate(['title' => $p['title']], $p);
        }

        $this->command->info('✅ Database seeded successfully!');
        $this->command->info('👤 Admin: admin@portfolio.com | Password: password');
    }
}
