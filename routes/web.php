<?php

use App\Http\Controllers\Admin\CatalogController as AdminCatalog;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\SiteController as AdminSite;
use App\Http\Controllers\Admin\UserController as AdminUser;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\BuilderController;
use App\Http\Controllers\FullPageController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\OnboardingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiteController;
use App\Http\Middleware\ResolveTenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->get('/dashboard', function (Request $request) {
    $site = $request->user()->sites()->latest()->first();
    return $site
        ? redirect()->route('dashboard.builder.show', $site)
        : redirect()->route('onboarding.show');
})->name('dashboard');

/*
|--------------------------------------------------------------------------
| Breeze — perfil de usuario
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Site público (tenant)
|--------------------------------------------------------------------------
*/
Route::middleware([ResolveTenant::class])->group(function () {
    Route::get('/site/{slug}',                 [SiteController::class,    'show'])->name('site.show');
    Route::get('/site/{slug}/blog',            [BlogController::class,    'index'])->name('blog.index');
    Route::get('/site/{slug}/blog/{postSlug}', [BlogController::class,    'show'])->name('blog.show');
    Route::get('/site/{slug}/p/{sectionType}',   [FullPageController::class, 'show'])->name('site.fullpage');
    Route::get('/site/{slug}/booking/slots', [BookingController::class, 'slots'])->name('booking.slots');
    Route::post('/site/{slug}/booking',      [BookingController::class, 'store'])->name('booking.store');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/site/{slug}/blog',                      [BlogController::class, 'store'])->name('blog.store');
    Route::patch('/site/{slug}/blog/{postSlug}',          [BlogController::class, 'update'])->name('blog.update');
    Route::delete('/site/{slug}/blog/{postSlug}',         [BlogController::class, 'destroy'])->name('blog.destroy');
    Route::patch('/site/{slug}/blog/{postSlug}/publish',  [BlogController::class, 'togglePublish'])->name('blog.publish');
    Route::post('/site/{slug}/blog/{postSlug}/cover',     [BlogController::class, 'uploadCover'])->name('blog.cover');
    Route::patch('/site/{slug}/sections/{sectionType}/more-items', [FullPageController::class, 'updateMoreItems'])->name('site.more-items.update');
});

/*
|--------------------------------------------------------------------------
| Onboarding — usuario autenticado sin site todavía
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/onboarding', [OnboardingController::class, 'show'])->name('onboarding.show');
    Route::post('/onboarding', [OnboardingController::class, 'create'])->name('onboarding.create');
});

/*
|--------------------------------------------------------------------------
| Builder — auth + site propio
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/sites/{site}/builder',                   [BuilderController::class, 'show'])->name('builder.show');
    Route::patch('/sites/{site}/colors',                  [BuilderController::class, 'updateColors'])->name('builder.colors');
    Route::patch('/sites/{site}/logo',                    [BuilderController::class, 'uploadLogo'])->name('builder.logo');
    Route::patch('/sites/{site}/sections/{type}',         [BuilderController::class, 'updateSection'])->name('builder.section.update');
    Route::patch('/sites/{site}/sections/{type}/toggle',  [BuilderController::class, 'toggleSection'])->name('builder.section.toggle');
    Route::post('/sites/{site}/upload-image',             [BuilderController::class, 'uploadImage'])->name('builder.upload-image');
    Route::post('/sites/{site}/publish',                  [BuilderController::class, 'publish'])->name('builder.publish');
    Route::patch('/sites/{site}/typography',              [BuilderController::class, 'updateTypography'])->name('builder.typography');
});

Route::middleware(['auth'])->group(function () {
    Route::patch('/dashboard/sites/{site}/booking-settings',          [BookingController::class,   'updateSettings'])->name('booking.settings.update');
    Route::get('/dashboard/sites/{site}/google/connect',              [GoogleAuthController::class, 'redirect'])->name('google.connect');
    Route::delete('/dashboard/sites/{site}/google/disconnect',        [GoogleAuthController::class, 'disconnect'])->name('google.disconnect');
});

// Sin middleware — Google redirige aquí
Route::get('/dashboard/google/callback', [GoogleAuthController::class, 'callback'])->name('google.callback');

// ── Admin (superadmin) ────────────────────────────────────────────────────
Route::middleware(['auth', 'superadmin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/',                                       [AdminDashboard::class, 'index'])->name('dashboard');
    Route::post('/users/{user}/impersonate',              [AdminUser::class,      'impersonate'])->name('users.impersonate');
    Route::delete('/users/{user}',                        [AdminUser::class,      'destroy'])->name('users.destroy');
    Route::get('/sites',                                  [AdminSite::class,      'index'])->name('sites.index');
    Route::get('/sites/{site}',                           [AdminSite::class,      'show'])->name('sites.show');
    Route::patch('/sites/{site}/theme-colors',            [AdminSite::class,      'updateThemeColors'])->name('sites.theme-colors');
    Route::patch('/sites/{site}/colors',                  [AdminSite::class,      'updateColors'])->name('sites.colors');
    Route::get('/catalog',                                [AdminCatalog::class,   'index'])->name('catalog.index');
    Route::post('/catalog',                               [AdminCatalog::class,   'storeSector'])->name('catalog.store');
    Route::get('/catalog/{sector}',                       [AdminCatalog::class,   'showSector'])->name('catalog.sector');
    Route::post('/catalog/{sector}/variants',             [AdminCatalog::class,   'storeVariant'])->name('catalog.variant.store');
    Route::patch('/catalog/{sector}/variants/{variant}',  [AdminCatalog::class,   'updateVariant'])->name('catalog.variant.update');
    Route::delete('/catalog/{sector}/variants/{variant}', [AdminCatalog::class,   'destroyVariant'])->name('catalog.variant.destroy');
    Route::delete('/catalog/{sector}',                    [AdminCatalog::class,   'destroySector'])->name('catalog.sector.destroy');
    Route::get('/catalog/{sector}/variants/{variant}/defaults',   [AdminCatalog::class, 'editDefaults'])->name('catalog.variant.defaults');
    Route::patch('/catalog/{sector}/variants/{variant}/defaults', [AdminCatalog::class, 'updateDefaults'])->name('catalog.variant.defaults.update');
    Route::post('/catalog/{sector}/variants/{variant}/upload-image', [AdminCatalog::class, 'uploadDefaultImage'])->name('catalog.variant.upload-image');
});

// Stop-impersonation — accesible para el usuario impersonado (no necesita superadmin)
Route::middleware(['auth'])->post('/admin/stop-impersonating', [AdminUser::class, 'stopImpersonating'])
    ->name('admin.stop-impersonating');

require __DIR__ . '/auth.php';
