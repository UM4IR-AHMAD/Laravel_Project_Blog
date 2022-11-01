<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;



class PostFactory extends Factory
{
    private $postsCount = 28;
    private $postsCount2 = 28;

   /*  public function __construct()
    {
        parent::__construct();
        $this->postsCount = Category::sum('posts_count');;
        $this->postsCount2 = $this->postsCount;
    }
 */
   /*  public function categoryId(){

        
        switch (true) {
            case (($this->postsCount - 9) < $this->postsCount2):
                $this->postsCount2--;
                return 4;
                break;
            case (($this->postsCount - (9 + 7)) < $this->postsCount2):
                $this->postsCount2--;
                return 3;
                break;
            case (($this->postsCount - (9 + 7 + 5) )< $this->postsCount2):
                $this->postsCount2--;
                return 1;
                break;
            case (0 < $this->postsCount2):
                $this->postsCount2--;
                return 2;
                break;
            default:
                return 0;
                break;
        }

    } */


    public function description()
    {
        $paragraphs = $this->faker->paragraphs(rand(2,20));
        $desc= '<p>';
        foreach ($paragraphs as $key => $para) {
            $desc .= '<p>' . $para . '</p>' ;
        }

        return $desc;
    }


    
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // $filePath = storage_path('app\public\images');
        // $filePath = public_path('storage\images');

        // $image = $this->faker->image();
       /*  $url = "https://picsum.photos/id/237/200/300";
        $image = file_get_contents($url);

        $imageFile = new File(file_get_contents($url)); */



        return [
            'title' => $this->faker->sentence($nbWords = rand(2, 5), $variableNbWords = true),
            'description' => $this->description(),
            // 'img' => $this->faker->image(
            //     storage_path(path: 'app\public\posts'), 
            //     width: 50, height: 50,
            //     category: null, 
            //     fullPath:false),
            // 'img' => $this->faker->imageUrl($width = 640, $height = 480),

            // 'img' => $this->faker->image(storage_path('app\public\images'),540,480, null, false),
            // 'img' => Storage::disk('public')->putFile($filePath, $imageFile),


            'category_id' => rand(1,5),
            'user_id' => rand(1, 3),
            'views' => rand(3,40),
        ];

        // $post->addMediaFromUrl($this->faker->imageUrl($width = 640, $height = 480))->toMediaCollection();
        // return true;

    }
}
