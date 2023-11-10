<?php

declare(strict_types=1);

namespace App\Dtos\User;

use App\Constants\Role;
use App\Http\Requests\User\CreateUserRequest;
use Illuminate\Http\UploadedFile;

final class CreateUserDto
{
    public string $firstName;
    public ?string $lastName;
    public string $email;
    public string $password;
    public ?int $roleId;
    public ?string $phoneNumber = null;
    public ?string $description = null;
    public ?string $imagePath = null;
    public ?UploadedFile $image = null;

    public function __construct(CreateUserRequest $request)
    {
        $this->firstName = $request->input('first_name');
        $this->lastName = $request->input('last_name');
        $this->email = $request->input('email');
        $this->password = $request->input('password');
        $roleId = $request->input('role_id');
        $this->roleId = $roleId ? (int)$roleId : Role::CONSUMER->value;
        $this->phoneNumber = $request->input('phone_number');
        $this->description = $request->input('description');
        if ($request->hasFile('image')) {
            $this->image = $request->file('image');
            $this->imagePath = $this->image->getClientOriginalName();
        }
    }
}
