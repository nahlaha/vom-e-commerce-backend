<?php

namespace App\Constants;

use Illuminate\Http\Response;

enum Error: int
{
    case UNAUTHORIZED = 1;
    case INVALID_INPUT = 2;
    case UNKNOWN_ERROR = 3;
    case METHOD_NOT_ALLOWED = 4;
    case TOKEN_NOT_PROVIDED = 5;
    case TOKEN_EXPIRED = 6;
    case TOKEN_INVALID = 7;
    case USER_NOT_FOUND = 8;
    case ROUTE_NOT_FOUND = 9;
    case INVALID_USERNAME_PASSWORD = 10;
    case EMAIL_ALREADY_EXISTS = 11;
    case STORE_NAME_ALREADY_EXISTS = 12;
    case PRODUCT_NAME_ALREADY_EXISTS = 13;
    case STORE_NOT_FOUND = 14;
    case PRODUCTS_NOT_EXISTS = 15;

    public function getHttpCode(): int
    {
        return match ($this) {
            Error::UNAUTHORIZED => Response::HTTP_UNAUTHORIZED,
            Error::INVALID_INPUT => Response::HTTP_BAD_REQUEST,
            Error::UNKNOWN_ERROR => Response::HTTP_INTERNAL_SERVER_ERROR,
            Error::METHOD_NOT_ALLOWED => Response::HTTP_METHOD_NOT_ALLOWED,
            Error::TOKEN_NOT_PROVIDED => Response::HTTP_UNAUTHORIZED,
            Error::TOKEN_EXPIRED => Response::HTTP_UNAUTHORIZED,
            Error::TOKEN_INVALID => Response::HTTP_UNAUTHORIZED,
            Error::USER_NOT_FOUND => Response::HTTP_NOT_FOUND,
            Error::ROUTE_NOT_FOUND => Response::HTTP_NOT_FOUND,
            Error::INVALID_USERNAME_PASSWORD => Response::HTTP_UNAUTHORIZED,
            Error::EMAIL_ALREADY_EXISTS => Response::HTTP_BAD_REQUEST,
            Error::STORE_NAME_ALREADY_EXISTS => Response::HTTP_BAD_REQUEST,
            Error::PRODUCT_NAME_ALREADY_EXISTS => Response::HTTP_BAD_REQUEST,
            Error::STORE_NOT_FOUND => Response::HTTP_BAD_REQUEST,
            Error::PRODUCTS_NOT_EXISTS => Response::HTTP_BAD_REQUEST,
        };
    }

    public function getErrorMessage(): string
    {
        return match ($this) {
            Error::UNAUTHORIZED => 'Unauthorized access',
            Error::INVALID_INPUT => 'Invalid input',
            Error::UNKNOWN_ERROR => 'Unknown error',
            Error::METHOD_NOT_ALLOWED => 'Method is not allowed',
            Error::TOKEN_NOT_PROVIDED => 'Token is not provided',
            Error::TOKEN_EXPIRED => 'Token expired',
            Error::TOKEN_INVALID => 'Token invalid',
            Error::USER_NOT_FOUND => 'User not found',
            Error::ROUTE_NOT_FOUND => 'Route not found',
            Error::INVALID_USERNAME_PASSWORD => 'Invalid username or password',
            Error::EMAIL_ALREADY_EXISTS => 'Email already exists',
            Error::STORE_NAME_ALREADY_EXISTS => 'store\'name already exists',
            Error::PRODUCT_NAME_ALREADY_EXISTS => 'product\'s name already exists',
            Error::STORE_NOT_FOUND => 'store isn\'t found',
            Error::PRODUCTS_NOT_EXISTS => 'one or more products don\'t exists',
        };
    }
}
