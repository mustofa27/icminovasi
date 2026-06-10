<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\InquiryController as AdminInquiryController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Admin\CommentController;
use App\Models\Article;
use App\Models\Project;

// Public Routes
Route::get('/', [LandingController::class, 'index'])->name('home');
Route::get('/projects', [LandingController::class, 'allProjects'])->name('projects.index');
Route::get('/projects/{project:slug}', [LandingController::class, 'showProject'])->name('projects.show');
Route::get('/clients', [LandingController::class, 'allClients'])->name('clients.index');
Route::get('/testimonials', [LandingController::class, 'allTestimonials'])->name('testimonials.index');
Route::post('/inquiries', [InquiryController::class, 'store'])->name('inquiries.store');

Route::get('/sitemap.xml', function () {
    $staticPages = [
        ['loc' => route('home'), 'lastmod' => now()],
        ['loc' => route('projects.index'), 'lastmod' => now()],
        ['loc' => route('clients.index'), 'lastmod' => now()],
        ['loc' => route('testimonials.index'), 'lastmod' => now()],
        ['loc' => route('articles.index'), 'lastmod' => now()],
    ];

    $projects = Project::query()
        ->where('is_published', true)
        ->select('slug', 'updated_at')
        ->latest('updated_at')
        ->get()
        ->map(function (Project $project) {
            return [
                'loc' => route('projects.show', $project),
                'lastmod' => $project->updated_at,
            ];
        });

    $articles = Article::query()
        ->published()
        ->select('slug', 'updated_at')
        ->latest('updated_at')
        ->get()
        ->map(function (Article $article) {
            return [
                'loc' => route('articles.show', $article),
                'lastmod' => $article->updated_at,
            ];
        });

    $urls = collect($staticPages)
        ->concat($projects)
        ->concat($articles);

    return response()
        ->view('sitemap', ['urls' => $urls])
        ->header('Content-Type', 'application/xml');
})->name('sitemap');

// Blog Routes
Route::get('/blog', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/blog/{article:slug}', [ArticleController::class, 'show'])->name('articles.show');
Route::post('/blog/{article:slug}/comments', [ArticleController::class, 'storeComment'])->name('comments.store');
Route::post('/blog/{article:slug}/like', [ArticleController::class, 'toggleLike'])->name('articles.like');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Admin Routes - Content Management (Admin & Editor)
Route::prefix('admin')->name('admin.')->middleware(['auth', 'content.manage'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Projects Management
    Route::resource('projects', ProjectController::class);
    
    // Clients Management
    Route::resource('clients', ClientController::class);

    // Testimonials Management
    Route::resource('testimonials', TestimonialController::class);

    // Articles Management
    Route::resource('articles', AdminArticleController::class);

    // Comments Management
    Route::resource('comments', CommentController::class, ['only' => ['index', 'edit', 'update', 'destroy']]);

    // General Settings
    Route::get('/settings', [SettingController::class, 'edit'])->name('settings.edit');
    Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');

    // Inquiries
    Route::get('/inquiries', [AdminInquiryController::class, 'index'])->name('inquiries.index');
    Route::get('/inquiries/{inquiry}', [AdminInquiryController::class, 'show'])->name('inquiries.show');
    Route::put('/inquiries/{inquiry}', [AdminInquiryController::class, 'update'])->name('inquiries.update');
});

// Admin Routes - User Management (Admin Only)
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::resource('users', UserController::class)->except(['show']);
});


