<?php
namespace App\Models;
use App\Models\User;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Comment;
use App\Models\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    use HasFactory;
    protected $fillable = ['title','slug','excerpt','body','user_id','category_id'];

    public function author()
    {
        return $this->belongsTo(User::class , 'user_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function tag()
    {
        return $this->belongsToMany(Tag::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function image(){
        return $this->morphOne(Image::class,'imageable');
    }
}