<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Kelas;
use App\Models\Post\Post;
use App\Models\Assignment;
use App\Models\Chore\Chore;
use App\Models\Finanec\Finance;
use App\Policies\KelasPolicy;
use App\Policies\PostPolicy;
use App\Policies\Course\Course;
use App\Policies\Course\CourseGroup;
use App\Policies\AssignmentPolicy;
use App\Policies\ChorePolicy;
use App\Policies\FinancePolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Kelas::class => KelasPolicy::class,
        Post::class => PostPolicy::class,
        Course::class => CoursePolicy::class,
        CourseGroup::class => CourseGroupPolicy::class,
        Assignment::class => AssignmentPolicy::class,
        Chore::class => ChorePolicy::class,
        ChoreGroup::class => ChoreGroupPolicy::class,
        Finance::class => FinancePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
