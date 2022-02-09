<?php

namespace App\Models;


class Post 
{
   private static $blog_posts = [
        [
            'title' => 'Judul Post Pertama',
            'slug' => 'judul-post-pertama',
            'author' => 'Gilang Maulana',
            'body' => '
        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Facere, odit? Nesciunt libero perspiciatis, fugiat provident non totam dolorum eum, quia veritatis deserunt temporibus consequuntur a ex repellendus quibusdam quae sunt culpa, quod quo qui soluta. Itaque maxime excepturi voluptates reprehenderit incidunt nemo libero, rem doloribus, molestiae assumenda, recusandae fuga atque delectus quasi quibusdam. Aut earum aperiam, atque placeat facere incidunt nesciunt cumque voluptate, adipisci sapiente amet cum dolorem. Modi, doloribus? Optio repudiandae dolore blanditiis veritatis voluptatum aliquid, quis quod? Est corrupti illum deserunt delectus. Est, tenetur, distinctio voluptas aspernatur odio maxime, perspiciatis facere sequi eaque architecto enim esse sint incidunt.'
        ],

        [
            'title' => 'Judul Post Kedua',
            'slug' => 'judul-post-kedua',
            'author' => 'Hanna Athaya',
            'body' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eum enim quia fugiat libero rerum perspiciatis laboriosam autem pariatur quasi. Optio quia qui minus amet eligendi odit nam repellendus commodi expedita. Modi aperiam minus delectus qui minima rerum, ex, sint esse totam nemo dolor vero, quos voluptates nobis a deleniti dolorem ad unde iusto pariatur sunt possimus vitae nulla! Laboriosam hic optio maxime dolores a labore accusantium, temporibus deserunt sapiente tempora? Dolores provident minus explicabo, quod quae impedit incidunt dolore, asperiores esse, earum delectus illo omnis excepturi magni? Quaerat quia assumenda ipsam culpa sunt aliquam delectus, repudiandae voluptas at iste repellendus quas harum odio amet animi labore nobis ex, dolorem, magnam facere. Dolorem sed dignissimos libero reprehenderit, cupiditate totam, hic nemo adipisci obcaecati praesentium tempore nisi veritatis aspernatur perspiciatis quae. Debitis eveniet autem quos nostrum eius totam nesciunt in quasi explicabo dolorum suscipit expedita deserunt velit fugiat, assumenda alias voluptates? Tempore?'
        ],

        [
            'title' => 'Judul Post Ketiga',
            'slug' => 'judul-post-ketiga',
            'author' => 'Ilham Safaat',
            'body' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur error, atque excepturi enim asperiores labore quae aperiam recusandae natus, laudantium tempore quibusdam quam quod totam? Minima, beatae sit fugit odio corporis atque tenetur quaerat. Ipsa iste, eveniet cumque explicabo ducimus maxime magnam, voluptate deleniti atque rerum saepe incidunt quibusdam nihil beatae labore laboriosam numquam, nobis veritatis corrupti nemo ratione facere. Porro optio, error voluptates doloremque doloribus, obcaecati quae accusamus saepe ducimus cumque ipsum? Modi fuga sit libero temporibus labore, accusamus illum! Numquam quibusdam porro voluptatem, autem dicta id nemo velit atque, ipsa eius quos facilis, et repellendus suscipit facere accusantium voluptatum unde incidunt pariatur. Ex quaerat voluptatibus repudiandae sapiente, at fugit, porro, dolore recusandae blanditiis qui minima. Consectetur iste excepturi ab magnam ipsa repellat quasi earum modi in debitis qui voluptatem quae veniam praesentium quas, ducimus mollitia amet cumque! Saepe placeat dolores eligendi molestias ullam deleniti consectetur eius odit ab optio esse facilis ducimus laboriosam porro dolorem omnis, ea rerum qui explicabo corporis amet numquam aperiam est? Quo aut quae asperiores nulla eligendi soluta inventore quaerat laborum omnis amet aliquid vero error, quam tempore numquam nesciunt corrupti! Qui a, perspiciatis adipisci corrupti unde nihil debitis nobis veniam consequatur aperiam itaque.'
        ]
    ];


    public static function all()
    {
        return collect(self::$blog_posts);
    }

    public static function find($slug)
    {
        // //postingan yg banyak
        $data = static::all();

        // // //postingan yang ketemu (berdasarkan slug)
        // // $post = [];

        // // //looping semua data postingan
        // // foreach ($data as $p){
        // //     if($p['slug'] == $slug){
        // //         // kita masukkan data postingan yg di $p kedalam $post
        // //         $post = $p;
        // //     }
        // // }

        // // pake fungsi collect()
        // //kembalikan nilai $post(data yg sudah ditampung)
        return $data->firstWhere('slug', $slug);
    }
}
