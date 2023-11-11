<?php

declare(strict_types=1);

namespace App\Dtos\User;

use App\Http\Requests\User\UpdateUserRequest;
use Illuminate\Http\UploadedFile;

final class UpdateUserDto
{

    public ?string $firstName = null;
    public ?string $lastName = null;
    public ?string $email = null;
    public ?string $phoneNumber = null;
    public ?string $description = null;
    public ?string $imagePath = null;
    public ?UploadedFile $image = null;

    public function __construct(UpdateUserRequest $request, public int $id)
    {
        $this->firstName = $request->input('first_name');
        $this->lastName = $request->input('last_name');
        $this->email = $request->input('email');
        $this->phoneNumber = $request->input('phone_number');
        $this->description = $request->input('description');
        if ($request->hasFile('image')) {
            $this->image = $request->file('image');
            $this->imagePath = $this->image->getClientOriginalName();
        }
    }
}
