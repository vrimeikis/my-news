<?php

declare(strict_types = 1);

namespace App\Console\Commands;

use App\Repositories\AdminRepository;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

/**
 * Class CreateAdminCommand
 * @package App\Console\Commands
 */
class CreateAdminCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:new';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new admin';
    /**
     * @var AdminRepository
     */
    private $adminRepository;

    /**
     * Create a new command instance.
     *
     * @param AdminRepository $adminRepository
     */
    public function __construct(AdminRepository $adminRepository)
    {
        parent::__construct();
        $this->adminRepository = $adminRepository;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        try {
            $data = [
                'email' => $this->enterEmail(),
                'password' => $this->enterPassword(),
            ];

            $admin = $this->adminRepository->createNew($data);

            $this->info('Admin created by ' . $admin->email . ' email.');

        } catch (Exception $exception) {
            $this->error($exception->getMessage());
        }
    }

    /**
     * @return string
     */
    private function enterEmail(): string
    {
        $email = $this->ask('Enter admin email address');

        $validator = Validator::make([
            'email' => $email,
        ], [
            'email' => 'required|email|unique:admins',
        ]);

        if ($validator->fails()) {
            $this->error($validator->errors()->first('email'));

            return $this->enterEmail();
        }

        return $email;
    }

    /**
     * @return string
     */
    private function enterPassword(): string
    {
        $password = $this->secret('Enter admin password');
        $passwordConfirm = $this->secret('Repeat admin password');

        $validator = Validator::make([
            'password' => $password,
            'password_confirmation' => $passwordConfirm,
        ], [
            'password' => 'required|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            $this->error($validator->errors()->first('password'));

            return $this->enterPassword();
        }

        return bcrypt($password);
    }
}
