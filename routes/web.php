<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\ServiceController;
use App\Http\Controllers\Frontend\WorkshopController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\GalleryController;
use App\Http\Controllers\Frontend\TestimonialController;
use App\Http\Controllers\Frontend\CertificationController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\TestimonialAdminController;
use App\Http\Controllers\Admin\CertificateController;
use App\Http\Controllers\Admin\GalleryAdminController;
use App\Http\Controllers\Admin\ServiceAdminController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\NewsletterController;

/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');

// Services
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/{slug}', [ServiceController::class, 'show'])->name('services.show');

// Workshops & Events
Route::get('/workshops', [WorkshopController::class, 'index'])->name('workshops.index');
Route::get('/workshops/upcoming', [WorkshopController::class, 'upcoming'])->name('workshops.upcoming');
Route::get('/workshops/past', [WorkshopController::class, 'past'])->name('workshops.past');
Route::get('/workshops/{slug}', [WorkshopController::class, 'show'])->name('workshops.show');
Route::post('/workshops/{slug}/register', [WorkshopController::class, 'register'])->name('workshops.register');

// Blog
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/category/{slug}', [BlogController::class, 'category'])->name('blog.category');
Route::get('/blog/tag/{slug}', [BlogController::class, 'tag'])->name('blog.tag');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
Route::post('/blog/{slug}/comment', [BlogController::class, 'comment'])->name('blog.comment');

// Gallery
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');

// Testimonials
Route::get('/testimonials', [TestimonialController::class, 'index'])->name('testimonials.index');

// Certifications & Achievements
Route::get('/certifications', [CertificationController::class, 'index'])->name('certifications.index');

// Contact
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Newsletter
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {

    /*
    |------------------------------------------------------------------
    | GUEST-ONLY: Login page & login POST
    | Redirect to dashboard if already authenticated
    |------------------------------------------------------------------
    */
    Route::middleware('guest')->group(function () {
        Route::get('/login',  [AdminAuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');
    });

    // Logout (auth required)
    Route::post('/logout', [AdminAuthController::class, 'logout'])
        ->middleware('auth')
        ->name('logout');

    /*
    |------------------------------------------------------------------
    | PROTECTED: All admin panel pages require authentication
    | Unauthenticated users → redirect to /admin/login
    |------------------------------------------------------------------
    */
    Route::middleware('auth')->group(function () {

        // Dashboard
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // Blog Posts
        Route::resource('posts', PostController::class);
        Route::patch('posts/{post}/toggle-publish', [PostController::class, 'togglePublish'])->name('posts.toggle');

        // Categories
        Route::resource('categories', CategoryController::class);

        // Events
        Route::resource('events', EventController::class);
        Route::get('events/{event}/registrations', [EventController::class, 'registrations'])->name('events.registrations');

        // Testimonials
        Route::resource('testimonials', TestimonialAdminController::class);
        Route::patch('testimonials/{testimonial}/toggle-active', [TestimonialAdminController::class, 'toggleActive'])->name('testimonials.toggle');

        // Certificates
        Route::resource('certificates', CertificateController::class);

        // Gallery
        Route::resource('gallery', GalleryAdminController::class);

        // Services
        Route::resource('services', ServiceAdminController::class);

        // Contact Messages
        Route::get('messages',                      [MessageController::class, 'index'])->name('messages.index');
        Route::get('messages/{message}',            [MessageController::class, 'show'])->name('messages.show');
        Route::patch('messages/{message}/read',     [MessageController::class, 'markRead'])->name('messages.read');
        Route::delete('messages/{message}',         [MessageController::class, 'destroy'])->name('messages.destroy');

        // Newsletter
        Route::get('newsletter', [NewsletterController::class, 'index'])->name('newsletter.index');

    }); // end auth middleware

}); // end admin prefix
