<?php

namespace App\Http\Controllers;

use App\Helpers\AppHelpers;
use App\Models\Category;

class CategoryController extends Controller
{
    // fetch all categories
    public function all()
    {
        return AppHelpers::api_response(Category::all("id", "name"));
    }
}
