<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\BlCategory;
use App\Models\BlPosts;
use App\Models\BlSubCategory;
use Illuminate\Support\Carbon;
use Symfony\Contracts\EventDispatcher\Event;
class PostController extends Controller

{
    public function ShowNavigation()
    {
       
        return view('navigation.manage-navigation');

    }

    public function AddPost()
    {
        $blogCat = BlCategory::join('bl_navigations', 'bl_navigations.id','blcnav_id')
        ->where('bl_categories.blc_active', '1')
        ->select('bl_navigations.bln_name as navName', 'bl_navigations.bln_key as navKey', 'bl_categories.blc_key as catKey', 'bl_categories.blc_name as catName' )
        ->orderBy('bl_categories.id', 'asc')->get(); 

        return view('post.add-post', compact('blogCat'));

    }

    protected function storePost(Request $request)
    {

   
        $uniqkey = random_int(100000, 999999);
        // $scategoryId = BlSubCategory::where('blcs_key', $request->postCat)->firstOrFail();
        $categoryId = BlCategory::where('blc_key', $request->postCat)->firstOrFail();


        $post = new BlPosts;
        $post->blp_title = $request->postTitle;
        $codegenSalt = (($post->blp_title).($uniqkey + microtime(1)));
        $post->blp_key = hash('sha256', $codegenSalt);  
        $post->blp_slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $post->blp_title )));
       
        $onerecordimages = [];
        $index = '0';
        if ($request->file('photos')) {
           
           foreach ($request->file('photos') as  $photo) {
            $uniqkey = random_int(100, 999);
            $name = ($post->blp_slug. $uniqkey) . '.' .'webp';
            $imageName = $photo->move(public_path('/blogImages'),$name);
            $node = md5(rand(10,100).time().$name);
            $date = Carbon::now();


            array_push($onerecordimages,[
                'id'=> $node,
                'images'=>$name,
                'date'=>$date,
                'alt'=>$post->blp_title,
                'post_id'=> $post->blp_key,
                'primary'=>'',
             ]);

            }

        }else{
            return 'No';
        }
        $storeimage = json_encode($onerecordimages);

        $post->blp_image =   $storeimage;   
        $post->blp_desc = $request->postCont;
        $post->blp_metatitle = $request->postmTitle;
        $post->blp_keywords = $request->postmKeyword;
        $post->blp_metadesc = $request->postmDesc;
        $post->blpcat_id = $categoryId->id;
        // $post->blpscat_id = $scategoryId->id;
        $post->blpusr_id = '1';
        $post->save();

        return ( "<script>alert('Posted successfully');</script><script> window.location.href = '/manage-posts';</script> ");
       

    }

    public function managePosts()
    {

        return view('post.manage-posts');

    }


    public function apiPosts()
    {
        $bPosts = BlPosts::with('category')
        ->select('id','blp_key as postId', 'blp_image as images', 'blp_title as title', 'blp_slug as slug', 'blp_desc as content', 
            'blp_metatitle as mtitle', 'blp_metadesc as mdesc', 'blp_keywords as mkeyword', 'created_at as posted','blpcat_id')
        ->orderBy('id', 'desc')
        ->get();

        $response = [
            'success'=>true,
            'posts'=> $bPosts,
        ];

        return response()->json($response, 200);

    }



    public function apiPostSlug($poskey)
    {
        $bPosts = BlPosts::where('blp_slug', $poskey)
        ->with('category')
        ->select('id','blp_key as postId', 'blp_image as images', 'blp_title as title', 'blp_slug as slug', 'blp_desc as content', 
            'blp_metatitle as mtitle', 'blp_metadesc as mdesc', 'blp_keywords as mkeyword', 'created_at as posted','blpcat_id', 'created_at as date')
        ->firstOrFail();

        

        $response = [
            'success'=>true,
            'posts'=> $bPosts,
        ];

        return response()->json($response, 200);

    }

    public function apiaPosts()
    {
        $bPosts = BlPosts::join('bl_categories', 'bl_categories.id', 'blpcat_id')
        ->where('bl_categories.blc_active', 'true')
        ->where('bl_posts.blp_active', 'true')
        ->select('blp_key as postId', 'blp_title as title', 'blp_slug as slug', 'blp_image as images',
        'bl_posts.created_at as postedon', 'bl_categories.blc_key as categroryId', 'bl_categories.blc_name as categroryName')
        ->orderBy('bl_posts.id', 'desc')
        ->get();

        $response = [
            'success'=>true,
            'posts'=> $bPosts,
        ];

        return response()->json($response, 200);

    }


    
    public function apisearchpost($searchkey)
    {

        $searchTerm = '%'.$searchkey.'%';

        $bPosts = BlPosts::where('blp_slug', 'like' ,$searchTerm)
        ->with('category')
        ->select('id','blp_key as postId', 'blp_image as images', 'blp_title as title', 'blp_slug as slug', 'blp_desc as content', 
            'blp_metatitle as mtitle', 'blp_metadesc as mdesc', 'blp_keywords as mkeyword', 'created_at as posted','blpcat_id', 'created_at as date')
        ->firstOrFail();

        

        $response = [
            'success'=>true,
            'posts'=> $bPosts,
        ];

        return response()->json($response, 200);

    }

}
