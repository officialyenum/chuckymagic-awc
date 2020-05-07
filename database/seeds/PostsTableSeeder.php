<?php


use App\Post;
use App\Category;
use App\Tag;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $author1 = User::create([
            'name' => 'Archibong Regina',
            'email' => 'archibongregina@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('password')
        ]);

        $author2 = User::create([
            'name' => 'Wole Of Lagos',
            'email' => 'woleoflagos@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('password')
        ]);

        $author3 = User::create([
            'name' => 'Oreofe',
            'email' => 'oreofe@gmail.com',
            'role' => 'writer',
            'password' => Hash::make('password')
        ]);

        $author4 = User::create([
            'name' => 'tomisola',
            'email' => 'tomisola@gmail.com',
            'password' => Hash::make('password')
        ]);

        $category1 = Category::create([
            'name' => 'House Party'
        ]);
        $category2 = Category::create([
            'name' => 'Concert'
        ]);
        $category3 = Category::create([
            'name' => 'Road Trip'
        ]);
        $category4 = Category::create([
            'name' => 'Netflix Party'
        ]);
        $category5 = Category::create([
            'name' => 'Restaurant'
        ]);
        $category6 = Category::create([
            'name' => 'Beach'
        ]);
        $category7 = Category::create([
            'name' => 'NewsLetter'
        ]);
        $post1 = Post::create([
            'title' => 'November Hangout 2019',
            'description' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.',
            'content' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.',
            'category_id' => $category5->id,
            'user_id' => $author2->id,
            'image' => 'posts/1.jpg'
        ]);
        $post2 = $author1->posts()->create([
            'title' => 'December House party 2019',
            'description' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.',
            'content' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.',
            'category_id' => $category1->id,
            'image' => 'posts/2.jpg'
        ]);
        $post3 = $author3->posts()->create([
            'title' => 'December BurnaBoy Live 2020',
            'description' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.',
            'content' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.',
            'category_id' => $category2->id,
            'image' => 'posts/3.jpg'
        ]);
        $post4 = $author2->posts()->create([
            'title' => 'January Hangout 2020',
            'description' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.',
            'content' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.',
            'category_id' => $category5->id,
            'image' => 'posts/3.jpg'
        ]);
        $post5 = Post::create([
            'title' => 'February Netflix Party 2020',
            'description' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.',
            'content' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.',
            'category_id' => $category4->id,
            'user_id' => $author1->id,
            'image' => 'posts/4.jpg'
        ]);
        $post6 = Post::create([
            'title' => 'COVID-19 Update',
            'description' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.',
            'content' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.',
            'category_id' => $category7->id,
            'user_id' => $author1->id,
            'image' => 'posts/4.jpg'
        ]);

        $tag1 = Tag::create([
            'name' => 'swimming'
        ]);
        $tag2 = Tag::create([
            'name' => 'eating'
        ]);
        $tag3 = Tag::create([
            'name' => 'drinking'
        ]);
        $tag4 = Tag::create([
            'name' => 'learning'
        ]);

        $post1->tags()->attach([$tag1->id, $tag2->id]);
        $post2->tags()->attach([$tag1->id, $tag2->id, $tag3->id, $tag4->id]);
        $post3->tags()->attach([$tag2->id, $tag3->id]);
        $post4->tags()->attach([$tag3->id, $tag1->id]);
        $post5->tags()->attach([$tag3->id, $tag2->id]);
    }
}
