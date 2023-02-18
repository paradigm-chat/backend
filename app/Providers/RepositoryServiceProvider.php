<?php

namespace App\Providers;

use App\Repositories\Chat\ChatRepository;
use App\Repositories\Chat\ChatRepositoryInterface;
use App\Repositories\Message\MessageRepository;
use App\Repositories\Message\MessageRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{

    /**
     * The repositories handler mappings for registration in the application.
     *
     * @var array<string, string>
     */
    protected array $repositories = [
        UserRepositoryInterface::class => UserRepository::class,
        ChatRepositoryInterface::class => ChatRepository::class,
        MessageRepositoryInterface::class => MessageRepository::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->booting(function () {
            foreach ($this->getRepositories() as $abstract => $concrete) {
                App::bind($abstract, $concrete);
            }
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * @return array
     */
    public function getRepositories(): array
    {
        return $this->repositories;
    }
}
